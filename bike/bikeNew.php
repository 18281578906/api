<?php
require_once("../connect.php");
$token=$_GET['token'];
$latitude=$_POST['latitude'];
$longitude=$_POST['longitude'];
$status=$_POST['status'];

$sql="select * from user where token='$token' and role='admin'";
$re=mysqli_query($link,$sql);
$num=mysqli_num_rows($re);
if($num==1)
{
    $se="insert into bike(latitude,longitude,status) values ('$latitude','$longitude','$status')";
    $ok=mysqli_query($link,$se);
  if($ok)
  {
      $json=["message"=>" Create success"];
      header("HTTP/1.1 200");
      echo json_encode($json);
  }
  else{
      $json=["message"=> " Data cannot be processed"];
      header("HTTP/1.1 400");
      echo json_encode($json);
  }

}else{
    $json=[	"message"=> "Unauthorized user"];
    header("HTTP/1.1 401");
    echo json_encode($json);
}