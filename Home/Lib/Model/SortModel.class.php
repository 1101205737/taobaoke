<?php
class SortModel extends Model{
    public static function I(){
        return new SortModel();
    }
    
    public function delSort($sort_id){
        $this->delete($sort_id);
    }
    
    public function getGoodsSort($state=1){
        $where = "type=1 "; 
        $where .= $state?" and state='1'":"1";
        return $this->where($where)->select();
    }
    
    public function getArticleSort($state=1){
        $where = "type=2 ";
        $where .= $state?" and state='1'":"1";
        return $this->where($where)->select();
    }
    
    public function getName($sort_id){
        $sort = $this->find($sort_id);
        return $sort['sort_name'];
    }
}