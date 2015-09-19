<?php
class JfmallModel extends Model{
	public static function I(){
		return new JfmallModel();
	}
	public function getJfGoods($jf_goods_id){
		$jf_goods = M('jf_goods')->where("jf_goods_id='{$jf_goods_id}'")->find(); 
		return $jf_goods;
	}

	public function updateJfGoods($jf_goods_id,$data){
		$this->where("jf_goods_id={$jf_goods_id}")->save($data);
	}
}