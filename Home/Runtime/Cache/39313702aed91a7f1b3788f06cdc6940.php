<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0053)http://demo.xiaocaocms.com/article/artlist/id/15.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($sort['sort_name']); ?> - <?php echo ($setting['site_name']); ?></title>
<meta name="keywords" content="<?php echo ($setting[site_seo_keywords]); ?>">
<meta name="description" content="<?php echo ($setting[site_seo_description]); ?>">
<link href="__TMPL__statics/css/articlelist.css" type="text/css" rel="stylesheet">
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

</head>
<body class="">
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

<!--主体 start-->
<div class="container tc-main">
    <div class="pg-opt pin">
        <div class="container">
            <h2>
                <a href='<?php echo ($setting[site_domain]); ?>'>首页</a>
                &nbsp;&nbsp;>>&nbsp;&nbsp;
                <?php $parentSort = IndexModel::I()->getSortById($sort['p_id']); ?>
                <?php if($parentSort){ ?><a href="<?php echo U('article/artlist',array('id'=>$parentSort['sort_id']));?>"><?php echo ($parentSort['sort_name']); ?></a> &gt;<?php } ?>
                <a href="<?php echo U('article/artlist',array('id'=>ggp('id:i')));?>"><?php echo ($sort['sort_name']); ?></a>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="span9">
            <div class="" id="artlist">
            <ul>
             <?php if(is_array($artList)): $i = 0; $__LIST__ = $artList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li><a href="http://demo.xiaocaocms.com/article/detail/aid/724.html" target="_blank" class="pull-left"><a href="<?php echo U('article/detail',array('aid'=>$data['aid']));?>"><?php echo ($data[title]); ?></a></a><span class="pull-right"><?php echo date('Y-m-d',$data['ctime']);?></span><div class="clear"></div></li><?php endforeach; endif; else: echo "" ;endif; ?>
                 </ul>
            
            </div>
			<div class="pagination clear">
                <ul>    <!-- <li class="active"><a href="javascript:;" style="color:#fff">1</a></li><li><a href="http://demo.xiaocaocms.com/article/artlist/id/15/p/2.html">2</a></li><li><a href="http://demo.xiaocaocms.com/article/artlist/id/15/p/3.html">3</a></li><li><a href="http://demo.xiaocaocms.com/article/artlist/id/15/p/4.html">4</a></li><li><a href="http://demo.xiaocaocms.com/article/artlist/id/15/p/5.html">5</a></li><li><a href="http://demo.xiaocaocms.com/article/artlist/id/15/p/6.html">6</a></li><li><a href="http://demo.xiaocaocms.com/article/artlist/id/15/p/7.html">7</a></li> <li><a href="http://demo.xiaocaocms.com/article/artlist/id/15/p/2.html">下一页</a></li> <li><a href="http://demo.xiaocaocms.com/article/artlist/id/15/p/8.html">下7页</a></li> <li><a href="http://demo.xiaocaocms.com/article/artlist/id/15/p/33.html">最后一页</a></li> -->
                <?php echo ($page); ?>
                </ul>
            </div>
        </div>
        <div class="span3">
            <div class="tc-box first-box hotarticle">
                <div class="headtitle">
                    <h2>资讯导航</h2>
                </div>
                <div class="ranking">
                    <ul class="unstyled">
                                            <li><a href="/doc/商业资讯 - 大豆淘宝客_files/商业资讯 - 大豆淘宝客.htm">商业资讯</a></li><li><a href="http://demo.xiaocaocms.com/article/artlist/id/14.html">服务协议</a></li><li><a href="http://demo.xiaocaocms.com/article/artlist/id/13.html">小草保障</a></li><li><a href="http://demo.xiaocaocms.com/article/artlist/id/11.html">购物指南</a></li>                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--主体 end-->
