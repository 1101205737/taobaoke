<?php
class MemberModel extends Model{
    public static function I(){
            return new MemberModel();
    }
    public function getUser($param=array()){
        if(!is_array($param)) $param = array('uid'=>$param);
        return $this->where($param)->find();
    }

    public function getUserByUname($uname){
        return $this->where(array('uname'=>$uname))->find();
    }

    public function getUserByParam($param){
        return $this->where($param)->find();
    }
    
    public function logout(){
            import('ORG.Util.Cookie');
            //Cookie::set('authcookie', authcode("$user_name\t$user_id\t",'ENCODE'), 31536000);
            Cookie::delete('authcookie');			
            return true;
    }
    
    public function incJf($uid,$jf){
        return $this->where("uid='{$uid}'")->setInc('jifen',$jf);
    }
    public function decJf($uid,$jf){
        return $this->where("uid='{$uid}'")->setDec('jifen',$jf);
    }
    
    public function addFavor($uid,$goods_id){
        $where['goods_id'] = $goods_id;
        $where['uid'] = $uid;
        $goods = M('favor')->where($where)->find();        
        if($goods) return false;
        M('favor')->add(array(
            'uid'=>$uid,
            'goods_id'=>$goods_id,
        ));
        M('goods')->setInc('favor');
        return true;
    }
    
    public function delFavor($uid,$goods_id){
        $where['goods_id'] = $goods_id;
        $where['uid'] = $uid;
        if(M('favor')->where($where)->delete()){
            M('goods')->setDec('favor');
            return true;
        }
        return false;
    }
       
}