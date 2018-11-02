<?php
require_once("../connect.php");
$token=@$_GET['token'];
$range=@$_GET['range'];
$perlati=22.193916;
$perlong=113.555389;
$sql="select * from user where token='$token'";
$re=mysqli_query($link,$sql);
$num=mysqli_num_rows($re);
if($num==1)
{
    $se="select * from bike";
    $ok=mysqli_query($link,$se);
    $arr=Array();
    while($row=mysqli_fetch_assoc($ok)){

        $d=distance($row['latitude'],$row['longitude']);
        echo $d.'<br>';
        if($d<=$range)
            $arr[]=$row;
    }
    header("HTTP/1.1 200");
    echo json_encode($arr);
}else{
    $json=[	"message"=> "Unauthorized user"];
    header("HTTP/1.1 401");
    echo json_encode($json);
}
function distance($b_lat,$b_lon,$u_lat=22.193916,$u_lon=113.555389){
    $b_lat=$b_lat*2*pi()/360;
    $b_lon=$b_lon*2*pi()/360;
    $u_lat=$u_lat*2*pi()/360;
    $u_lon=$u_lon*2*pi()/360;
    $a=pow(sin(abs($b_lat-$u_lat)/2),2)+cos($b_lat)*cos($u_lat)*pow(sin(abs($b_lon-$u_lon)/2),2);
    echo $a.'<br>';
    $c=2*atan2(sqrt($a),sqrt(1-$a));
    $d=$c*6371*1000;

    return $d;
}