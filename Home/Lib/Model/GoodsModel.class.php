<?php
class GoodsModel extends Model{
	
	/*public static function I(){
        return new GoodsModel();
	}*/
    public function delGoods($goods_id){
        $this->where("goods_id='{$goods_id}'")->delete();
    }

    public function getGoodsById($goods_id=0){
        return $this->where("goods_id='{$goods_id}'")->find();
    }

    public function goodsCount($where=1){
        return $this->where($where)->count();            
    }
    
    public function _getGoodsList($Page,$where,$orderby=''){
        $orderby = $orderby?$orderby:'`order` DESC,goods_id DESC';
        $goods = M('goods')->where($where)->order($orderby)->limit($Page->firstRow.','.$Page->listRows)->select();
        return $goods;
    }
	/*
		$param	array
	*/
	public function getGoods($param){

		$where = " 1=1 ";
		$where.= isset($param["sort_id"])?" and sort_id=".$param["sort_id"]:"";
		$where.= isset($param["recommend"])?" and recommend=".$param["recommend"]:"";
		$sort_arr = M("sort")->where($where)->find();
		
		$goods_arr = M("goods")->where($where)->order("goods_id DESC")->limit("0,".$param["limitnum"])->select();
		//return $goods_arr;	
		return array("sort_arr"=>$sort_arr,"goods"=>$goods_arr);
	}
	
}