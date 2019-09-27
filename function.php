<?php
include_once ('config.php');
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
mysqli_set_charset($connection,"UTF8");
if(!$connection){
    throw new Exception("Cann't Connect to Database\n");
}
function getStatusMessage($status){
    $statues = [
        "0"=>'',
        "1"=>"<p id='error'>Duplicate Email Address</p>",
        "2"=>"<p id='error'>User Name and Password empty</p>",
        "3"=>"<p id='error'>User Created Sucessfully</p>",
        "4"=>"<p id='error'>User Name and Password didn't match</p>",
        "5"=>"<p id='error'>User name dosen't exit</p>"
    ];
    return $statues[$status];
}

    function getWords($user_id,$search=Null){
        global $connection;
        if($search){
            $query = "SELECT * FROM `words` WHERE `user_id` ='{$user_id}'AND `word` LIKE '{$search}%' ORDER BY `word`";
        }else{
            $query = "SELECT * FROM `words` WHERE `user_id` ='{$user_id}' ORDER BY `word`";
        }
        $result = mysqli_query($connection,$query);
        $data = [];
        while($_data = mysqli_fetch_assoc($result)){
            array_push($data,$_data);
        }
        return $data;
    }