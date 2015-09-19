<?php
class SearchAction extends IniAction{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        $keywords = ggp('keywords:t2');
        $this->assign('keyword',$keywords);
        if(!$keywords) $this->error ('请输入搜索的关键词');
        $sx_price = I('get.price');
        $sx_from = I('get.from');
        $discount = I('get.discount');
        $where['state'] = 1;
        $where['title'] = array('like',"%{$keywords}%");
        if($sx_from=='tmall'){
            $where['goods_type'] = 'tmall';
        }elseif($sx_from=='taobao'){
            $where['goods_type'] = 'taobao';
        }elseif($sx_from=='qugoumai'){
            $where['goods_type'] = 'qugoumai';
        }
        if($sx_price=='asc'){
            $orderby = '`discount_price` ASC';
        }elseif($sx_price=='desc'){
            $orderby = '`discount_price` DESC';
        }
        if($discount=='asc'){
            $orderby = $orderby?$orderby.',discount_price/price ASC':'discount_price/price ASC';
        }elseif($discount=='desc'){
            $orderby = $orderby?$orderby.',discount_price/price DESC':'discount_price/price DESC';
        }
        if($sx_price || $discount){
            $orderby .= ",`order` DESC,goods_id DESC";
        }
        $goodsdb = M('goods');
        $count = $goodsdb->where($where)->count();
        $once = 20;
        $Page = $this->iniPage($count,$once);
        $result = D('Goods')->_getGoodsList($Page, $where,$orderby);
        
        if(false){
        }else{
            $totalPage = ceil($goodsdb->where($where)->count()/$once);
			$shaixuan['price'] = $sx_price;
			$shaixuan['from'] = $sx_from;
            $shaixuan['discount'] = $discount;
            $this->assign('goods',$result);            
            $this->assign('shaixuan',$shaixuan);
            $this->assign('totalPage',$totalPage);
            if(IS_AJAX){
                $page = I('get.p','','intval');
                $this->assign('page',$page+1);
                $this->display('Ajax:ajgetgoods');
            }else{
               $this->display();
            }
        }
    }
}