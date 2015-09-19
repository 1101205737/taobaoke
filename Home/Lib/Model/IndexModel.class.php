<?php
class IndexModel extends Model{
    public function __construct($name = '') {
        parent::__construct($name);
        
    }
    
    static function I(){
        return new IndexModel;
    }

    public function getAllSort($num=20,$type='1'){
        $where['state'] = 1;
        $where['type'] = $type;
        $where['p_id'] = 0;
        $where_sub_sort['state'] = 1;
        $where_sub_sort['p_id'] = array('gt','0');
        $db = M('sort');
        $order = '`order` DESC,sort_id DESC';
        $sub_sort = $db->where($where_sub_sort)->order($order)->select();
        foreach($sub_sort as $k=>$v){
            $sub_sort_by_id[$v['p_id']][$v['sort_id']] = $v;
        }
        $result = $db->where($where)->limit($num)->order($order)->select();
        $data['allsort'] = $result;
        $data['subsort'] = $sub_sort_by_id;
        return $data;
    }
    
    public function getSortById($id){
        $where['sort_id'] = intval($id);
        $result = M('sort')->where($where)->find();
        return $result;
    }


    public function getArticleList($sort_id,$num){
        if(!$sort_id || !$num) return false;
        $where['state'] = 1;
        $where['sort_id'] = $sort_id;
        $result = M('article')->where($where)->limit($num)->order('`order` DESC,aid DESC')->select();
        return $result;
    }
    
    public function getIndexArticle($num){
        $where['state'] = 1;
        $where['tuijian'] = 1;
        $result = M('article')->where($where)->limit($num)->order('`order` DESC,aid DESC')->select();
        return $result;
    }
    
    public function getAds($position,$num=1){
        $where['state'] = 1;
        $where['type'] = $position;
        $result = M('ad')->where($where)->limit($num)->order('`order` DESC,aid DESC')->select();
        return $result;
    }
    
    public function getGoodsBySort($sort,$num=8){
        //$where['state'] = 1;
        //$where['sort_id'] = $sort;
        $ids = trim($sort.$this->getSubSort($sort),',');        
        $where = "state=1 and sort_id in({$ids})";
        $result = M('goods')->where($where)->limit($num)->order('`order` DESC,goods_id DESC')->select();
        return $result;
    }
    
    private function getSubSort($sort,$ids='') {
        $sub = M('sort')->field('sort_id')->where("p_id='{$sort}'")->select();
        if($sub){
            foreach($sub as $val) {
                $ids .= $this->getSubSort($val['sort_id'],",{$val['sort_id']}");
            }
        }
        return $ids;
    }
    
    public function getHotGoods($sort,$num=20){
        $where['state'] = 1;
        $sort_arr = M('sort')->field('sort_id')->where('p_id='.$sort['p_id'].' and sort_id not in('.$sort['sort_id'].')')->select();
        foreach($sort_arr as $k=>$v){
            $side_sort[] = $v['sort_id'];
        }
        $where['sort_id'] = array('in',$side_sort);
        $result = M('goods')->where($where)->limit($num)->order('hits DESC,goods_id DESC')->select();
        return $result;
    }
    
    public function getBroCate($sort){
        if($sort['p_id']){
            $sort_arr = M('sort')->field('sort_id,sort_name,order')->where('p_id='.$sort['p_id'].' and sort_id not in('.$sort['sort_id'].')')->select();
        }else{
            $sort_arr = M('sort')->field('sort_id,sort_name,order')->where('p_id='.$sort['sort_id'])->select();
        }
        return $sort_arr;
    }
    
    public function getTopCate($num=10,$type='1'){
        $where['type'] = $type;
        $where['state'] = 1;
        $where['p_id'] = 0;
        $allSort = M('sort')->where($where)->limit($num)->select();
        return $allSort;
    }
}