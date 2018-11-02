<?php
require_once("../connect.php");
$username=$_POST['username'];
$password=$_POST['password'];
$token=md5($username);
$sql="select * from user where username='$username' and password='$password'";
$re=mysqli_query($link,$sql);
$num=mysqli_num_rows($re);
if($num==1)
{
    $data=mysqli_fetch_assoc($re);
    $up="update user set token='$token' where username='$username'";
    $ok=mysqli_query($link,$up);
    if($ok)
    {
        $json=["authentication_token"=>$token, "role"=>$data['role'],];
        header("HTTP/1.1 200");
        echo json_encode($json);
    }

}else{
    $json=[	"message"=>"Invalid login"];
    header("HTTP/1.1 401");
    echo json_encode($json);
}