<?php
class GoodsAction extends IniAction{
    public function goodslist(){        
        $sort = M('sort')->find(I('get.id','','intval'));
        $sx_price = I('get.price');
        $sx_from = I('get.from');
        $discount = I('get.discount');
        if(!$sort) $this->error ('栏目不存在');
        $ids = trim($sort['sort_id'].$this->getSubSort($sort),',');
        $goodsdb = M('goods');
        $where = "state=1 and sort_id in({$ids})";
        if($sx_from=='tmall'){
            $where .= " and goods_type='tmall'";
        }elseif($sx_from=='taobao'){
            $where .= " and goods_type='taobao'";
        }elseif($sx_from=='qugoumai'){
            $where .= " and goods_type='qugoumai'";
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
        $once = 20;
        $count = $goodsdb->where($where)->count();
        $totalPage = ceil($count/$once);
        $pageObj = $this->iniPage($count);
        $goods = D("Goods")->_getGoodsList($pageObj,$where,$orderby);
        if(IS_AJAX){
            $page = I('get.p','','intval');
            if($goods){
                $this->assign('goods',$goods);
                $this->assign('page',$page+1);
            }
            $this->d('Ajax:ajgetgoods');
        }else{
            $this->assign('page',$pageObj->show());
            $shaixuan['price'] = $sx_price;
            $shaixuan['from'] = $sx_from;
            $shaixuan['discount'] = $discount;
            $this->assign('goods',$goods);
            $this->assign('count',$count);
            $this->assign('totalPage',$totalPage);
            $this->assign('sort',$sort);
            $this->assign('shaixuan',$shaixuan);
            $this->display(); 
        }
    }
    
    private function getSubSort($sort,$ids='') {
        $sub = M('sort')->field('sort_id')->where("p_id='{$sort['sort_id']}'")->select();
        if($sub){
            foreach($sub as $val) {
                $ids .= $this->getSubSort($val,",{$val['sort_id']}");
            }
        }
        return $ids;
    }
    
    public function detail(){
        $id = I('get.id','','intval');
        $pre = C('DB_PREFIX');
        $where['goods_id'] = $id;
        $where['g.state'] = 1;
        $goods = M()->table($pre."goods g")->field('g.seo_title,g.seo_keywords,g.seo_description,g.goods_id,g.num_iid,g.title,g.sort_id,s.p_id,g.goods_type,g.price,g.discount_price,g.pic_url,g.item_url,g.click_url,g.item_body,s.sort_name')->join($pre.'sort s on g.sort_id=s.sort_id')->where($where)->find();
        if($goods){
            $itemid = $goods['num_iid'];
            M('goods')->where('goods_id='.$id)->setInc('hits');
            $where_hot['sort_id'] = $goods['sort_id'];
            $hot_goods = M('goods')->where($where_hot)->order('hits DESC,goods_id DESC')->limit(8)->select();
            foreach($hot_goods as $k=>$v){
                $hot_goods[$k]['discount_price'] = $v['discount_price']>0?$v['discount_price']:$v['price'];
            }
            $goods['discount_price'] = $goods['discount_price']>0?$goods['discount_price']:$goods['price'];
            $this->assign('hot_goods',$hot_goods);
            $this->assign('goods',$goods);
            $this->assign('item_id',$itemid);
            $this->display();   
        }else{
            $this->error('商品不存在');
        }
    }
}