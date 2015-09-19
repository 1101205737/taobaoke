<?php
require_once("../qqConnectAPI.php");
$qc = new QC();
$acs = $qc->qq_callback();
$oid = $qc->get_openid();
$qc = new QC($acs,$oid);
$uinfo = $qc->get_user_info();
//$_SESSION['openid'] = $oid;
//$_SESSION['nickname'] = $info['nickname'];
if(isMobile()){
    header("location:http://{$_SERVER['SERVER_NAME']}/m.php?m=member&a=qqlogin");
}else{
    header("location:http://{$_SERVER['SERVER_NAME']}/index.php?m=member&a=login&op=do&openid={$oid}&nickname={$uinfo['nickname']}");
}