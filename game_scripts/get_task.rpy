init python:
    import os

    if renpy.emscripten:

        import emscripten, binascii, json
        class AsyncRequest:
            def __init__(self):
                while True:
                    self.filename = '/tmp/req-' + binascii.hexlify(os.urandom(8))
                    if not os.path.exists(self.filename):
                        break
                self.response = ''

            def send(self, endpoint, headers={}, data=None):
                emscripten.run_script(r'''
                  (function () {
                    try {
                      var filename = %s;
                      var url = %s;
                      var headers = %s;
                      var data = %s;
                      var xhr = new XMLHttpRequest();
                      var method = 'GET';
                      if (data !== null) {
                        method = 'POST';
                      }
                      xhr.open(method, url);
                      if (data !== null) {
                        xhr.setRequestHeader('Content-Type',
                          'application/x-www-form-urlencoded');
                      }
                      Object.keys(headers).forEach(function(key) {
                        xhr.setRequestHeader(key, headers[key]);
                      });
                      xhr.onerror = function(event) {
                          FS.writeFile(filename,
                            JSON.stringify({
                              'success': false,
                              'exception': "Request failed (possibly blocked)",
                            })
                          );
                      }
                      xhr.onload = function(event) {
                        if (this.status==200||this.status==304||this.status==206||this.status==0&&this.response) {
                          FS.writeFile(filename,
                            JSON.stringify({
                              'success': true,
                              'status': this.status,
                              'responseText': this.responseText
                            })
                          );
                        } else {
                          FS.writeFile(filename,
                            JSON.stringify({
                              'success': false,
                              'status': this.status,
                              'statusText': this.statusText,
                              'responseText': this.responseText
                            })
                          );
                        }
                      }
                      xhr.timeout = 10000;
                      xhr.ontimeout = function(event) {
                          FS.writeFile(filename,
                            JSON.stringify({
                              'success': false,
                              'status': event.target.status,
                              'statusText': 'timeout'
                            })
                          );
                      }
                      xhr.send(data);
                      
                    } catch (exception) {
                      console.log(exception);
                      FS.writeFile(filename,
                        JSON.stringify({
                          'success': false,
                          'exception': exception,
                        })
                      );
                    }
                  })();
                ''' % (json.dumps(self.filename), json.dumps(endpoint),
                       json.dumps(headers), json.dumps(data)))
                        #new TextDecoder('utf-8').decode(FS.readFile('/tmp/t'))

            def isAlive(self):
                return not os.path.exists(self.filename)
            def readfs(self):
                if os.path.exists(self.filename):
                    try:
                        self.response = json.loads(open(self.filename).read())
                    except ValueError, e:
                        self.response = { 'success': False, 'exception': str(e) }
                    os.unlink(self.filename)
            def getError(self):
                self.readfs()
                if self.response and not self.response.get('success', False):
                    if self.response.get('exception', None) is not None:
                        return 'Exception: ' + self.response['exception']
                    elif self.response.get('status', None) is not None:
                        if self.response.get('statusText', None) is not None:
                            return self.response['statusText'] + '(' + str(self.response['status']) + ')'
                        else:
                            return str(self.response['status'])
                return None
            def getResponse(self):
                self.readfs()
                if self.response and self.response.get('success', False):
                    return self.response['responseText']
                return None

    else:

        import threading, urllib2, httplib, ssl, urllib
        import time
        class AsyncRequest:
            def __init__(self):
                self.response = None
                self.error = None
            def send(self, endpoint, headers={}, data=None):
                req = urllib2.Request(endpoint, headers=headers, data=urllib.urlencode(data))
                def thread_main():
                    cafile = os.path.join(renpy.config.gamedir, 'ca.pem')
                    if not os.path.exists(cafile): cafile = None
                    try:
                        ctx = ssl.create_default_context()
                        ctx.check_hostname = False
                        ctx.verify_mode = ssl.CERT_NONE
                        r = urllib2.urlopen(req, cafile=cafile, timeout=10, context=ctx)
                        self.response = r.read()
                    except urllib2.URLError, e:
                        self.error = str(e.reason)
                    except httplib.HTTPException, e:
                        self.error = 'HTTPException'
                    except Exception, e:
                        self.error = 'Error: ' + str(e)
                renpy.invoke_in_thread(thread_main)
            def isAlive(self):
                return self.response is None and self.error is None
            def getError(self):
                return self.error
            def getResponse(self):
                return self.response
                

label get_task(label):
    $ req = AsyncRequest()
    $ import urllib
    $ req.send(endpoint = 'https://fiveraccoons.ru/projectPHP/random_task.php?label='+label, data = {"foo": 'bar'})
    $ timer = 0
    while not renpy.in_rollback() and req.isAlive():
        $ timer += 0.1        
        #pause 0.1
    $ ret = 'rollback'
    if req.getError():
        $ ret = req.getError()
    else:
        python:           
            ret = req.getResponse()        
            if ret != None:
                f = open('randomtasks/game/'+label+'.rpy', 'w')
                f.write(ret)
                f.close()
    
    return