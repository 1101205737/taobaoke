<?php
class TopicModel extends Model{
    public static function I(){
        return new TopicModel();
    }
    
    public function delTopic($tid){
        $this->delete($tid);
    }
    
    public function getTopic($p){
        !is_array($p) && $p['tid'] = $p;
        return $this->where($p)->find();
    }
}