<!-- 页脚 -->
<div class="foot">
    <div class="white_bg">
        <div class="foot-con">
            <div class="con-box-n clear">
                <div class="app-side-box fl">
                                    </div>
                <div class="con-left-info fl">
                    <dl class="update">
                        <dt>商业资讯</dt>
                                                <dd><a target="_blank" href="http://demo.xiaocaocms.com/article/detail/aid/724.html"><i></i>凯文·凯利预言移动互联网创业 ...</a></dd><dd><a target="_blank" href="http://demo.xiaocaocms.com/article/detail/aid/722.html"><i></i>
                        【 ...</a></dd><dd><a target="_blank" href="http://demo.xiaocaocms.com/article/detail/aid/721.html"><i></i>
                        201 ...</a></dd>                        
                    </dl>
                    <dl class="cooperation">
                        <dt>服务协议</dt>
                                                <dd><a target="_blank" href="http://demo.xiaocaocms.com/article/detail/aid/214.html"><i></i>券商涉足互联网金融 纷纷自建P ...</a></dd><dd><a target="_blank" href="http://demo.xiaocaocms.com/article/detail/aid/213.html"><i></i>互联网金融的核心要点 ...</a></dd><dd><a target="_blank" href="http://demo.xiaocaocms.com/article/detail/aid/212.html"><i></i>IDG合伙人李丰:中国互联网金融 ...</a></dd>                    </dl>
                    <dl class="cor-info">
                        <dt>小草保障</dt>
                                                <dd><a target="_blank" href="http://demo.xiaocaocms.com/article/detail/aid/36.html"><i></i>王慧星：云计算助力"互联网+ ...</a></dd><dd><a target="_blank" href="http://demo.xiaocaocms.com/article/detail/aid/35.html"><i></i>当电视厂商遇上"互联网+"： ...</a></dd><dd><a target="_blank" href="http://demo.xiaocaocms.com/article/detail/aid/34.html"><i></i>"互联网+"现政府工作报告 代 ...</a></dd>                    </dl>
                    <dl class="cor-info">
                        <dt>购物指南</dt>
                                                <dd><a target="_blank" href="http://demo.xiaocaocms.com/article/detail/aid/723.html"><i></i>6个美容小窍门拥有娇嫩妆容 ...</a></dd><dd><a target="_blank" href="http://demo.xiaocaocms.com/article/detail/aid/707.html"><i></i>媒体：部分央企全员降薪 330万 ...</a></dd><dd><a target="_blank" href="http://demo.xiaocaocms.com/article/detail/aid/706.html"><i></i>广西：新疆偷渡者中越边境袭警 ...</a></dd>                    </dl>
                </div>
                <div class="con-menu fr">
                                    </div>
            </div>            
            <div class="links">
                <span>友情链接：</span>
                <div class="links_list_box">
                    <ul style="margin-top: 0px;" class="links_list">
                                                                    </ul>
                </div>
            </div>
            <p class="ft-company">小草淘宝客版权所有</p>
            <p class="ft-company">苏C888888888</p>            
            <div class="logo">
                <a rel="nofollow" target="_top" href="http://demo.xiaocaocms.com/article/artlist/id/15.html#">
                    <img src="/doc/商业资讯 - 大豆淘宝客_files/r_315online.gif" border="0">
                </a>
                <a rel="nofollow" target="_top" href="http://demo.xiaocaocms.com/article/artlist/id/15.html#">
                    <img src="/doc/商业资讯 - 大豆淘宝客_files/r_cnnic.gif" border="0">
                </a>
                <a rel="nofollow" target="_top" key="5492626c3b05a3da0fbd05fe" logo_size="124x47" logo_type="realname" href="http://demo.xiaocaocms.com/article/artlist/id/15.html#">
                    <span style="display: none;" class="LOGO_aq_jsonp_wrap_" id="AQ_logo_span_init_1">
                    </span>
                    <img alt="安全联盟认证" style="border: medium none;" src="/doc/商业资讯 - 大豆淘宝客_files/sm_124x47.png" height="47" width="124">
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
    <script src="__PUBLIC__/js/jquery.js"></script>
    <script src="__PUBLIC__/js/wind.js"></script>
    <script src="__PUBLIC__/js/bootstrap.min.js"></script>
    <script src="__PUBLIC__/js/frontend.js"></script>
    <script src="__PUBLIC__/js/waypoints.js"></script>
    <script src="__PUBLIC__/js/lazyload.js"></script>
    <script src="__PUBLIC__/js/jquery.form.js"></script>

	<script>
        if('15'==''){
            $(".nav li:first").css('background','#b1191a');
        }else{
            $(".nav li[sort_id='15']").css({background:'#b1191a',borderTop:"4px solid #ff8800",height:"36px"});
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
$(function(){
     
		
	$(".all_sort_bar").hover(function(){
		$("#all_sort").css({zIndex:"99999"});
	},function(){
		$("#all_sort").css({zIndex:"-1"});
	});
})
</script>
<script>
$(function(){
	$(".sub_sort_bar").hover(function(){
		$(this).children(".sub_sort").show();
		$(this).children('a').children('li').addClass('sub_sort_bar_hover');
	},function(){
		$(this).children(".sub_sort").hide();
		$(this).children('a').children('li').removeClass('sub_sort_bar_hover');
	});
	$(".nav_sub_sort_bar").hover(function(){
		$(this).addClass('nav_bar_hover');
		w1 = $(this).width();
		w2 = $(this).children(".nav_sub_sort").width();
		$(this).children(".nav_sub_sort").css({marginLeft:(w1-w2)*0.5});
		$(this).children(".nav_sub_sort").slideDown("fast");
	},function(){
		$(this).children(".nav_sub_sort").hide();
		$(this).removeClass('nav_bar_hover');
	});
	
	$('.display_cate').hover(function(){
		$(this).children('.catebox').css({background:"#fff"});
		cate3_obj= $(this).children('.cate_3');
		h2 = cate3_obj.height();
		
		cate3_obj.css({height:h2})
		all_sort_obj = $('.all_sort')
		all_sort_obj.width(967);
		cate3_obj.show();
		if(cate3_obj.css('display')=='block'){
			cate3_offset_top = cate3_obj.offset().top;
			if(cate3_offset_top<161){
				cate3_obj.css({top:"0"});
				h1 = $('.display_cate:last').offset().top+$('.display_cate:last').height();
				
				h3 = cate3_obj.offset().top;
				if(h1-h2-h3<15){
					cate3_obj.offset({top:202})
				}
			}
		}
		cate3_obj.css({background:"#fff"})
	},function(){
		$(this).children('.cate_3').hide();	
		$('.all_sort').width(195);
		$(this).children('.catebox').css({background:"#f1262e"})
	});
})
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



</body></html>