<?php
header('content-type:test/html;charset:utf8');
$link=mysqli_connect("127.0.0.1",'root','','hk8');
mysqli_set_charset($link,"utf8");
if(!$link)
{
    echo "连接失败";
}
