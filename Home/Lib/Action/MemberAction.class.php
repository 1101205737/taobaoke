<?php
class MemberAction extends IniAction{
    public function index(){
        $this->assign('sharecode', base64_encode($this->my['uid']));
        $this->isLogin();
        $this->d();
    }

    public function info(){}

    public function address(){
        $this->isLogin();
        $op = ggp('op');
        if($op=='do'){
            $d['device_token'] = ggp('address:t2').'@'.ggp('realname:t2');
            $d['mobile'] = ggp('mobile:t2');
            M('member')->where("uid='{$this->my['uid']}'")->save($d);
            $this->mySuccess('操作成功');
        }
        
        list($address,$realname) = explode('@',$this->my['device_token']);
        $this->my['device_token'] = array('address'=>$address,'realname'=>$realname);
        $this->a('user',$this->my);
        $this->d();
    }
    
    public function unFavor(){
        $this->isLogin();
        $op = ggp('op');
        if($op=='do'){
            $goods_id = ggp('id:i');
            if(MemberModel::I()->delFavor($this->my['uid'], $goods_id)){
                $this->mySuccess('取消成功');   
            }else{
                $this->mySuccess('您没有收藏该商品');   
            }            
        }
    }

    public function favor(){
        $this->isLogin();
        $op = ggp('op');
        if($op=='do'){
            $goods_id = ggp('id:i');
            if(MemberModel::I()->addFavor($this->my['uid'], $goods_id)){
                $this->mySuccess('收藏成功');   
            }else{
                $this->mySuccess('您已经收藏该商品');   
            }            
        }
        $pre = getPre();
        $goods = M()->field('g.*')
                ->table("{$pre}favor f")
                        ->join("{$pre}goods g on f.goods_id=g.goods_id")
                                ->where("f.uid='{$this->my['uid']}'")
                                        ->select();
        $this->a('goods',$goods);
        $this->d();
    }
    
    public function goods(){}//参加专题的商品

    public function register(){
        $op = ggp('op');
        if($op=='do'){
            $where_checkreg['ctime'] = array('between',array(NOW_TIME-(24*60*60),NOW_TIME));
            $where_checkreg['ip'] = $_SERVER['REMOTE_ADDR'];
            $num = M('member')->where($where_checkreg)->count();
            if($num>10){
                $this->error("注册过于频繁，请稍后重试");
            }
            $uname = ggp('uname:t2');
            $password = ggp('password:t2');
            $password2 = ggp('password2:t2');
            $email = ggp('email:t2');
            $mobile = ggp('mobile:t2');
            $openid = ggp('openid:t2');
            
            !$uname && $this->myError('请正确填写用户名');
            !$password && $this->myError('请正确填写密码');
            $password2!=$password && $this->myError('两次填写密码不一致');
            if(!$email || !is_email($email)){
                $this->myError('请正确填写邮箱');
            }
            
            if(!$mobile || !is_mobile($mobile)){
                $this->myError('请正确填写手机号');
            }

            $user = D('Member')->getUserByUname($uname);
            $user && $this->myError('用户已存在，请换个用户名');
            $fromUid = base64_decode(cookie('shareFrom'));
            $uid = M('member')->add(array(
                'uname'=>$uname,
                'password'=>md5($password),
                'openid'=>$openid,
                'email'=>$email,
                'mobile'=>$mobile,
                'ctime'=>TIME
            ));
            $member = M('member')->find($uid);
            if($fromUid>0){
                $shareuser['uid'] = intval($fromUid);
                $score_share = intval($this->setting['score_share']);
                if(!$score_share){
                    $where_exists['setting_key'] = "score_share";
                    $is_exists = M('setting')->where($where_exists)->find();
                    if(!$is_exists){
                        $data['setting_key'] = "score_share";
                        $data['setting_val'] = "0";
                        M('setting')->add($data);
                    }
                }
                if($score_share){
                    $user = M('member')->find($shareuser['uid']);
                    M('jf_log')->add(array(
                    'uid'=>$shareuser['uid'],
                    'uname'=>$user['uname'],
                    'jf_goods_jf'=>$score_share,
                    'ctime'=>TIME,
                    'beizhu'=>"“{$member['uname']}”通过您的推广链接注册成功",
                    ));
                    M('member')->where($shareuser)->setInc('jifen',$score_share);
                }
            }
            $this->_login($member);
        }
        $this->a('openid',ggp('openid:t2'));
        $this->a('nickname',ggp('nickname:t2'));
        $this->display();
    }
    
