<?php
require_once("../connect.php");
$token=$_GET['token'];
$latitude=$_POST['latitude'];
$longitude=$_POST['longitude'];
$enddate=$_POST['enddate'];
$endtime=$_POST['endtime'];
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
    if($status==='Unavailable')
    {
        $mm="select * from ride where userID='$userID' and bikeID='$bikeID'";
        $mm1=mysqli_query($link,$mm);
        $row=mysqli_fetch_assoc($mm1);
        $startdate=$row['startdate'];
        $starttime=$row['starttime'];
        $duration=strtotime($enddate.''.$endtime)-strtotime($startdate.''.$starttime);
        $duration=ceil($duration/60);
        $fare=ceil($duration/15)*3;

        $in="update ride set enddate='$enddate',endtime='$endtime',duration='$duration',fare='$fare' where userID='$userID' and bikeID='$bikeID'";
        $ins=mysqli_query($link,$in);
        if($ins)
        {
            $up="update bike set latitude='$latitude',longitude='$longitude',status='Available' where bikeID='$bikeID'";
            mysqli_query($link,$up);
            $json=[	"message"=> "lock success"];
            header("HTTP/1.1 200");
            echo json_encode($json);
        }else{
            $json=[	"message"=> "Bike cannot be locked"];
            header("HTTP/1.1 400");
            echo json_encode($json);
        }


    }else{
        $json=[	"message"=> "1Bike cannot be locked"];
        header("HTTP/1.1 400");
        echo json_encode($json);
    }

}else{
    $json=[	"message"=> "Unauthorized user"];
    header("HTTP/1.1 401");
    echo json_encode($json);
}