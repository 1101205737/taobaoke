<?php
$conf = include 'Conf/config.php';
include 'Conf/url_mod.php';
$conf2 = array(
    'DEFAULT_THEME' => 'wh',
    'SOURCE_FROM' =>array(
        "qq"=>array('name'=>'腾讯','url'=>'qq.com'),
        "sina"=>array('name'=>'新浪','url'=>'sina.com.cn'),
        'ifeng'=>array('name'=>'凤凰网','url'=>'ifeng.com'),
        'toutiao'=>array('name'=>'头条新闻','url'=>'toutiao.com'),
        '163'=>array('name'=>'网易','url'=>'163.com'),
        'weixin'=>array('name'=>'微信','url'=>'weixin.sogou.com')
    ),
    'AD_POSITION'=>array(        
        'slide'=>'首页幻灯片',
        'flink'=>'友情链接',
        'nav'=>'导航',
        'logo_right'=>'logo右边广告位565*53',
        'erweima'=>'底部二维码90*90',
    ),
);
$_GET['m'] == 'admin' && $url_mod['URL_MODEL'] = 0;
$conf = array_merge($conf, $conf2);
$conf = array_merge($conf, $url_mod);
return $conf;
?>