    public function isSign($sign){
        return intval(date('Ymd',$sign)) == intval(date('Ymd',TIME));
    }
    
    public function sign(){
        $this->isLogin();
        $member = $this->my;
        if($this->setting['score_sign2'] && ((strtotime(date('Ymd',TIME)) - strtotime(date('Ymd',$member['sign'])))==86400)) {
            MemberModel::I()->incJf($member['uid'],$this->setting['score_sign2']);
            
            $this->setting['score_sign2'] && M('jf_log')->add(array(
                'uid'=>$member['uid'],
                'uname'=>$member['uname'],
                'jf_goods_jf'=>$this->setting['score_sign2'],
                'ctime'=>TIME,
                'beizhu'=>'连续签到增加积分',
                ));
            M('member')->where("uid='{$member['uid']}'")->save(array('sign'=>TIME));
            $this->mySuccess("连续签到成功,增加{$this->setting['score_sign2']}点积分");
        }else if($this->isSign($member['sign'])){
            $this->mySuccess('今天已经签过到');
        }else{
            MemberModel::I()->incJf($member['uid'],$this->setting['score_sign']);
            M('member')->where("uid='{$member['uid']}'")->save(array('sign'=>TIME));
            $this->setting['score_sign'] && M('jf_log')->add(array(
                'uid'=>$member['uid'],
                'uname'=>$member['uname'],
                'jf_goods_jf'=>$this->setting['score_sign'],
                'ctime'=>TIME,
                'beizhu'=>'签到增加积分',
                ));
            $this->mySuccess("签到成功,增加{$this->setting['score_sign']}点积分");
        }
        
    }

    private function _login($member,$url='/'){
        cookie('authcookie', authcode("{$member['uid']}\t{$member['password']}\t", 'ENCODE'),3600*4);
        if($this->setting['score_login'] && date('Ymd')!=date('Ymd',$member['last_login_time'])){
            MemberModel::I()->incJf($member['uid'],$this->setting['score_login']);
            $this->setting['score_login'] && M('jf_log')->add(array(
                'uid'=>$member['uid'],
                'uname'=>$member['uname'],
                'jf_goods_jf'=>$this->setting['score_login'],
                'ctime'=>TIME,
                'beizhu'=>'登录增加积分',
                ));
        }
        M('member')->where("uid='{$member['uid']}'")->save(array('last_login_time'=>TIME,'ip'=>$_SERVER['REMOTE_ADDR']));
        $this->mySuccess('登录成功',$url);
    }

    public function login(){
        if($this->my){
            header("location:http://{$_SERVER['SERVER_NAME']}");
            exit;
        }
        $op = ggp('op');
        if($op=='do'){
            $openid = ggp('open_id:t2');
            if($openid){
                $nickname = ggp('nickname:t2');
                $user = M('member')->where("openid='{$openid}'")->find();
                if(empty($user)){
                    header("location:http://{$_SERVER['SERVER_NAME']}/index.php?m=member&a=register&openid={$openid}&nickname={$nickname}");
                    exit;
                }                
            }else{
                $uname = ggp('uname:t2');
                $password = md5(ggp('password:t2'));
                $user = MemberModel::I()->getUserByParam(array('uname'=>$uname,'password'=>$password));
                empty($user) && $this->myError('用户名不存在或密码错误');
                $user['password']!=$password && $this->myError('密码错误');                
            }            
            $this->_login($user);
        }
        $this->display();
    }
    
