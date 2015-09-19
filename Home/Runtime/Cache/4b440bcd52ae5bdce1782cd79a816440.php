<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($setting['site_seo_title']); ?> - <?php echo ($setting['site_name']); ?></title>
<meta name="keywords" content="<?php echo ($setting['site_seo_keywords']); ?>" />
<meta name="description" content="<?php echo ($setting['site_seo_description']); ?>">
<meta name="author" content="XiaocaoCMS">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- HTML5 shim for IE8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->
<link rel="icon" href="__TMPL__statics/images/favicon.ico" mce_href="__TMPL__statics/images/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="__TMPL__statics/images/favicon.ico" mce_href="__TMPL__statics/images/favicon.ico" type="image/x-icon">
<link href="/public/simpleboot/themes/cmf/theme.min.css" rel="stylesheet">
<link href="/public/simpleboot/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="/public/simpleboot/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!--[if IE 7]>
	<link rel="stylesheet" href="/public/simpleboot/font-awesome/4.2.0/css/font-awesome-ie7.min.css">
<![endif]-->
<link href="__TMPL__statics/css/style.css" rel="stylesheet">
<link href="__TMPL__statics/css/header.css" rel="stylesheet">
<style>
 #backtotop {
    position: fixed;
    bottom: 50px;
    right:20px;
    display: none;
    cursor: pointer;
    font-size: 50px;
    z-index: 9999;
}
#backtotop:hover {
    color:#333
}
</style>
<script type="text/javascript">
//设定Mobile的定义(全小写)
/*var mobileAgent = new Array("iphone", "ipod", "ipad", "android", "mobile", "blackberry", "webos", "incognito", "webmate", "bada", "nokia", "lg", "ucweb", "skyfire");
//读取用户的浏览器资料
var browser = navigator.userAgent.toLowerCase();
var isMobile = false;
  
//检查开始
for (var i=0; i<mobileAgent.length; i++){
    if (browser.indexOf(mobileAgent[i])!=-1){
        isMobile = true;
        //程式码(转址)
        location.href = '<?php echo ($site_host); ?>wap/';
        //停止运行回圈
        break;
    }
}
*/
</script>

<link href="__TMPL__statics/css/index.css" rel="stylesheet">
<link href="__TMPL__statics/css/list.css" rel="stylesheet">   
</head>

<body class="body-white">
    <!-- 页头 -->
<div id="toolbar">
    <div class="bar-con">
        <ul class="topNav fl">
                        <li class="first"><a href="http://demo.xiaocaocms.com/" class="active">大豆淘宝客</a>
            </li>
            <li><a href="http://demo.xiaocaocms.com/topic/index.html" class="red ">商家报名</a>
            </li>
        </ul>
        <div class="right-show fr">
                                            <div class="union-login"> <a href="http://demo.xiaocaocms.com/api/qqconnect/oauth/index.php" rel="nofollow"><img src="/doc/商业资讯 - 大豆淘宝客_files/qqlogin.png"></a> |</div>
                                <div class="login-show"><a href="http://demo.xiaocaocms.com/member/login.html" rel="nofollow">登录</a><a href="http://demo.xiaocaocms.com/member/register.html" rel="nofollow">免费注册</a>　|</div>            
            <div class="other-show">
                                <a href="http://demo.xiaocaocms.com/jfmall/index.html" target="_top">积分商城</a>
            </div>
        </div>
    </div>
