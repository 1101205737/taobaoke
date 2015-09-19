;
(function(a) {
    var f = {};
    /**
     * fangfang id为'alert_login'的已经更改为'alert_landing',此函数的功能应为当用户名存在时，
     用户名输入框显示其用户名
     * @param {}
     * @time 2014-02-10
     */
    XD.autoGetUsername = function() {
        var un = "s_name";
        var user = XDTOOL.getCookie(un);
        user = decodeURIComponent(user);
        obj = $("#alert_landing input[name='username']");
        if (user) {
            if (obj.val() == "注册时用户名/邮箱" || obj.val() == "") {
                obj.val(user);
            }
            $("#alert_landing input[name='password']").focus();
        }
    };
    /**
     * fangfang 用户未登录时，点击签到，弹出登录框
     * @param {}
     * @time 2014-02-10
     */
    XD.user_handsome_login_init = function(b) {
        a(".alert_bg").remove();
        var acturl = '/login/index';
        var returnurl=document.URL;
        f = new XDLightBox({
            title: "",
            lightBoxId: "alert_landing",
            //ifream登录方式
            contentHtml: '<iframe style="width:310px;height:330px;" frameborder="0" scrolling="no"  class="content-landing" src="' + acturl + '?style=2&returnurl='+returnurl+'"></iframe>'
                    + '<div class="login-l-img fr"><img alt="" src="http://s.juancdn.com/juanpi/img/login/login-bj-ad02.png"></div>'
                    + '<div class="direct-go" style="display: none;"><a href="">暂不登录，继续前往&gt;&gt;</a></div>',
             //原始登录方式   
//                     contentHtml :
//                '<div class="content-landing">'
//                    +'<dl><dd><a href="javascript:;">QQ/微博登录</a></dd><dd class="no active"><a href="javascript:;">卷皮账号登录</a></dd></dl>'
//                    +'<form action="'+acturl+'" method="post" onsubmit="return false">'
//                    +'<ul style="display:none;">'
//                    +'<li class="qq-union"><div class="qq-pic"><a href="http://user.juanpi.com/login/connect/type/qq"><img src="http://s.juancdn.com/juanpi/img/login/qq-union.png"></a></div><p class="links">使用QQ快速登录！</p></li>'
//                    +'<li class="third-login"><div class="third-box"><label>其他账号登录：</label><a href="http://user.juanpi.com/login/connect/type/weixin" class="weixin"></a><a href="http://user.juanpi.com/login/connect/type/sina" class="sina"></a><a href="http://user.juanpi.com/login/connect/type/taobao" class="tao"></a></div></li>'
//                    +'</ul>'
//                    +'<ul>'
//                    +'<li><div class="user"><span><i class="user-ico"></i></span><input type="text" class="user-input" name="account" placeholder="用户名/手机号/邮箱"></div></li>'
//                    +'<li><div class="user"><span><i class="pass-ico"></i></span><input type="password" class="user-input" name="password" placeholder="请输入密码"></div></li>'
//                    +'<li style="display:block;" id="verify_display"><div class="user spr"> <span><i class="spr-ico"></i></span><input type="text" autocomplete="off" name="code" placeholder="验证码" class="user-input"></div><img id="verify" src="'+__URL_MEMBER__+'/public/verify" class="verification-code"></li>'
//                    +'<li class="chex-d"><div class="chex"><span><label><input type="checkbox" checked="" class="ck" name="" value="">两周内免登录</label></span><span class="fr"><a class="forget " href="'+__URL_MEMBER__+'/forget">忘记密码？</a> | <a href="'+__URL_MEMBER__+'/register" class="register">免费注册</a></span></div></li>'
//                    +'<li><div class="btn"><input type="hidden" name="t" class="sub smt-o" value="f"><input type="submit" class="sub smt-o" value="登　录"></div></li>'
//                    +'</ul>'
//                    +'</form>'
//                    +'</div>'
//                    +'<div class="login-l-img fr"><img alt="" src="http://s.juancdn.com/juanpi/img/login/login-bj-ad02.png"></div>'
//                    +'<div class="direct-go" style="display: none;"><a href="">暂不登录，继续前往&gt;&gt;</a></div>',
            scroll: true
        });
        f.init();
        $.getJSON(__URL_MEMBER__ + "/Login/checkAllwaysVerify?callback=?", function(data) {
            if (typeof (data) != "undefined " && data != 0) {
                $("#alert_landing #verify_display").show();
            }
        });
        a("#alert_landing .alert_top span").addClass("jp-alert-logo");
        a("#alert_landing input[name='username']").focus();
        a("#alert_landing input[name='username']").parents(".user").addClass("input-active");
        a("#alert_landing input[name='username']").val("");
        a('a.more').on("click", function() {
            $(this).find('em').toggleClass("login-cur-top");
            $('div.tao-tx').slideToggle();
        });
        XD.autoGetUsername();
    };
    /**
     * 检测简单登录提交
     * @param {obj}
     * @time 2014-02-10
     */
    chkSLogin = function(obj) {
        obj.find('.smt').val('登录中..');
        obj.find('.smt').attr('disabled', true);
    };
    /**
     * fangfang 弹出登录框，添加/移除focus样式，并提交填写数据
     * @param {}
     * @time 2014-02-10
     */
    XD.user_handsome_login = function() {
        var name = a("#alert_landing input[name='username']");
        var password = a("#alert_landing input[name='password']");
        var code = a("#alert_landing input[name='code']");
        name.focus(function() {
            name.parents(".user").addClass("input-active");
        });
        name.blur(function() {
            name.parents(".user").removeClass("input-active");
        });
        password.focus(function() {
            password.parents(".user").addClass("input-active");
        });
        password.blur(function() {
            password.parents(".user").removeClass("input-active");
        });
        //快速登录切换
        a("#alert_landing dl dd").click(function() {
            a("#alert_landing dl dd").removeClass("active");
            a(this).addClass("active");
            a("#alert_landing ul").hide();
            a("#alert_landing ul:eq(" + a(this).index() + ")").show();
        });
        a("#alert_landing .verification-code").click(function() {
            a(this).attr("src", __URL_MEMBER__ + '/public/verify?' + (new Date()).getTime());
        });
        a("#alert_landing form").submit(function() {
            if (name.val() == "" || name.val() == "用户名/邮箱" || password.val() == "" || password.val() == "请输入密码") {
                window.location.href = __URL_MEMBER__ + "/login";
                return false;
            } else {
//                $.ajax({
//                    type : "post",
//                    dataType : "json",
//                    url : __URL_MEMBER__ + "/login/checkLogin",
//                    data : "auto=on&account=" + name.val() + "&password=" + password.val() + "&code=" + code.val(),
//                    async : false,
//                    success : function(result){
//                        if(result.status == 1){
//                            //通知九块邮登录
//                            $.getJSON(result.sync,function(){
//                                //重定向地址
//                                window.location.reload();
//                            });
//                        }else{
////                            a("#alert_landing .verification-code").click();
//                            window.location.href = __URL_MEMBER__ + "/login";
//                        }
//                    }
//                });
//                return false;
            }
        });
    };


})(jQuery);
