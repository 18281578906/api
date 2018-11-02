<?php
require_once("../connect.php");
$token=$_GET['token'];
$bikeID=$_GET['bikeID'];
$postdata=file_get_contents("php://input");
parse_str($postdata,$data);
$ID=$data['ID'];
$latitude=$data['latitude'];
$longitude=$data['longitude'];
$status=$data['status'];
$userID=$data['userID'];
$sql="select * from user where token='$token' and role='admin'";
$re=mysqli_query($link,$sql);
$num=mysqli_num_rows($re);
if($num==1)
{
    $se="select * from bike where bikeID='$bikeID'";
    $ok=mysqli_query($link,$se);
    $data=mysqli_fetch_assoc($ok);
    if($ID=='')
        $ID=$data['bikeID'];
    if($latitude=='')
        $latitude=$data['latitude'];
    if($longitude=='')
        $longitude=$data['longitude'];
    if($status=='')
        $status=$data['status'];
    if($userID=='')
        $userID=$data['userID'];

        $up="update bike set latitude='$latitude',longitude='$longitude',status='$status',userID='$userID' where bikeID='$bikeID'";
        echo $up;
        $ok=mysqli_query($link,$up);
        if($ok)
        {     $json=["message"=>" Update   success"];
            header("HTTP/1.1 200");
            echo json_encode($json);

        }
        else{
        $json=["message"=> " Data cannot be updated  "];
        header("HTTP/1.1 400");
        echo json_encode($json);
    }

}else{
    $json=[	"message"=> "Unauthorized user"];
    header("HTTP/1.1 401");
    echo json_encode($json);
}