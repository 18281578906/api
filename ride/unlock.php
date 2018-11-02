<?php
require_once("../connect.php");
$token=$_GET['token'];
$latitude=$_POST['latitude'];
$longitude=$_POST['longitude'];
$bikeID=$_GET['bikeID'];
$sql="select * from user where token='$token'";
$re=mysqli_query($link,$sql);
$num=mysqli_num_rows($re);
if($num==1)
{

    $userID=mysqli_fetch_assoc($re)['id'];
    $se="select * from bike where bikeID='$bikeID'";
    $ok=mysqli_query($link,$se);
   $data=mysqli_fetch_assoc($ok);
   $status=$data['status'];
   if($status==='Available')
   {
       date_default_timezone_set("PRC");
       $startdate=date("Y/m/d");
       $starttime=date("H:i:s");

        $in="insert into ride(bikeID,userID,startdate,starttime) values ('$bikeID','$userID','$startdate','$starttime')";

        $ins=mysqli_query($link,$in);
        if($ins)
        {
            $up="update bike set latitude='$latitude',longitude='$longitude',status='Unavailable' where bikeID='$bikeID'";
            mysqli_query($link,$up);
            $json=[	"message"=> "Unlock success"];
            header("HTTP/1.1 200");
            echo json_encode($json);
        }else{
            $json=[	"message"=> "1Bike cannot be unlocked"];
            header("HTTP/1.1 400");
            echo json_encode($json);
        }


   }else{
       $json=[	"message"=> "Bike cannot be unlocked"];
       header("HTTP/1.1 400");
       echo json_encode($json);
   }

}else{
    $json=[	"message"=> "Unauthorized user"];
    header("HTTP/1.1 401");
    echo json_encode($json);
}