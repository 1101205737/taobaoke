<?php

class WapAction extends IniAction {

    function __construct() {
        parent::__construct();
        C('DEFAULT_THEME','wh');
    }

    public function index() {
        $once = 20;
        $where = 'state=1';
        $sort_id = ggp('sort_id:i');$this->a('sort_id',$sort_id);
        $keywords = ggp('keywords:t2');$this->a('keywords',$keywords);
        $sort_id && $where .= " and sort_id='{$sort_id}'";
        $keywords && $where .= " and title like '%{$keywords}%'";        
        $goodsdb = M('goods');
        $count = $goodsdb->where($where)->count();
        $totalPage = ceil($count / $once);        
        $page = $this->iniPage($count, $once);
        $this->assign('goods',$goodsdb->where($where)->order("`order` desc,goods_id desc")->limit("{$page->firstRow},{$page->listRows}")->select());
        $this->assign('totalPage', $totalPage);
        $this->display(ggp('ajax')?'ajaxindex':'');
    }
    
    public function detail(){
        if(!strpos($_SERVER['HTTP_USER_AGENT'],"MicroMessenger")){
            $goods_id = I('get.id','','intval');
            if($goods_id){
                $where['goods_id'] = $goods_id;
                $goods = M('goods')->where($where)->find();
                $where_hot['sort_id'] = $goods['sort_id'];
                $hot_goods = M('goods')->where($where_hot)->order('hits DESC,goods_id DESC')->limit(8)->select();
                foreach($hot_goods as $k=>$v){
                    $hot_goods[$k]['discount_price'] = $v['discount_price']>0?$v['discount_price']:$v['price'];
                }
                $this->assign('hot_goods',$hot_goods);
                $this->assign('goods',$goods);
                $this->display();
            }else{
                redirect(U('wap/index'));
            }
        }else{
            $this->display('jump');
        }
    }
}