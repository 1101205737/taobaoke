<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>后台管理</title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- basic styles -->
		<link href="<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/css/font-awesome.min.css" />
                <script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>
		<!--[if IE 7]>
		  <link rel="stylesheet" href="<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<!-- fonts -->

                <link href="<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/css/css.css" rel="stylesheet" />

		<!-- ace styles -->

		<link rel="stylesheet" href="<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/css/ace.min.css" />
		<link rel="stylesheet" href="<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->

		<script src="<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/js/html5shiv.js"></script>
		<script src="<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<div class="navbar navbar-default" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="<?php echo U('admin/index');?>" class="navbar-brand">
						<small>
							<i class="icon-leaf"></i>
							小草淘宝客后台管理系统
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->

				<div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>欢迎光临,</small>
									<?php echo ($my['uname']); ?>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="<?php echo U('admin/settingperson');?>">
										<i class="icon-cog"></i>
										个人设置
									</a>
								</li>	
                                <li>
									<a href="/" target="_blank">
										<i class="icon-home"></i>
										前台首页
									</a>
								</li>								

								<li class="divider"></li>

								<li>
									<a href="<?php echo U('admin/dologout');?>">
										<i class="icon-off"></i>
										退出
									</a>
								</li>
							</ul>
						</li>
					</ul><!-- /.ace-nav -->
				</div><!-- /.navbar-header -->
			</div><!-- /.container -->
		</div>
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>

    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>
        <div class="sidebar" id="sidebar">
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'fixed')
        } catch (e) {
        }
    </script>
    <ul class="nav nav-list">        

        <li>
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> 商品管理 </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">
                <li>
                    <a href="<?php echo U('admin/goodslist');?>">
                        <i class="icon-double-angle-right"></i>
                        商品列表
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('admin/addgoods');?>">
                        <i class="icon-double-angle-right"></i>
                        添加商品
                    </a>
                </li>
            </ul>
        </li>
        
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="icon-group"></i>
                <span class="menu-text"> 用户管理 </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">
                <li class="">
                    <a href="<?php echo U('admin/userlist');?>">
                        <i class="icon-double-angle-right"></i>
                        用户列表
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('admin/adduser');?>">
                        <i class="icon-double-angle-right"></i>
                        添加用户
                    </a>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="icon-cogs"></i>
                <span class="menu-text"> 系统设置 </span>
                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo U('admin/settingperson');?>">
                        <i class="icon-double-angle-right"></i>
                        个人信息
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('admin/settingsite');?>">
                        <i class="icon-double-angle-right"></i>
                        网站信息
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('admin/settingseo');?>">
                        <i class="icon-double-angle-right"></i>
                        SEO设置
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('admin/settingurl');?>">
                        <i class="icon-double-angle-right"></i>
                        URL模式
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('admin/settingscore');?>">
                        <i class="icon-double-angle-right"></i>
                        积分设置
                    </a>
                </li>
                
                <li>
                    <a href="<?php echo U('admin/settingqq');?>">
                        <i class="icon-double-angle-right"></i>
                        QQ登录设置
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('admin/settingmail');?>">
                        <i class="icon-double-angle-right"></i>
                        邮箱设置
                    </a>
                </li>
                
                <li>
                    <a href="<?php echo U('admin/clearcache');?>">
                        <i class="icon-double-angle-right"></i>
                        清除缓存
                    </a>
                </li>
            </ul>
        </li>


        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="icon-tags"></i>
                <span class="menu-text"> 分类管理 </span>
                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo U('admin/sortlist');?>">
                        <i class="icon-double-angle-right"></i>
                        分类列表
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('admin/addsort');?>">
                        <i class="icon-double-angle-right"></i>
                        添加分类
                    </a>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="icon-book"></i>
                <span class="menu-text"> 内容管理 </span>
                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo U('admin/articlelist');?>">
                        <i class="icon-double-angle-right"></i>
                        文章列表
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('admin/addarticle');?>">
                        <i class="icon-double-angle-right"></i>
                        添加文章
                    </a>
                </li>
                
            </ul>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="icon-bullhorn"></i>
                <span class="menu-text"> 广告管理 </span>
                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo U('admin/addad');?>">
                        <i class="icon-double-angle-right"></i>
                        添加广告
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('admin/adlist');?>">
                        <i class="icon-double-angle-right"></i>
                        广告列表
                    </a>
                </li>
            </ul>
        </li>        
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="icon-coffee"></i>
                <span class="menu-text"> 积分商城 </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">
                <li class="">
                    <a href="<?php echo U('admin/jfgoodslist');?>">
                        <i class="icon-double-angle-right"></i>
                        商品列表
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('admin/addjfgoods');?>">
                        <i class="icon-double-angle-right"></i>
                        添加商品
                    </a>
                </li>
                
                <li>
                    <a href="<?php echo U('admin/jfloglist');?>">
                        <i class="icon-double-angle-right"></i>
                        兑换信息
                    </a>
                </li>
            </ul>
        </li>                       
    </ul>
    <script type="text/javascript">
        <?php if($my['uid']>1){ ?>
        $('.submenu li').hide();
        <?php } ?>
        <?php $myqx = unserialize($my['qx']); foreach($myqx as $val){ ?>
            $('a[href^="'+'<?php echo U("$mod/$val");?>'+'"]').parent().show();
        <?php } ?>
        var obj = $('a[href^="'+'<?php echo U("$mod/$act");?>'+'"]');
        var o1 = obj.parent();
        var o2 = obj.parent().parent().parent();
        o2.addClass('active').addClass('open');
        o1.addClass('active');
        
        var m1 = o2.find('.menu-text').html();
        var m2 = o1.find('a').html();        
    </script>
    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
    </div>
