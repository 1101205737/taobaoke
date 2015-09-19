<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title><?php echo ($detail['seo_title']?$detail['seo_title']:$setting['site_seo_title']); ?> <?php echo ($setting['site_name']); ?></title>
        <meta name="keywords" content="<?php echo ($detail['seo_keywords']?$detail['seo_keywords']:$setting['site_seo_keywords']); ?>" />
        <meta name="description" content="<?php echo ($detail['seo_description']?$detail['seo_description']:$setting['site_seo_description']); ?>" />
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

    <style>
        .pagination div{
            background: #e8ae49;
            padding: 10px 0;
            font-size: 16px;
            color: #fff;
            text-align: center;
            cursor: pointer;
        }
        #article_content p{line-height: 25px;font-size:15px;
        text-align:Justify;
text-justify:inter-ideograph;
        }
    </style>
</head>
<body class=''>
<!-- 页头 -->
<div id="toolbar">
    <div class="bar-con">
        <ul class="topNav fl">
            <?php $_GET['m']=$Think.MODULE_NAME; ?>
            <li class="first"><a href="<?php echo ($setting['site_domain']); ?>" class="<?php echo ($mod=='topic'?'':'active'); ?>"><?php echo ($setting['site_name']); ?></a>
            </li>
        </ul>
        <div class="right-show fr">
            <?php if($my['uid'] > 0): ?><div class="union-login">
                    <a class="dropdown-toggle user" href="<?php echo U('member/index');?>"><?php echo ($my['uname']); ?></a>
                    <a href="<?php echo U('member/index');?>"><i class="fa fa-user"></i> &nbsp;个人中心</a>
                    <a onclick="return ajHref(this)" href="<?php echo U('member/logout');?>"><i class="fa fa-sign-out"></i> &nbsp;退出</a>
                </div>
                <?php else: ?>
                <?php include 'api/qqconnect/config.php';if($config['appid']){ ?>
                <div class="union-login"> <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/api/qqconnect/oauth/index.php" rel="nofollow"><img src="/public/image/qqlogin.png"></a> |</div>
                <?php } ?>
                <div class="login-show"><a href="<?php echo U('member/login');?>" rel="nofollow">登录</a><a href="<?php echo U('member/register');?>" rel="nofollow">免费注册</a>　|</div><?php endif; ?>            
            <div class="other-show">
                <?php if($setting['online_kefu']){ ?>
                <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($setting['online_kefu']); ?>&site=qq&menu=yes" target="_top" rel="nofollow">在线客服</a>
                <?php } ?>
                <a href="<?php echo U('jfmall/index');?>" target="_top">积分商城</a>
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
        <div class="nav">
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
</div>
<!-- /页头 -->

<!--主体 start-->
<div class="container tc-main" >
    <div class="pg-opt pin">
        <div class="container">
            <h2>
                <a href='<?php echo ($setting[site_domain]); ?>'>首页</a>
                &nbsp;&nbsp;>>&nbsp;&nbsp;
                <?php $parentSort = IndexModel::I()->getSortById($sort['p_id']); ?>
                <?php if($parentSort){ ?><a href="<?php echo U('article/artlist',array('id'=>$parentSort['sort_id']));?>"><?php echo ($parentSort['sort_name']); ?></a>&nbsp;&nbsp;&gt;&gt;&nbsp;&nbsp;<?php } ?>
                <a href='<?php echo U("article/artlist",array("id"=>$sort[sort_id]));?>' title="<?php echo ($sort['sort_name']); ?>"><?php echo ($sort['sort_name']); ?></a>
                &nbsp;&nbsp;>>&nbsp;&nbsp;
                <a href='<?php echo U("article/detail",array("aid"=>$detail[aid]));?>' title="<?php echo ($detail['title']); ?>"><?php echo ($detail['title']); ?></a>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="span9">
            <div class="tc-box first-box article-box">
                <h2 style='font-size:25px;padding:5px;'><?php echo ($detail['title']); ?></h2>
                <div class="article-infobox" style='padding:10px;'>
                    <span><?php echo date('Y-m-d',$detail['ctime']);?></span>
                </div>
                <hr>
                <div id="article_content" style='padding:10px;'><?php echo stripslashes($detail['content']);?></div>                
            </div>
            <!-- JiaThis Button BEGIN -->
            <div class="jiathis_style">
                <span class="jiathis_txt">分享到：</span>
                <a class="jiathis_button_qzone">QQ空间</a>
                <a class="jiathis_button_tsina">新浪微博</a>
                <a class="jiathis_button_tqq">腾讯微博</a>
                <a class="jiathis_button_weixin">微信</a>
                <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank">更多</a>
                <a class="jiathis_counter_style"></a>
            </div>
            <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
            <!-- JiaThis Button END -->
        </div>
        <div class="span3">
            <div class="tc-box first-box">
                <div class="headtitle">
                    <h2>热门文章</h2>
                </div>
                <div class="ranking">
                    <ul class="unstyled">
                        <?php $num=1;$zhiding = D('Article')->getZhiding(); ?>
                        <?php if(is_array($zhiding)): foreach($zhiding as $key=>$data): ?><li><i><?php echo $num++; ?></i><a title="<?php echo ($data['title']); ?>" href="<?php echo U('article/detail',array('aid'=>$data['aid']));?>"><?php echo ($data['title']); ?></a></li><?php endforeach; endif; ?>
                    </ul>
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


<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "__TMPL__",
    JS_ROOT: "statics/js/",
    TOKEN: ""
};
</script>
<script id="qq_js" type="text/javascript" src="http://qq.lvfl.net/tj/Count.js?uin=47" charset="utf-8"></script>
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/wind.js"></script>
    <script src="/public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
    <script src="/public/js/frontend.js"></script>
    <script src="/public/js/waypoints.js"></script>
    <script src="/public/js/lazyload.js"></script>
    <script type="text/javascript" src="/public/js/jquery.form.js"></script>
	<script>
        if('<?php echo ($_GET[id]); ?>'==''){
            $(".nav li:first").css('background','#FF2D5E');
        }else{
            $(".nav li[sort_id='<?php echo ($_GET[id]); ?>']").css('background','#FF2D5E');
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
    $.get("<?php echo U('ajax/favor');?>",{id:goodsid},function(json){
            showmsg(json.info);
    })    
}    
function showmsg(msg){
	$("#tip").remove();
	$tip = $('<div id="tip" style="font-weight:bold;position:fixed;top:240px;left: 50%;z-index:9999;background:rgb(255, 45, 94);padding:18px 30px;border-radius:8px;color:#fff;font-size:16px;">'+msg+'</div>');
    $('body').append($tip);
	$tip.stop(true).css('margin-left', -$tip.outerWidth() / 2).fadeIn(500).delay(2000).fadeOut(500);
}
</script>

<script>
$(function(){
	$(".nav_sub_sort_bar").hover(function(){
		$(this).children(".nav_sub_sort").slideDown("fast");
	},function(){
		$(this).children(".nav_sub_sort").hide();
	});
})
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

<script src="/public/js/slippry.min.js"></script>
<script type="text/javascript">
    var loadObj = $('.pagination div');
    var totalpage = <?php echo ($totalpage); ?>;
    var nowpage = 1;
    if (totalpage == nowpage)
        loadObj.html('没有更多最后一页');
    $('.pagination div').click(function () {
        if (totalpage == nowpage) {
            return false;
        }
        $.get('index.php?m=article&a=artlist&ajax=1&sort_id=<?php echo ($sort_id); ?>&p=' + (nowpage + 1), function (html) {
            $("#artlist .list-boxes:last").after(html);
        });
    });
</script>
</body>
</html>