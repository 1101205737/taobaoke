<?php

class ArticleAction extends IniAction {

    public function artList(){
        $sort_id = ggp('id:i');        
        $this->a('sort_id',$sort_id);
        $where = "sort_id='{$sort_id}' and state=1";
		import("@.ORG.Page");// 导入分页类  
        $count = M('article')->where($where)->count();
        $listRows = 2;
        $totalPage = ceil($count/$listRows);
        $this->a('totalpage',$totalPage);
        $p = new Page($count, $listRows);
        $artList = M('article')->where($where)->limit($p->firstRow . ',' . $p->listRows)->order('`order` DESC,aid DESC')->select();
        $where_sort['sort_id'] = $sort_id;
        $where_sort['type'] = 2;
        $sort = M('sort')->where($where_sort)->find();
        $this->assign('page',$p->show());
        $this->a('sort',$sort);
        $this->a('artList',$artList);
        $this->a('nowpage',ggp('p:i'));
        $this->d(ggp('ajax')?'ajaxartlist':'');
    }
   
    public function detail(){
        $aid = ggp('aid:i');
        $detail = ArticleModel::I()->find($aid);
        $sort = D('Sort')->find($detail['sort_id']);
        $this->a('$sort',$sort);
        $this->a('$detail',$detail);
        $this->d();
    }
    
    public function postArticle(){
        $op = ggp('op');
        $this->a('art',$art=M('article')->find(ggp('aid:i')));
        $this->a('sort',$sort=M('sort')->where("type=2 and state=1")->select());
        if($op=='do'){
            $title = ggp('title:t2');!$title && $this->myError('请填写标题');
            $content = ggp('content:h2');!$content && $this->myError('请填写文章内容');
            $sort_id = ggp('sort_id:i');
            $p = array(
                'title'=>$title,
                'content'=>$content,
                'sort_id'=>$sort_id,
                'state'=>-1,
                'ctime'=>TIME,
            );
            M('article')->add($p);
            $this->mySuccess('提交成功，请耐心等待理员审核');
        }
        $this->d();
    }
}