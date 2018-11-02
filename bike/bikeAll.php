<?php
require_once("../connect.php");
$token=$_GET['token'];
$sql="select * from user where token='$token'";
$re=mysqli_query($link,$sql);
$num=mysqli_num_rows($re);
if($num==1)
{

  $se="select * from bike";
  $ok=mysqli_query($link,$se);
  $arr=Array();
  while($data=mysqli_fetch_assoc($ok)){
      $arr[]=$data;
  }

      header("HTTP/1.1 200");
      echo json_encode($arr);
}else{
    $json=[	"message"=> "Unauthorized user"];
    header("HTTP/1.1 401");
    echo json_encode($json);
}