</div>
        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try {
            ace.settings.check('breadcrumbs', 'fixed')
        } catch (e) {
        }
    </script>

    <ul class="breadcrumb">
        <li>
            <i class="icon-home home-icon"></i>主页
        </li>
        <li></li>
        <li class="active"></li>
    </ul><!-- .breadcrumb -->
</div>
<style type="text/css">
    .breadcrumb .active i{display:none;}
</style>
<script type="text/javascript">
    var m1 = o2.find('.menu-text').html();
    var m2 = o1.find('a').html();        
    $("#breadcrumbs .breadcrumb li:eq(1)").html(m1);
    $("#breadcrumbs .breadcrumb li:eq(2)").html(m2);
</script>
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->                        
                        <form class="form-horizontal" role="form" action="<?php echo U('admin/settingsite');?>" method="post" enctype="multipart/form-data">
                            <?php echo setParam(array('op'=>'do'));?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">网站LOGO<span style="color:#f00;">*</span></label>
                                <div class="col-sm-9">
                                <input  class="col-sm-12" type="file" name="site_logo" />    
                                </div>
                            </div>
                            <?php if($setting['site_logo']){ ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1"></label>
                                <div class="col-sm-9">
                                <img src='<?php echo ($setting[site_logo]); ?>' style='width:280px;height:280px;' />
                                </div>
                            </div>
                            <?php } ?>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">网站名称<span style="color:#f00;">*</span></label>
                                <div class="col-sm-9"><input class="col-sm-12" type="text" name="site_name" value="<?php echo ($setting['site_name']); ?>"></div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">网站域名<span style="color:#f00;">*</span></label>
                                <div class="col-sm-9"><input class="col-sm-12" type="text" name="site_domain" value="<?php echo ($setting['site_domain']); ?>"></div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">网站邮箱<span style="color:#f00;">*</span></label>
                                <div class="col-sm-9"><input class="col-sm-12" type="text" name="site_admin_email" value="<?php echo ($setting['site_admin_email']); ?>"></div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">在线客服<span style="color:#f00;">*</span></label>
                                <div class="col-sm-9"><input class="col-sm-12" type="text" name="online_kefu" value="<?php echo ($setting['online_kefu']); ?>"></div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">备案信息<span style="color:#f00;">*</span></label>
                                <div class="col-sm-9"><input class="col-sm-12" type="text" name="site_icp" value="<?php echo ($setting['site_icp']); ?>"></div>
                            </div>
                                                                                    
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">统计代码<span style="color:#f00;">*</span></label>
                                <div class="col-sm-9">
                                    <textarea class="col-sm-12" name='site_tongji'><?php echo stripslashes($setting['site_tongji']);?></textarea>
                                </div>   
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">版权信息<span style="color:#f00;">*</span></label>
                                <div class="col-sm-9"><input class="col-sm-12" type="text" name="site_copyright" value="<?php echo ($setting['site_copyright']); ?>"></div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">API_KEY<span style="color:#f00;">*</span></label>
                                <div class="col-sm-9"><input class="col-sm-12" type="text" name="tb_api_key" value="<?php echo ($setting['tb_api_key']); ?>"></div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">API_SECRET<span style="color:#f00;">*</span></label>
                                <div class="col-sm-9"><input class="col-sm-12" type="text" name="tb_api_secret" value="<?php echo ($setting['tb_api_secret']); ?>"></div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">PID<span style="color:#f00;">*</span></label>
                                <div class="col-sm-9"><input class="col-sm-12" type="text" name="tb_api_pid" value="<?php echo ($setting['tb_api_pid']); ?>"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label no-padding-right">模板风格<span style="color:#f00;">*</span></label>
                                <div class="col-sm-9">
                                    <select class="col-sm-12" name="theme">
                                        <?php if(is_array($site_tpl)): $i = 0; $__LIST__ = $site_tpl;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><option value="<?php echo ($data); ?>"><?php echo ($data); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                    <script type='text/javascript'>
                                        $("select[name='theme'] option[value='<?php echo $setting[theme] ?>']").attr('selected','selected');
                                    </script>
                                </div>
                            </div>                                                        

                            <div class="clearfix form-actions">
                                <div class="col-md-offset-4 col-md-4">
                                    <button class="btn btn-info btn-block" type="submit">
                                        <i class="icon-ok bigger-110"></i>
                                        确认
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div><!-- /.main-content -->
    </div><!-- /.main-container-inner -->
    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="icon-double-angle-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->
