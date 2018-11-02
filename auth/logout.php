<?php
require_once("../connect.php");
$token=$_GET['token'];
$sql="select * from user where token='$token'";
$re=mysqli_query($link,$sql);
$num=mysqli_num_rows($re);
if($num==1)
{

    $up="update user set token=' ' where token='$token'";
    $ok=mysqli_query($link,$up);
    if($ok)
    {
        $json=["message"=>"Logout success"];
        header("HTTP/1.1 200");
        echo json_encode($json);
    }

}else{
    $json=[	"message"=> "Unauthorized user"];
    header("HTTP/1.1 401");
    echo json_encode($json);
}