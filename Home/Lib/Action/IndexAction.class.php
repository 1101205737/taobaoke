<?php

class IndexAction extends IniAction {

    function __construct() {
        parent::__construct();
    }

    public function index() {
		//$this->_getFooterArticle();
		$map = array();
		$map["recommend"] = 1;
		$map['limitnum'] = 5;
		$recommend1 = D("Goods")->getGoods($map);
		$this->assign("recommend1",$recommend1);
		$map = array();
		$map["recommend"] = 2;
		$map['limitnum'] = 5;
		$recommend2 = D("Goods")->getGoods($map);
		$this->assign("recommend2",$recommend2);
		
		$map = array();
		$map["recommend"] =3;
		$map['limitnum'] = 5;
		$recommend3 = D("Goods")->getGoods($map);
		$this->assign("recommend3",$recommend3);
		
		$map = array();
		$map["recommend"] = 4;
		$map['limitnum'] = 5;
		$recommend4 = D("Goods")->getGoods($map);
		$this->assign("recommend4",$recommend4);
		
		$map = array();
		$map["recommend"] = 5;
		$map['limitnum'] = 5;
		$recommend5 = D("Goods")->getGoods($map);
		$this->assign("recommend5",$recommend5);
		
			
		//取分类信息	
		$map = array();
		$map["sort_id"] = C("SORT1");
		$map['limitnum'] = 5;
		$good1 = D("Goods")->getGoods($map);
	
				//print_r($good1);
		//exit;
		$this->assign("good1",$good1);

		$map = array();
		$map["sort_id"] = C("SORT2");
		$map['limitnum'] = 8;
		$good2 = D("Goods")->getGoods($map);
		$this->assign("good2",$good2);
		
		$map = array();
		$map["sort_id"] = C("SORT3");
		$map['limitnum'] = 8;
		$good3 = D("Goods")->getGoods($map);
		//print_r($good3);
		//exit;
		$this->assign("good3",$good3);
		
		$map = array();
		$map["sort_id"] = C("SORT4");
		$map['limitnum'] = 8;
		$good4 = D("Goods")->getGoods($map);
		$this->assign("good4",$good4);			
        $this->display();
    }
    
    public function caijiApi(){
        $p = $_GET;
        $count = 0;
        Vendor('tbk.TopSdk');
        $c = new TopClient;
        $c->appkey = $this->setting['tb_api_key'];
        $c->secretKey = $this->setting['tb_api_secret'];
        $req = new TbkItemGetRequest;
        $req->setFields("num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url");
        $p['keyword'] && $req->setQ($p['keyword']);
        $p['cid'] && $req->setCat($p['cid']);
        $p['start_price']>0 && $req->setStartPrice($p['start_price']);
        $p['end_price']>0 && $req->setEndPrice($p['end_price']);
        $p['sort'] && $req->setSort($p['sort']);
        $p['start_commissionRate']>0 && $req->setStartTkRate($p['start_commissionRate']);
        $p['end_commissionRate']>0 && $req->setEndTkRate($p['end_commissionRate']);
        $p['mall_item'] && $req->setIsTmall("true");
        $req->setPageSize(100);
        $resp = $c->execute($req);
        $a = $resp->results->n_tbk_item;
        foreach($a as $val){
            if($count>=$p['num']) break;
            $goods = array(
                'title'=>$val->title,
                'num_iid'=>$val->num_iid,
                'item_url'=>$val->item_url,
                'price'=>$val->reserve_price,
                'discount_price'=>$val->zk_final_price,
                'goods_type'=>$val->user_type?'tmall':'taobao',
                'pic_url'=>$val->pict_url,
                'provcity'=>$val->provcity,
                'add_uid'=>$this->my['uid'],
                'add_uname'=>$this->my['uname'],
                'ctime'=>TIME,
                'sort_id'=>$p['sort_id'],
                'state'=>$p['state']?1:0,
            );
            $count++;
            $goods_list[] = $goods;
        }
        echo json_encode(array('data'=>$goods_list,'count'=>$count));
    }
}