<script>
    $(function () {
        $('input[type="file"]').ace_file_input({
            no_file: 'No File ...',
            btn_choose: 'Choose',
            btn_change: 'Change',
            droppable: false,
            onchange: null,
            thumbnail: false //| true | large
                    //whitelist:'gif|png|jpg|jpeg'
                    //blacklist:'exe|php'
                    //onchange:''
                    //
        });
    });

</script>
<!-- basic scripts -->

		<!--[if !IE]> -->

		<script src="<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/js/jquery-2.0.3.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/js/jquery-1.10.2.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->

		

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/js/bootstrap.min.js"></script>
		<script src="<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/js/typeahead-bs2.min.js"></script>
		<!-- page specific plugin scripts -->
		<!-- ace scripts -->
		<script src="<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/js/ace-elements.min.js"></script>
		<script src="<?php echo APP_PATH;?>Tpl/<?php echo C('DEFAULT_THEME');?>/_static/admin/assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->	
        <script src="public/date/js/lhgcalendar.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="/public/js/jquery.form.js"></script>
    <link href="public/date/css/lhgcalendar.css" rel="stylesheet" type="text/css">
    <script>
    var submit = true;
    $(function(){
        $('.date').calendar();        
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
        
    });
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
    
    function showmsg(msg){
	$("#tip").remove();
	$tip = $('<div id="tip" style="font-weight:bold;position:fixed;top:240px;left: 50%;z-index:9999;background:rgb(111, 179, 224);padding:18px 30px;border-radius:8px;color:#fff;font-size:16px;">'+msg+'</div>');
        $('body').append($tip);
	$tip.stop(true).css('margin-left', -$tip.outerWidth() / 2).fadeIn(500).delay(2000).fadeOut(500);
    }
    function changesort($type){
        $("#p_id option[root=1]").hide();
        $("#p_id option[type='"+$type+"']").show();
    }
    </script>
</body>
</html>