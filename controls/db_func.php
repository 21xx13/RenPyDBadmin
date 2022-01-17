<?php
function connect_db ($host, $user, $pass, $db)
{
    class DBi
    {
        public static $conn;
    }
    @DBi::$conn = new mysqli ($host, $user, $pass, $db);
    if(mysqli_connect_errno())
    {
        exit("Error".mysqli_connect_error());
    }
    DBi::$conn->query( "SET CHARSET utf8" );
    return DBi::$conn;
}


function close_db (){
    DBi::$conn->close();
}


function get_tasks(){
    global $PASS;
    connect_db('localhost', 'root', $PASS, 'test_php');
    $res = DBi::$conn->query("SELECT * FROM `task_info` ORDER BY `create_date` DESC, `task_name` ASC ");
    if ($res->num_rows > 0){
        return $res;
    }
    return "Записей нет";
}

function get_task_by_id($id){
    $res = DBi::$conn->query("SELECT * FROM `task_info`WHERE `id` = $id");
    return $res->fetch_assoc();

}

function get_task($id){
    $result = DBi::$conn->query("SELECT * FROM `task_$id`");
    if ($result){
        return $result;
    }
    return "Выборы игрока не указаны";
}


function read_count()
{
    $res = DBi::$conn->query("SELECT COUNT(*) FROM `task_info`");
    $row = $res->fetch_row();
    return $row[0];
}

function read_count_by_label($label)
{
    $res = DBi::$conn->query("SELECT COUNT(*) FROM `task_info` WHERE `label` = '$label'");
    $row = $res->fetch_row();
    return $row[0];
}

function get_n_row_by_label($n, $label){
    $res = DBi::$conn->query("SELECT * FROM `task_info` WHERE `label` = '$label' LIMIT 1 OFFSET $n");
    return $res->fetch_assoc();
}

function get_n_row($n){
    $res = DBi::$conn->query("SELECT * FROM `task_info` LIMIT 1 OFFSET $n");
    return $res->fetch_assoc();
}

function get_options_by_id($id){
    return DBi::$conn->query("SELECT * FROM `task_$id`");
}
//
//    function read_rand_message($id)
//    {
//        $res = DBi::$conn->query("SELECT * FROM `citybyid` WHERE `id`=".$id);
//        while ($row = $res->fetch_assoc())
//        {
//            $result_array[] = $row;
//        }
//
//        foreach ($result_array as $key => $value)
//        {
//            $result = $value;
//        }
//
//        return $result;
//    }