</div>
<div class="header">
    <div class="area">
        <a class="juan-logo fl" href="/" title="<?php echo ($setting['site_name']); ?>首页">
            <div class="fl" style="margin-top:20px">
                <img style='width:163px;height:37px;' src="<?php echo ($setting['site_logo']); ?>">
            </div>
        </a>
        <div class="protection">
            <?php $ad=getAd('logo_right',1,$adlist);$ad=$ad[0];if($ad){ ?>
            <a title="<?php echo ($ad["title"]); ?>" class="" href="<?php echo ($ad["url"]); ?>" <?php echo ($ad['blank']?'target="_blank"':''); ?>>
                <img style="width:565px;height:53px;" src="<?php echo ($ad["pic_url"]); ?>">
            </a>
            <?php } ?>
        </div>
        <div class="search">
            <form name="searchform" id="searchform" action="index.php" method="get">
                <?php echo setParam(array('m'=>'search','a'=>'index'));?>
            <span class="search-area fl">
                <input name="keywords" id="keywords" class="txt" value="请输入想找的宝贝" title="请输入想找的宝贝" type="text" onblur="if (value=='') {value='请输入想找的宝贝'}" onfocus="if(value=='请输入想找的宝贝') {value=''}">
            </span>
            <input value="搜全站" class="smt fr" type="submit">
            </form>
        </div>
    </div>
	<div class="mainNav">
     <div class="nav" style="position:relative">
                <?php $allsort = IndexModel::I()->getAllSort(); ?>
            <ul id="" class="navigation fl">
           		 <li style="background:#b1191a" class="all_sort_bar"><a href="javascript:;" style="width:114px">全部商品分类</a></li>
                <li class="" id="menu-item-1"><a href="/">首页</a></li><?php $ad = getAd('nav',99,$adlist) ?>
                <?php if($ad){ ?>
                <?php if(is_array($ad)): $i = 0; $__LIST__ = $ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li class="nav_sub_sort_bar"><a href="<?php echo ($data["url"]); ?>"><?php echo ($data["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php }else{ ?>
                <?php $type = array('1'=>'goods/goodslist','2'=>'article/artlist') ?>
            	<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li sort_id='<?php echo ($data[sort_id]); ?>' class="nav_sub_sort_bar" id="menu-item-<?php echo ($i); ?>"><a href="<?php echo U($type[$data['type']],array('id'=>$data['sort_id']));?>"><?php echo ($data['sort_name']); ?></a>
                <?php if($allsort['subsort'][$data['sort_id']]){ ?>
                	<div class="nav_sub_sort">
                    <?php if(is_array($allsort[subsort][$data[sort_id]])): $i = 0; $__LIST__ = $allsort[subsort][$data[sort_id]];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($type[$data['type']],array('id'=>$key));?>" style="padding:0;float:none"><div class="nav_sub_sort_li"><?php echo ($vo); ?></div></a><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                <?php } ?>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php } ?>
            </ul>
    
        <div class="clear"></div>
        <div id="all_sort" class="all_sort_bar" style="z-index: -1;">
           <div class="all_sort">
                                                 	<?php $allsort = IndexModel::I()->getAllSort(); foreach($allsort["allsort"] as $key=>$row){ ?>
                                 <ul class="display_cate cate_3_bar">
                                      <li class="catebox cate_3_bar">
                                            <span class="top_cate"><a href="/goods/goodslist/id/<?php echo $row['sort_id']; ?>.html" target="_blank"><?php echo $row["sort_name"]; ?></a></span>
                                                <ul>
                                                <?php if($allsort["subsort"][$row["sort_id"]]){ foreach($allsort["subsort"][$row["sort_id"]] as $sort_arr){ ?>
                                                <li class="sub_cate"><a href="/goods/goodslist/id/<?php echo $sort_arr['sort_id']; ?>.html" target="_blank"><?php echo $sort_arr["sort_name"]; ?></a></li>
                                                <?php }} ?>
                                                    
                                                 <div class="clear"></div>
                                                </ul>
                                     </li>
        
                                    </ul>
                                    <?php } ?>
           </div>
        </div> 
       </div>
        
 </div>
	
    
</div>
<!-- /页头 -->

    <div class="clear"></div>
    <div class="banner">
        <div style="width:1200px;margin:auto;height:0px;position:relative">
            <div style="z-index:2;position:absolute;left:0;">
                <div class="all_sort cate_3_bar index_all_sort">
				                                        	<?php $allsort = IndexModel::I()->getAllSort(); foreach($allsort["allsort"] as $key=>$row){ ?>
                                 <ul class="display_cate cate_3_bar">
                                      <li class="catebox cate_3_bar">
                                            <span class="top_cate"><a href="/goods/goodslist/id/<?php echo $row['sort_id']; ?>.html" target="_blank"><?php echo $row["sort_name"]; ?></a></span>
                                                <ul>
                                                <?php if($allsort["subsort"][$row["sort_id"]]){ foreach($allsort["subsort"][$row["sort_id"]] as $sort_arr){ ?>
                                                <li class="sub_cate"><a href="/goods/goodslist/id/<?php echo $sort_arr['sort_id']; ?>.html" target="_blank"><?php echo $sort_arr["sort_name"]; ?></a></li>
                                                <?php }} ?>
                                                    
                                                 <div class="clear"></div>
                                                </ul>
                                     </li>
        
                                    </ul>
                                    <?php } ?>
				</div>
                <div class="morecate">查看更多</div>
            </div>

            <div class="clear"></div>
        </div>
        <div class="focus">
        <div class="adv_13">
          <div id="slideBox" class="slideBox">
          	<?php $ad = getAd('slide',99,$adlist); ?>
            <div class="hd">
            	<ul>
                	<?php for($i=1;$i<=count($ad);$i++){ ?>
                		<li class=""><?php echo $i ?></li>
                    <?php } ?>        
                 </ul>
            </div>
            <div class="bd">
                <div class="tempWrap">
                    <div class="tempWrap" style="overflow:hidden; position:relative; width:1349px">
                    <ul style="width: 5396px; position: relative; overflow: hidden; padding: 0px; margin: 0px; left: -1349px;">
                    <?php foreach($ad as $ad_arr){ ?>	
                       <li style="float: left; width: 1349px;">
                            <a href="javascript:;" target="_blank"><img src="<?php echo ($ad_arr["pic_url"]); ?>"></a>
                        </li>
                     <?php } ?>   
                        </ul></div>
                </div>
            </div>
    	</div>
        </div>
        </div>
    </div>
    
    <div class="main_content">
    	<div class="ad_box">
            <div class="tit">品牌特卖</div>
              <a href="javascript:;" target="_blank"><img src="__PUBLIC__/image/55b20334a967f.jpg"></a><a href="javascript:;" target="_blank"><img src="__PUBLIC__/image/55b203437387d.jpg"></a><a href="javascript:;" target="_blank"><img src="__PUBLIC__/image/55b2037bbd839.jpg"></a>            				          </div>
        <div class="ad_box2">
        	<div class="tab_bar">
            	<a href=""><div class="bar" id="bar1" style="border-bottom:none;color:#ff6600;background:#fff;">今日推荐</div></a>
            	<a href=""><div class="bar" id="bar2">疯狂抢购</div></a>
            	<a href=""><div class="bar" id="bar3">天天热卖</div></a>
            	<a href=""><div class="bar" id="bar4">非常划算</div></a>
            	<a href=""><div class="bar" id="bar5">不要错过</div></a>
                <div class="clear"></div>
            </div>
            <div class="ad_content" style="display:block;" id="c_bar1">
 				<?php if($recommend1["goods"]){foreach($recommend1["goods"] as $row){ ?>
                <a href="<?php echo $row['item_url']; ?>"><div class="ad_goods">
                	<img src="<?php echo $row['pic_url']; ?>">
                    <span class="price">￥<?php if($row['discount_price']>0){echo bcmul($row['discount_price'], 1, 2);}else{echo bcmul($row['price'], 1, 2);} ?></span>
                    <div class="title"><?php echo msubstr($row['title'],0,16); ?></div>
                </div></a> 
                <?php }} ?>    
                <div class="clear"></div>
            </div>
            <div class="ad_content" id="c_bar2">
            <?php if($recommend2["goods"]){foreach($recommend2["goods"] as $row){ ?>
                <a href="<?php echo $row['item_url']; ?>"><div class="ad_goods">
                	<img src="<?php echo $row['pic_url']; ?>">
                    <span class="price">￥<?php if($row['discount_price']>0){echo bcmul($row['discount_price'], 1, 2);}else{echo bcmul($row['price'], 1, 2);} ?></span>
                    <div class="title"><?php echo msubstr($row['title'],0,16); ?></div>
                </div></a> 
                <?php }} ?>    
                <div class="clear"></div>
            </div>
            <div class="ad_content" id="c_bar3">
            <?php if($recommend3["goods"]){foreach($recommend3["goods"] as $row){ ?>
                <a href="<?php echo $row['item_url']; ?>"><div class="ad_goods">
                	<img src="<?php echo $row['pic_url']; ?>">
                    <span class="price">￥<?php if($row['discount_price']>0){echo bcmul($row['discount_price'], 1, 2);}else{echo bcmul($row['price'], 1, 2);} ?></span>
                    <div class="title"><?php echo msubstr($row['title'],0,16); ?></div>
                </div></a> 
                <?php }} ?>    
                <div class="clear"></div>
            </div>
            <div class="ad_content" id="c_bar4">
              <?php if($recommend4["goods"]){foreach($recommend4["goods"] as $row){ ?>
                <a href="<?php echo $row['item_url']; ?>"><div class="ad_goods">
                	<img src="<?php echo $row['pic_url']; ?>">
                    <span class="price">￥<?php if($row['discount_price']>0){echo bcmul($row['discount_price'], 1, 2);}else{echo bcmul($row['price'], 1, 2);} ?></span>
                    <div class="title"><?php echo msubstr($row['title'],0,16); ?></div>
                </div></a> 
                <?php }} ?>    
                <div class="clear"></div>
            </div>
            <div class="ad_content" id="c_bar5">
             <?php if($recommend5["goods"]){foreach($recommend5["goods"] as $row){ ?>
                <a href="<?php echo $row['item_url']; ?>"><div class="ad_goods">
                	<img src="<?php echo $row['pic_url']; ?>">
                    <span class="price">￥<?php if($row['discount_price']>0){echo bcmul($row['discount_price'], 1, 2);}else{echo bcmul($row['price'], 1, 2);} ?></span>
                    <div class="title"><?php echo msubstr($row['title'],0,16); ?></div>
                </div></a> 
                <?php }} ?>    
                <div class="clear"></div>
            </div>
        </div>
          <div class="goodslist">
        	<div class="tit"><a class="catename"><?php echo $good1["sort_arr"]["sort_name"]; ?></a><a href="/goods/goodslist/id/<?php echo $good1['sort_arr']['sort_id']; ?>.html" class="more">更多</a></div>
               <div class="goodscontent">
            	<ul>
                	<?php if($good1["goods"]){foreach($good1["goods"] as $row){ ?>
                	<a href="<?php echo $row['item_url']; ?>" target="_blank"><li>
                    	<img src="<?php echo $row['pic_url']; ?>" alt="<?php $row['title']; ?>" class="g_thumb">
                        <div class="title">
                        	<img src="__PUBLIC__/image/shouye_70.png">                           <?php echo msubstr($row['title'],0,20); ?></div>
                        <div class="discount_price fl"><span class="yin">￥</span><span class="dis_p"><?php if($row['discount_price']>0){echo bcmul($row['discount_price'], 1, 2);}else{echo bcmul($row['price'], 1, 2);} ?></span></div>
                        <div class="old_price fl">
                        	<span class="oprice"> <?php echo bcmul($row['price'], 1, 2); ?></span>
                            <span><?php echo sprintf( "%.2f",$row['discount_price']/$row['price'])*10; ?>折</span>
                        </div>
                        <div class="buy fr">去购买</div>
                        <div class="clear"></div>
                    </li></a>
                    <?php }} ?>
                   <div class="clear"></div>
                </ul>
            </div>
         </div>
         
         <div class="goodslist">
        	<div class="tit"><a class="catename"><?php echo $good2["sort_arr"]["sort_name"]; ?></a><a href="/goods/goodslist/id/<?php echo $good2['sort_arr']['sort_id']; ?>.html" class="more">更多</a></div>
               <div class="goodscontent">
            	<ul>
                	<?php if($good2["goods"]){foreach($good2["goods"] as $row){ ?>
                	<a href="<?php echo $row['item_url']; ?>" target="_blank"><li>
                    	<img src="<?php echo $row['pic_url']; ?>" alt="<?php $row['title']; ?>" class="g_thumb">
                        <div class="title">
                        	<img src="__PUBLIC__/image/shouye_70.png">                           <?php echo msubstr($row['title'],0,20); ?></div>
                        <div class="discount_price fl"><span class="yin">￥</span><span class="dis_p"><?php if($row['discount_price']>0){echo bcmul($row['discount_price'], 1, 2);}else{echo bcmul($row['price'], 1, 2);} ?></span></div>
                        <div class="old_price fl">
                        	<span class="oprice"> <?php echo bcmul($row['price'], 1, 2); ?></span>
                            <span><?php echo sprintf( "%.2f",$row['discount_price']/$row['price'])*10; ?>折</span>
                        </div>
                        <div class="buy fr">去购买</div>
                        <div class="clear"></div>
                    </li></a>
                    <?php }} ?>
                   <div class="clear"></div>
                </ul>
            </div>
           </div>
           <div class="goodslist">
        	<div class="tit"><a class="catename"><?php echo $good4["sort_arr"]["sort_name"]; ?></a><a href="/goods/goodslist/id/<?php echo $good4['sort_arr']['sort_id']; ?>.html" class="more">更多</a></div>
               <div class="goodscontent">
            	<ul>
                	<?php if($good4["goods"]){foreach($good4["goods"] as $row){ ?>
                	<a href="<?php echo $row['item_url']; ?>" target="_blank"><li>
                    	<img src="<?php echo $row['pic_url']; ?>" alt="<?php $row['title']; ?>" class="g_thumb">
                        <div class="title">
                        	<img src="__PUBLIC__/image/shouye_70.png">                           <?php echo msubstr($row['title'],0,20); ?></div>
                        <div class="discount_price fl"><span class="yin">￥</span><span class="dis_p"><?php if($row['discount_price']>0){echo bcmul($row['discount_price'], 1, 2);}else{echo bcmul($row['price'], 1, 2);} ?></span></div>
                        <div class="old_price fl">
                        	<span class="oprice"> <?php echo bcmul($row['price'], 1, 2); ?></span>
                            <span><?php echo sprintf( "%.2f",$row['discount_price']/$row['price'])*10; ?>折</span>
                        </div>
                        <div class="buy fr">去购买</div>
                        <div class="clear"></div>
                    </li></a>
                    <?php }} ?>
                   <div class="clear"></div>
                </ul>
            </div>
          </div>         
           <div class="goodslist">
        	<div class="tit"><a class="catename"><?php echo $good3["sort_arr"]["sort_name"]; ?></a><a href="/goods/goodslist/id/<?php echo $good3['sort_arr']['sort_id']; ?>.html" class="more">更多</a></div>
               <div class="goodscontent">
            	<ul>
                	<?php if($good3["goods"]){foreach($good3["goods"] as $row){ ?>
                	<a href="<?php echo $row['item_url']; ?>" target="_blank"><li>
                    	<img src="<?php echo $row['pic_url']; ?>" alt="<?php $row['title']; ?>" class="g_thumb">
                        <div class="title">
                        	<img src="__PUBLIC__/image/shouye_70.png">                           <?php echo msubstr($row['title'],0,20); ?></div>
                        <div class="discount_price fl"><span class="yin">￥</span><span class="dis_p"><?php if($row['discount_price']>0){echo bcmul($row['discount_price'], 1, 2);}else{echo bcmul($row['price'], 1, 2);} ?></span></div>
                        <div class="old_price fl">
                        	<span class="oprice"> <?php echo bcmul($row['price'], 1, 2); ?></span>
                            <span><?php echo sprintf( "%.2f",$row['discount_price']/$row['price'])*10; ?>折</span>
                        </div>
                        <div class="buy fr">去购买</div>
                        <div class="clear"></div>
                    </li></a>
                    <?php }} ?>
                   <div class="clear"></div>
                </ul>
            </div>
          </div>         
                    
         
                    
  </div>
    

<div style="display: none;" class="side_right fix">
        <div class="con">
            
            <a target="_blank" class="trigger " style="" href="javascript:;">
                <p>消费<br>
                    保障</p>
                <span><i class="sicon sicon-02"></i></span> </a>
            
            <a class="trigger go-top" href="javascript:;">
                <p>回到<br>顶部</p>
                <span><i class="sicon sicon-03"></i></span>
            </a>
    </div>
</div>
<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/Home/Tpl/b2r/",
    JS_ROOT: "statics/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="__PUBLIC__/js/jquery.js"></script>
    <script src="__PUBLIC__/js/wind.js"></script>
    <script src="__PUBLIC__/js/bootstrap.min.js"></script>
    <script src="__PUBLIC__/js/frontend.js"></script>
    <script src="__PUBLIC__/js/waypoints.js"></script>
    <script src="__PUBLIC__/js/lazyload.js"></script>
    <script src="__PUBLIC__/js/jquery.form.js"></script>
	<!-- 页脚 -->
	
<!-- 页脚 -->
<div class="foot">
    <div class="white_bg">
        <div class="foot-con">
            <div class="con-box-n clear">
                <div class="app-side-box fl">
                    <?php $ad=getAd('erweima',1,$adlist);$ad=$ad[0];if($ad){ ?>
                    <p class="app-show">                        
                        <a href='<?php echo ($ad["url"]); ?>' <?php echo ($ad['blank']?'target="_blank"':''); ?>><img src="<?php echo ($ad["pic_url"]); ?>" style="width:90px;height:90px;"></a>
                    </p>
                    <p class="app-txt"><?php echo ($ad["title"]); ?></p>
                    <?php } ?>
                </div>
                <div class="con-left-info fl">
                    <dl class="update">
                        <dt><?php echo ($articleSort[0]['sort_name']); ?></dt>
                        <?php $d0 = $article[$articleSort[0]['sort_id']];?>
                        <?php if(is_array($d0)): $i = 0; $__LIST__ = $d0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><dd><a target="_blank" href="<?php echo U('article/detail',array('aid'=>$data['aid']));?>"><i></i><?php echo cutstr($data['title'],28);?></a></dd><?php endforeach; endif; else: echo "" ;endif; ?>
                        
                    </dl>
                    <dl class="cooperation">
                        <dt><?php echo ($articleSort[1]['sort_name']); ?></dt>
                        <?php $d1 = $article[$articleSort[1]['sort_id']];?>
                        <?php if(is_array($d1)): $i = 0; $__LIST__ = $d1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><dd><a target="_blank" href="<?php echo U('article/detail',array('aid'=>$data['aid']));?>"><i></i><?php echo cutstr($data['title'],28);?></a></dd><?php endforeach; endif; else: echo "" ;endif; ?>
                    </dl>
                    <dl class="cor-info">
                        <dt><?php echo ($articleSort[2]['sort_name']); ?></dt>
                        <?php $d2 = $article[$articleSort[2]['sort_id']];?>
                        <?php if(is_array($d2)): $i = 0; $__LIST__ = $d2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><dd><a target="_blank" href="<?php echo U('article/detail',array('aid'=>$data['aid']));?>"><i></i><?php echo cutstr($data['title'],28);?></a></dd><?php endforeach; endif; else: echo "" ;endif; ?>
                    </dl>
                    <dl class="cor-info">
                        <dt><?php echo ($articleSort[3]['sort_name']); ?></dt>
                        <?php $d3 = $article[$articleSort[3]['sort_id']];?>
                        <?php if(is_array($d3)): $i = 0; $__LIST__ = $d3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><dd><a target="_blank" href="<?php echo U('article/detail',array('aid'=>$data['aid']));?>"><i></i><?php echo cutstr($data['title'],28);?></a></dd><?php endforeach; endif; else: echo "" ;endif; ?>
                    </dl>
                </div>
                <div class="con-menu fr">
                    <?php if($setting['online_kefu']){ ?>
                        <a class="service-add fl" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($setting['online_kefu']); ?>&site=qq&menu=yes" target="_top" rel="nofollow"></a>
                    <?php } ?>
                </div>
            </div>            
            <div class="links"><?php $ad=getAd('flink',99,$adlist) ?>
                <span>友情链接：</span>
                <div class="links_list_box">
                    <ul style="margin-top: 0px;" class="links_list">
                        <?php if(is_array($ad)): foreach($ad as $key=>$vo): ?><li><a href="<?php echo ($vo["url"]); ?>" <?php if($vo['blank']){ ?>target='_blank'<?php } ?>><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; ?>
                    </ul>
                </div>
            </div>
          <!--  <p class="ft-company"><?php echo ($setting['site_copyright']); ?></p> -->
            <p class="ft-company"><?php echo ($setting['site_icp']); ?></p>
            <div class="logo">
                <a rel="nofollow" target="_top" href="#">
                    <img src="__TMPL__statics/images/r_315online.gif" border="0">
                </a>
                <a rel="nofollow" target="_top" href="#">
                    <img src="__TMPL__statics/images/r_cnnic.gif" border="0">
                </a>
                <a rel="nofollow" target="_top" key="5492626c3b05a3da0fbd05fe" logo_size="124x47" logo_type="realname" href="#">
                    <span style="display: none;" class="LOGO_aq_jsonp_wrap_" id="AQ_logo_span_init_1">
                    </span>
                    <img alt="安全联盟认证" style="border: medium none;" src="__TMPL__statics/images/sm_124x47.png" height="47" width="124">
                </a>
            </div>
        </div>
    </div>
</div>
<div style="display: none;" class="side_right fix">
        <div class="con">
            
            <a target="_blank" class="trigger " style="" href="javascript:;">
                <p>消费<br>
                    保障</p>
                <span><i class="sicon sicon-02"></i></span> </a>
            
            <a class="trigger go-top" href="javascript:;">
                <p>回到<br>顶部</p>
                <span><i class="sicon sicon-03"></i></span>
            </a>
    </div>
</div>
<?php echo stripslashes($setting['site_tongji']);?>


	<script>
        if(''==''){
            $(".nav li:first").css('background','#b1191a');
        }else{
            $(".nav li[sort_id='']").css({background:'#b1191a',borderTop:"4px solid #ff8800",height:"36px"});
        }
	$(function(){
   $("form[method!='get']").submit(function(){
            if(!submit) return false;
            $(this).ajaxSubmit({dataType:'json',
                beforeSubmit:function(){
                    submit = false;
                    showmsg('正在提交');
                },success:function(data){
                    submit = true;
                    if(data.state==1) setTimeout(function(){window.location.reload();},500);
                    showmsg(data.msg);
                }
            });
            return false;
        });              
		$('body').on('touchstart.dropdown', '.dropdown-menu', function (e) { e.stopPropagation(); });
	
		;(function($){
			$.fn.totop=function(opt){
				var scrolling=false;
				return this.each(function(){
					var $this=$(this);
					$(window).scroll(function(){
						if(!scrolling){
							var sd=$(window).scrollTop();
							if(sd>100){
								$this.fadeIn();
							}else{
								$this.fadeOut();
							}
						}
					});

				
					$this.click(function(){
						scrolling=true;
						$('html, body').animate({
							scrollTop : 0
						}, 500,function(){
							scrolling=false;
							$this.fadeOut();
						});
					});
				});
			};
		})(jQuery);
		$(".side_right").totop();
	});
	var F_totoptips = function(){
        var F_isMac = function(){
            if(navigator.userAgent.indexOf("Mac") > -1){
                $(".totop-tips strong").html("Command+d");
            }else{
                $('body').on("keydown",function(e){
                    if(e.ctrlKey && 68 == e.keyCode) {
                        ever_open();
                        return true;
                    }
                });
            }
        }
        var tips_close = function(){
            $("div.totop-tips").hide();
        }
        var ever_open = function(){
            setCookie("toptips","1", 1);
            tips_close();
        }
        if(getCookie("toptips") == null){
            $("div.totop-tips").show();
            $(".jiu-side-nav").css("top","196px");
            var $tips_a = $("div.totop-tips a")
            $tips_a.on("click",ever_open);
            $("div.totop-tips .closet").on("click",tips_close);
            F_isMac();
        }else{
            $("div.totop-tips").hide();
        }
    }
    F_totoptips();
</script>

<script>
var submit = true;
function ajHref(obj){
        if(!submit) return false;
        showmsg('正在提交');
        submit = false;
        $.get($(obj).attr('href'),function(data){
            submit = true;
            if(data.state==1) window.location.reload();//setTimeout(function(){window.location.reload();},500);
            showmsg(data.msg);
        },'json');
        return false;
}    
function favor(goodsid){
    $.get("/ajax/favor.html",{id:goodsid},function(json){
            showmsg(json.info);
    })    
}    
function showmsg(msg){
	$("#tip").remove();
	$tip = $('<div id="tip" style="font-weight:bold;position:fixed;top:240px;left: 50%;z-index:9999;background:rgb(25, 161, 219);padding:18px 30px;border-radius:8px;color:#fff;font-size:16px;">'+msg+'</div>');
    $('body').append($tip);
	$tip.stop(true).css('margin-left', -$tip.outerWidth() / 2).fadeIn(500).delay(2000).fadeOut(500);
}
</script>


<script type="text/javascript" src="__PUBLIC__/js/jquery.pack.blockUI.SuperSlide.js"></script>
<script type="text/javascript">$(".slideBox").slide( { mainCell:".bd ul",effect:"left",autoPlay:true} );</script>
<script>
    $("img.lazy").lazyload({threshold:0,failure_limit:30,placeholder : "/Home/Tpl/b2r/statics/images/blank.png",});
</script>
<script>
	$(".morecate,.cate_3_bar").hover(function(){
		var h = 0;
		$('.all_sort ul.display_cate').each(function(){
			h = h + $(this).height();
		})
		$('.all_sort').height(Math.max(h,390));
	},function(){});
	$('.cate_3_bar').mouseleave(function(){
		$('.all_sort').height(390);
	});
</script>
<script>
	$(function(){
		$('.bar').hover(function(){
			$('.bar').css({background:"#f9f9f9",borderBottom:'1px solid #ccc',color:"#5e5e5e"});
			$(this).css({background:"#fff",borderBottom:'none',color:"#ff6600"});
			$(".ad_content").hide();
			id = $(this).attr('id');
			$("#c_"+id).show();
		},function(){})
	})
</script>


</body></html>