    public function forgetPassword(){
        if(empty($this->setting['smail_username']) || empty($this->setting['smail_password'])) exit("管理员没有开启此功能");
        $op = ggp('op');
        if($op=='do'){
            $uname = ggp('uname:t2');
            $email = ggp('email:t2');
            $memberM = M('member');
            $user = $memberM->where("uname='{$uname}' and email='{$email}'")->find();
            empty($user) && $this->myError('用户名或邮箱填写错误');
            $password = date('Hisy');
            $memberM->where("uid='{$user['uid']}'")->save(array('password'=>md5($password)));
            $title = "{$this->setting['site_name']}-重置密码";
            $msg = "您的密码重置为：{$password}，登陆后请立即修改！";
            $param = array(
                'mail_login_name'=>$this->setting['smail_username'],
                'mail_password'=>$this->setting['smail_password'],
                'from_name'=>$this->setting['site_name'],
            );
            sendMail($title, $msg, $email, $param);
            $this->mySuccess('密码已经发送至您的邮箱，请登录后立即修改密码',U('member/login'));
        }
        $this->d();
    }    

    public function resetPassword(){
        $this->isLogin();
        $op = ggp('op');
        if($op=='do'){
            $oldPassWord = ggp('oldPassWord:t2');
            $newPassWord = ggp('newPassWord:t2');
            $newPassWord2 = ggp('newPassWord2:t2');
            md5($oldPassWord) != $this->my['password'] && $this->myError('旧密码错误');
            $newPassWord!=$newPassWord2 && $this->myError('两次密码不一致');
            
            M('member')->where("uid='{$this->my['uid']}'")->save(array('password'=>md5($newPassWord)));
            $this->mySuccess('操作成功');
        }
        $this->d();
    }

    public function logout(){
        cookie('authcookie',null);
        $this->mySuccess(L('msg_member_logout_success'));
    }

    public function forgetpwd(){
        //sendMail($mail,$msg);
        $this->mySuccess('新密码已发送至您注册邮箱，请及时修改密码！');
    }
    
    public function avatar(){
        $op = ggp('op');
        if($op=='do'){
            if ($_FILES['pic_url']['size']) {
                $dir='avatar_img/'.date('Ym');
                $info = $this->saveFile($dir);
                if ($info['state'] > 0) {
                    $p['pic_url'] = "http://{$_SERVER['SERVER_NAME']}/uploads/{$dir}/{$info['goods_img']}";
                } else {
                    $this->myError($info['msg']);
                }
                M('member')->where("uid='{$this->my['uid']}'")->save($p);
                $this->mySuccess('操作成功');
            }
            $this->myError('请上传头像');
        }
        $this->d();
    }
    
    public function jflog(){
        $jflogM = M('jf_log');
        $where = "uid='{$this->my['uid']}'";
        $page = $this->iniPage($jflogM->where($where)->count(),10);
        $logList = $jflogM->where($where)->limit("{$page->firstRow},{$page->listRows}")->order("jf_log_id desc")->select();
        $this->a('$logList',$logList);
        $this->a('$page',$page->show());
        $this->d();
    }
    
    public function myGoods(){
        $op = ggp('op');
        $goodsM = M('goods');
        if($op=='del'){
            $goods_id = ggp('goods_id');
            $goodsM->where("goods_id='{$goods_id}'")->delete();
            $this->mySuccess('操作成功');
        }
        $where = "1 and add_uname='{$this->my['uname']}'";
        $page = $this->iniPage($goodsM->where($where)->count());
        $myGoods = $goodsM->where($where)->limit("{$page->firstRow},{$page->listRows}")->order('goods_id desc')->select();
        $this->a('myGoods',$myGoods);
        $this->a('page',$page->show());
        $this->d();
    }

    private function create_rand_str($leng){
            $rand_str = "";
            $str="abcdefghijklmnopqrstuvwxyz0123456789";
            for($i=0;$i<$leng;$i++){
                $rand_str .= $str[mt_rand(0, strlen($str)-1)];
            }
            return $rand_str;
    }

    private function create_rand_num($leng){
            $rand_str = "";
            $str="0123456789";
            for($i=0;$i<$leng;$i++){
                    $rand_str .= $str[mt_rand(0, strlen($str)-1)];
            }
            return $rand_str;
    }
}