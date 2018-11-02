<?php
require_once("../connect.php");
$token=$_GET['token'];
$bikeID=$_GET['bikeID'];

$sql="select * from user where token='$token' and role='admin'";
$re=mysqli_query($link,$sql);
$num=mysqli_num_rows($re);
if($num==1)
{
    $se="delete from bike where bikeID='$bikeID'";
    $ok=mysqli_query($link,$se);
    if($ok)
    {
        $json=["message"=>" Delete  success"];
        header("HTTP/1.1 200");
        echo json_encode($json);
    }
    else{
        $json=["message"=> " Data cannot be Delete "];
        header("HTTP/1.1 400");
        echo json_encode($json);
    }

}else{
    $json=[	"message"=> "Unauthorized user"];
    header("HTTP/1.1 401");
    echo json_encode($json);
}