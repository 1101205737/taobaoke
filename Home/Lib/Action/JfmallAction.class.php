<?php
class JfmallAction extends IniAction{
    public function index(){
        $op = ggp('op');
        if($op=='do'){
            $this->isLogin();
            list($address,$realname) = explode('@', $this->my['device_token']);
            
            $this->my['decive_token'] = unserialize($this->my['device_token']);
            if(!$address || !$this->my['mobile'] || !$realname){
                $this->myError('请完善您的收货信息',U('member/address'));
            }
            $jf_goods_id = ggp('jf_goods_id:i');
            $jfitem = M('jf_goods')->where('state=1')->find($jf_goods_id);
            empty($jfitem) && $this->myError('没有该商品');
            $jfitem['jf_goods_jf']>$this->my['jifen'] && $this->myError('您的积分不足');
            MemberModel::I()->decJf($this->my['uid'],$jfitem['jf_goods_jf']);
            M('jf_log')->add(array(
                'uid'=>$this->my['uid'],
                'uname'=>$this->my['uname'],
                'order_id'=>$jfitem['jf_goods_id'],
                'state'=>0,
                'jf_goods_jf'=>-$jfitem['jf_goods_jf'],
                'ctime'=>TIME,
                'beizhu'=>  serialize(array(
                    'jf_goods_name'=>$jfitem['jf_goods_name'],
                    'address'=>$address,
                    'realname'=>$realname,
                    'mobile'=>$this->my['mobile'],
                    )),
            ));
            if($jfitem['jf_goods_num']>0){
                if(intval($jfitem['jf_goods_num'])===1){
                    M('jf_goods')->where("jf_goods_id='{$jfitem['jf_goods_id']}'")->save(array('state'=>0));
                }
                M('jf_goods')->where("jf_goods_id='{$jfitem['jf_goods_id']}'")->setDec('jf_goods_num');   
            }
            $this->mySuccess('兑换成功');
        }
        $hot_goods = M('goods')->where("state=1")->order('`order` DESC,hits DESC,goods_id DESC')->limit(8)->select();
        $this->assign('hot_goods',$hot_goods);
        $list = M('jf_goods')->where("state=1")->order('`order` desc,jf_goods_id desc')->select();
        $this->a('$list',$list);
        $this->d();
    }
}