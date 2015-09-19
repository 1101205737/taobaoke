<?php

class AdminAction extends IniAction {
    public $version;
    public $goodsSort;
    public $artSort;
    public function __construct() {
        parent::__construct();
        if ($this->act == 'login') {
            if ($this->my['level'])
                redirect(U('admin/index'));
            return;
        }
        C('DEFAULT_THEME', 'a_tpl');
        C("URL_MODEL", 0);
        $this->isAdmin();
        include 'update.php';
        $this->version =  $version;
        $this->a('version', $version);
        $qx = unserialize($this->my['qx']);
        $qx = array_merge($qx?$qx:array(),array('index','login','dologout'));
        if($this->my['uid']!=1 && !in_array($this->act, $qx)){
            $this->mySuccess('您没有权限进行该操作',U('admin/index'));
        }
        S('goodsSort',null);
        !S('goodsSort') && S('goodsSort',$this->iniSort(1),36000);
        $this->a('goodsSort',$this->goodsSort = S('goodsSort'));
        S('artSort',null);
        !S('artSort') && S('artSort',$this->iniSort(2),36000);
        $this->a('artSort',$this->artSort = S('artSort'));
    }
    
    private function iniSort($type=1,$fid=0,$option='',$tag=''){
        $_sort = M('sort')->where("state=1 and type={$type} and p_id={$fid}")->order("sort_id desc")->select();
        foreach($_sort as $val){
            $option .= "<option value='{$val['sort_id']}'>$tag{$val['sort_name']}</option>";
            $option = $this->iniSort($type,$val['sort_id'],$option,$tag.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
        }
        return $option;
    }
    
    public function index() {
        $mysqlinfo = D('')->query("SELECT VERSION() AS version");
        $serverInfo['版本号'] = 'XC'.($this->version?$this->version:'1.0');
        $serverInfo['服务器系统']	= PHP_OS;
        $serverInfo['PHP版本']  = 'PHP v'.PHP_VERSION;
        $serverInfo['数据版本'] = $mysqlinfo[0]['version'] ;
        $serverInfo['服务器软件'] = $_SERVER['SERVER_SOFTWARE'];
        $serverInfo['最大上传许可'] = (@ini_get('file_uploads')) ? ini_get('upload_max_filesize') : '<font color="red">no</font>';                
        $this->a('serverInfo',$serverInfo);
        $this->d();
    }
    
    public function update() {
        $url = "http://www.xiaocaocms.com/index.php?m=api&a=updatelist&domain=".getdomain($_SERVER['SERVER_NAME']);
        $updateList = file_get_contents($url);
        $this->a('$updateList',$updateList);
        $this->d();
    }

    public function login() {
        $op = $this->gp['op'];
        $uname = ggp('uname:t2');
        $password = ggp('password:t2');
        if ($op == 'dologin') {
            $member = MemberModel::I()->getUserByUname($uname);
            if (empty($member)) $this->myError('error_member_uname_6'); 
            if ($member['level'] < 1)
                $this->myError('error_member_not_admin');
            if (md5($password) != $member['password']) {
                $this->myError('error_member_password_2');
            }
            cookie('authcookie', authcode("{$member['uid']}\t{$member['password']}\t", 'ENCODE'), 31536000);
            $this->mySuccess('登录成功', U('admin/index'));
        }
        C('DEFAULT_THEME', 'a_tpl');
        $this->d();
    }

    public function doLogout() {
        cookie('authcookie',null);
        $this->mySuccess('msg_member_logout_success', U('admin/login'));
    }    

    public function articleList() {
        $op = ggp('op');
        if ($op == 'order') {
            $this->setOrder($_POST, 'article', 'aid');
            $this->mySuccess('msg_common_update_success');
        }
        if($op=='state'){
            $aid = ggp('aid:i');
            $article = M('article')->find($aid);
            M('article')->where("aid='{$aid}'")->save(array('state' =>$article['state']>0?-1:1));
            $this->mySuccess('操作成功');
        }
        if ($op == 'del') {
            $aid = ggp('aid:i');
            M('article')->where("aid='{$aid}'")->delete();
            $this->mySuccess('删除成功');
        }
        if ($op == 'tuijian') {
            $aid = ggp('aid:i');
            $article = M('article')->find($aid);
            M('article')->where("aid='{$aid}'")->save(array('tuijian' =>$article['tuijian']?0:1));
            $this->mySuccess('操作成功');
        }
        if ($op == 'zhiding') {
            $aid = ggp('aid:i');
            $article = M('article')->find($aid);
            M('article')->where("aid='{$aid}'")->save(array('zhiding' =>$article['zhiding']?0:1));
            $this->mySuccess('操作成功');
        }

        $title = ggp('title:t2');
        $sort_id = ggp('sort_id:i');
        $state = ggp('state:i');
        $this->a('state',$state);
        $where = '1';
        $title && $where .= " and title like '%{$title}%'";
        $sort_id && $where .=" and sort_id='{$sort_id}'";
        $state && $where .=" and state='{$state}'";
        $page = $this->iniPage(M('article')->where($where)->count());
        $articleList = M('article')->where($where)
                        ->limit("{$page->firstRow},{$page->listRows}")
                        ->order('`order` desc,aid desc')->select();
        $sort = M('sort')->where('type=2 and state=1')->select();
        $this->a('page', $page->show());
        $this->a('articleList', $articleList);
        $this->a('title', $title);
        $this->a('sort_id', $sort_id);
        $this->a('sort', $sort);
        $this->d();
    }

    public function addArticle() {
        $aid = ggp('aid:i');
        $op = ggp('op');
        if ($op == 'do') {
            $p['title'] = ggp('title:t2');
            $p['content'] = ggp('content:h2');
            $p['seo_title'] = ggp('seo_title:t2');
            $p['seo_keywords'] = ggp('seo_keywords:t2');
            $p['seo_description'] = ggp('seo_description:t2');
            $p['sort_id'] = ggp('sort_id:i');
            $p['state'] = ggp('state:i');
            if (empty($aid)) {
                $p['ctime'] = TIME;
                M('article')->add($p);
            } else {
                M('article')->where("aid='{$aid}'")->save($p);
            }
            $this->mySuccess('操作成功');
        }
        if ($aid) {
            $article = M('article')->where("aid='{$aid}'")->find();
            $this->a('article', $article);
        }
        $where = "state=1 and type=2";
        $sort = M('sort')->where($where)->select();
        $this->a('sort', $sort);
        $this->a('aid', $aid);
        $this->d();
    }

    public function goodsList() {
        $op = ggp('op');
        if ($op=='del') {
            $goods_id = ggp('goods_id:t2');
            if(strpos($goods_id,':')){
                $goods_id = trim(str_replace(':',',',$goods_id),',');
                M('goods')->where("goods_id in( {$goods_id})")->delete();
            }else{
                $goods_id = ggp('goods_id:i');
                D('Goods')->delGoods($goods_id);
            }
            $this->mySuccess('msg_common_del_success');
        } else if($op=='state'){
            $goods_id = ggp('goods_id:t2');
            if(strpos($goods_id,':')){
                $goods_id = trim(str_replace(':',',',$goods_id),',');
                M('goods')->where("goods_id in( {$goods_id})")->save(array('state'=>ggp('state:i')?1:0));
            }else{
                $goods = D('Goods')->getGoodsById($goods_id);
                M('goods')->where("goods_id={$goods['goods_id']}")->save(array('state'=>$goods['state']?0:1));
            }            
            $this->mySuccess('操作成功');
        } else if ($op=='order') {
            $this->setOrder($_POST, 'goods', 'goods_id');
            $this->mySuccess('msg_common_update_success');
        } else {
            $title = ggp('title:t2');
            $this->a('$title',$title);
            //$type_id = ggp('type_id:i');            
            //$this->a('type_id',$type_id);
            $sort_id = ggp('sort_id:i');
            $this->a('sort_id',$sort_id);
            $where = '1';
            $title && $where.= " and title like '%{$title}%'";
            //$type_id && $where.= " and type_id like '%{$type_id}%'";
            $sort_id && $where.= " and sort_id ='{$sort_id}'";
            $page = $this->iniPage(M('goods')->where($where)->count());
            $goodsList = M('goods')->where($where)
                            ->limit("{$page->firstRow},{$page->listRows}")
                            ->order('`order` desc,goods_id desc')->select();
            $this->a('page', $page->show());
            $this->a('goodsList', $goodsList);
            $this->a('sort',D('Sort')->getGoodsSort(1));
            $this->a('goods_name', $goods_name);
        }
        $this->d($tpl);
    }

    public function addGoods() {
        $op = ggp('op');
        $goods_id = ggp('goods_id:i');
        if ($op == 'doaddgoods') {
            $item_url = ggp('item_url:t2');
            preg_match('/id=[0-9]*/i',$item_url,$num_iid);
            $num_iid = ltrim($num_iid[0],'id=');
            $p['num_iid'] = $num_iid;
            $p['title'] = ggp('title:t2');
            $p['sort_id'] = ggp('sort_id:i');
            $p['tid'] = ggp('tid:i');
            $p['nick'] = ggp('nick:t2');
            $p['seo_title'] = ggp('seo_title:t2');
            $p['seo_keywords'] = ggp('seo_keywords:t2');
            $p['seo_description'] = ggp('seo_description:t2');
            $p['goods_type'] = ggp('goods_type:t2');
            $p['price'] = I('post.price', 0.00, 'floatval');
            $p['discount_price'] = I('post.discount_price', 0.00, 'floatval');
            $p['click_url'] = ggp('click_url:t2');
            $p['item_url'] = $item_url;
            $p['volume'] = ggp('volume:i');
            $p['state'] = ggp('state:i');
			$p['recommend'] = ggp('recommend:i');
            $p['item_body'] = ggp('item_body:h2');
            $p['add_id'] = $this->my['uid'];
            $p['add_uname'] = $this->my['uname'];
            $p['ctime'] = TIME;

            if (empty($goods_id))
                $p['add_time'] = TIME;
            if (!$item_url) $this->error ('请填写商品URL');
            if (!$p['title'])
                $this->myError('请填写商品名称');
            if (!$p['price'])
                $this->myError('请填写商品价格');
            
            if ($_FILES['pic_url']['size']) {
                $dir='goods_img/'.date('Ymd');
                $info = $this->saveFile($dir);
                if ($info['state'] > 0) {
                    $p['pic_url'] = "/uploads/{$dir}/{$info['goods_img']}";
                } else {
                    $this->myError($info['msg']);
                }
            }elseif(ggp('pic_url_str:t2')){
                $p['pic_url'] = ggp('pic_url_str:t2');
            }else{
                $this->myError('请上传商品图片');
            }

            $goodsM = D('goods');
            if (empty($goods_id)) {
                $goodsM->add($p);
            } else {
                $goodsM->where("goods_id='{$goods_id}'")->save($p);
            }
            $this->mySuccess('操作成功');
        }
            
        $sort = D('Sort');
        $sort = $sort->getGoodsSort();
        $this->a('sort', $sort);
        $this->a('topic',M('topic')->where("state=1")->select());
        $this->a('sid', $sid);
        $this->a('goods', $goods);
        $this->a('goods_id', $goods_id);
        $goods_id && $this->a('goods', M('goods')->find($goods_id));
        
        $this->d();
    }

    public function userList() {
        $op = ggp('op');
        $level = ggp('level:i');
        if($op=='level'){
            $uid = ggp('uid:i');
            $user = D('Member')->getUser($uid);
            $p['level'] = $user['level']?0:1;
            M('member')->where("uid='{$uid}'")->save($p);
            $this->mySuccess('操作成功');
        }
        if ($op == 'del') {
            $uid = ggp('uid:i');
            $uid==1 && $this->mySuccess('无法删除管理员');
            M('member')->where("uid='{$uid}'")->delete();
            $this->mySuccess('操作成功');
        }
        
        $uname = ggp('uname:t2');
        $email = ggp('email:t2');
        $uid = ggp('uid:t2');
        $where = "level='{$level}'";
        $uname && $where.=" and uname='{$uname}'";
        $email && $where.=" and email='{$email}'";
        $uid && $where.=" and uid='{$uid}'";

        $userlist = M('member')->where($where)->select();
        $page = $this->iniPage(M('member')->where($where)->count());
        $userlist = M('member')->where($where)
                        ->limit("{$page->firstRow},{$page->listRows}")
                        ->order('uid desc')->select();
        $this->a('userlist', $userlist);
        $this->a('$email', $email);
        $this->a('$uname', $uname);
        $this->a('$uid', $uid);
        $this->a('$level', $level);
        $this->d();
    }

    public function addUser() {
        $op = ggp('op');
        $uid = ggp('uid:i');
        if($op=='do'){
            $p['uname'] = ggp('uname:t2');
            $password = ggp('password:t2');
            $password && $p['password'] = md5($password);
            $p['email'] = ggp('email:t2');
            $p['jifen'] = ggp('jifen:i');
            $p['qx'] = serialize($_POST['qx']);
            $lang = array(
                'uname'=>'用户名必填',
                'email'=>'邮箱必填',
            );
            $this->checkField($lang, $p);
            if($uid){
                M('member')->where("uid='{$uid}'")->save($p);
            }else{
                $p['ctime'] = TIME;
                $user = D('Member')->getUser(array('uname'=>$p['uname']));
                $user && $this->myError('用户已存在');
                M('member')->add($p);
            }
            $this->mySuccess('操作成功');
        }
        if($uid){
            $user = M('member')->where("uid='{$uid}'")->find();
            $qx = array(
                '商品列表'=>'goodslist',
                '添加商品'=>'addgoods',
                '用户列表'=>'userlist',
                '添加用户'=>'adduser',
                '个人信息'=>'settingperson',
                '网站信息'=>'settingsite',
                'SEO设置'=>'settingseo',
                'URL模式'=>'settingurl',
                '积分设置'=>'settingscore',
                '邮箱设置'=>'settingqq',
                '清除缓存'=>'clearcache',
                '分类列表'=>'sortlist',
                '添加分类'=>'addsort',
                '文章列表'=>'articlelist',
                '添加文章'=>'addarticle',
                '商品采集'=>'caijigoods',
                '九块九采集'=>'jiukuaijiu',
                '文章采集'=>'scheme',
                '添加广告'=>'addad',
                '广告列表'=>'adlist',
                '积分商品列表'=>'jfgoodslist',
                '添加积分商品'=>'addjfgoods',
                '兑换信息'=>'jfloglist',
                '商家报名'=>'topicgoodslist',
                '专场列表'=>'topiclist',
                '添加专场'=>'addtopic',
            );            
            $user['level']>0 && $this->a('qx',$qx);
            $this->a('user',$user);
        }
        $this->addField('member','qx'," TEXT NOT NULL DEFAULT  ''");        
        $this->d();
    }
    
    private function addField($table,$field,$param){
        $table = getPre().$table;
        if(!M()->query("select COLUMN_NAME from information_schema.COLUMNS where table_name='{$table}' and COLUMN_NAME='{$field}'")){
            M()->execute("ALTER TABLE  `{$table}` ADD  `{$field}` {$param}");
        }
    }

    public function addSort() {
        $op = ggp('op');
        $sort_id = ggp('sort_id:i');
        $p_id = ggp('p_id:i');
        $op && S('nav',null);
        if ($op == 'do') {
            $p['sort_name'] = ggp('sort_name:t2');
            !$p['sort_name'] && $this->mySuccess('填写分类名称');
            $p['state'] = ggp('state:i');
            $p['order'] = ggp('order:i');
            if ($sort_id) {
                M('sort')->where("sort_id='{$sort_id}'")->save($p);
                $this->mySuccess('修改成功');
            }

            $p['p_id'] = ggp('p_id:i');
            $p['type'] = ggp('type:i');
            if ($p['p_id']) {
                $sort = M('sort')->where("sort_id='{$p['p_id']}'")->find();
                !$sort && $this->myError('没有上级栏目');
                $p['type'] = $sort['type'];
            }
            M('sort')->add($p);
            $this->mySuccess('添加成功');
        }                
        
        $where['state'] = 1;
        $where['p_id'] = 0;
        $root_sort = M('sort')->where($where)->select();
        $this->a('root_sort',$root_sort);
        $this->a('sort_id', $sort_id);
        $this->a('p_id', $p_id);
        $sort_id && $this->a('sort',M('sort')->find($sort_id));
        $this->d();
    }
    
    public function getsubsort(){
        $sort_id = I('get.sort_id','','intval');
        $where['p_id'] = $sort_id;
        $where_pname['sort_id'] = $sort_id;
        $result = M('sort')->where($where_pname)->find();
        $sub_sort = M('sort')->where($where)->select();
        $this->assign('subsort',$sub_sort);
        $this->assign('p_name',$result['sort_name']);
        $this->assign('type',$result['type']);
        $this->display();
    }

    public function sortList() {
        $op = ggp('op');
        $type = ggp('type:i');
        $type = $type ? $type : 1;
        if ($op == 'order') {
            $this->setOrder($_POST, 'sort', 'sort_id');
            $this->mySuccess('操作成功');
        }else if($op=='state'){
            $sort_id = ggp('sort_id:i');
            $sort = M('sort')->find($sort_id);
            M('sort')->where("sort_id='{$sort_id}'")->save(array('state'=>$sort['state']==1?0:1));
            $this->mySuccess('操作成功');
        }else if($op=='nav'){
            $sort_id = ggp('sort_id:i');
            $sort = M('sort')->find($sort_id);
            M('sort')->where("sort_id='{$sort_id}'")->save(array('nav'=>$sort['nav']==1?0:1));
            $this->mySuccess('操作成功');
        }else if($op=='fnav'){
            $sort_id = ggp('sort_id:i');
            $sort = M('sort')->find($sort_id);
            M('sort')->where("sort_id='{$sort_id}'")->save(array('fnav'=>$sort['fnav']==1?0:1));
            $this->mySuccess('操作成功');
        } else if ($op == 'del') {
            $sort_id = ggp('sort_id:i');
            D('Sort')->delSort($sort_id);
            M('goods')->where("sort_id='{$sort_id}'")->delete();
            $this->mySuccess('删除成功');
        }
        $where = "type='{$type}' ";
        $where .= "and p_id=0";
        $sort_name && $where.= " and sort_name like '%{$sort_name}%'";
        $sortList = M('sort')->where($where)->order('`order` desc,sort_id desc')->select();
        foreach($sortList as $k=>$v){
            $sortByid[$v['sort_id']] = $v['sort_name'];
        }
        $has_sub = M('sort')->field('p_id')->distinct(true)->where('p_id>0')->select();
        foreach($has_sub as $v){
            $pidarr[] = $v['p_id'];
        }
        $this->assign('pidarr',$pidarr);
        $this->a('sortByid',$sortByid);
        $this->a('sortList', $sortList);
        $this->a('type', $type);
        $this->display();
    }
    
    public function adList() {
        $op = ggp('op');        
        !empty($op) && S('adlist',null);
        if ($op == 'order') {
            $this->setOrder($_POST, 'ad', 'aid');
            $this->mySuccess('操作成功');
        }else if($op=='state'){
            $aid = ggp('aid:i');
            $ad = M('ad')->find($aid);
            M('ad')->where("aid='{$aid}'")->save(array('state'=>$ad['state']==1?0:1));
            $this->mySuccess('操作成功');
        }else if($op=='blank'){
            $aid = ggp('aid:i');
            $ad = M('ad')->find($aid);
            M('ad')->where("aid='{$aid}'")->save(array('blank'=>$ad['blank']==1?0:1));
            $this->mySuccess('操作成功');
        } else if ($op == 'del') {
            M('ad')->delete(ggp('aid:i'));
            $this->mySuccess('删除成功');
        }
        
        $this->a('code',$code = ggp('code:t2'));
        $this->a('title',$title = ggp('title:t2'));
        $adPosition = include "Home/Conf/ad_{$this->setting['theme']}.php";
        $adPosition = array_merge(C('AD_POSITION'),$adPosition?$adPosition:array());
        $this->a('$adPosition',$adPosition);
        $where = "code in('".join('\',\'',  array_flip($adPosition))."') ";
        $code && $where .= " and code='{$code}' ";
        $title && $where.= " and title like '%{$title}%' ";
        $adM = M('ad');
        $page = $this->iniPage($adM->where($where)->count());
        $adList = M('ad')->where($where)->order('`order` desc,aid desc')->limit("{$page->firstRow},{$page->listRows}")->select();
        $this->a('$adList', $adList);
        $this->a('type', $type);
        $this->a('page',$page->show());
        $this->display();
    }
    
    public function addAd(){
        $op = ggp('op');
        $aid = ggp('aid:i');
        if ($op == 'do') {
            $this->addField('ad','code','varchar(50) not null default ""');
            $this->addField('ad','extend','varchar(50) not null default ""');
            $p['title'] = ggp('title:t2');
            $p['blank'] = ggp('blank:i');
            $p['url'] = ggp('url:t2');
            !$p['url'] && $p['url']='javascript:;';
            $p['state'] = ggp('state:i');
            $p['order'] = ggp('order:i');
            $p['code'] = ggp('code:t2');
            $p['extend'] = ggp('extend:t2');
            if (!$p['title'])
                $this->myError('请填写标题');

            if ($_FILES['pic_url']['size']) {
                $dir = 'ad_img/';
                $info = $this->saveFile($dir);
                if ($info['state'] > 0) {
                    $p['pic_url'] = "/uploads/{$dir}{$info['goods_img']}";
                } else {
                    $this->myError($info['msg']);
                }
            }
            
            if (empty($aid)) {
                M('ad')->add($p);
            } else {
                M('ad')->where("aid='{$aid}'")->save($p);
            }
            S('adlist',null);
            $this->mySuccess('操作成功');
        }
        $adPosition = include "Home/Conf/ad_{$this->setting['theme']}.php";
        $adPosition = array_merge(C('AD_POSITION'),$adPosition?$adPosition:array());
        $this->a('$adPosition',$adPosition);
        $aid && $this->a('ad', M('ad')->find($aid));
        $this->d();
    }
    
    public function jfLogList(){
        $op = ggp('op');
        if($op=='del'){
            $jf_log_id = ggp('jf_log_id:i');
            M('jf_log')->where("jf_log_id='{$jf_log_id}'")->delete();
            $this->mySuccess('操作成功');
        }else if($op=='state'){
            $jf_log_id = ggp('jf_log_id:i');
            $goods = M('jf_log')->find($jf_log_id);
            M('jf_log')->where("jf_log_id={$goods['jf_log_id']}")->save(array('state'=>$goods['state']?0:1));
            $this->mySuccess('操作成功');
        }
        
        $uname = ggp('uname:t2');
            $this->a('$uname', $uname);
        
        $type = ggp('type:i');
        $where = 'order_id'.($type?'>0':'=0');
        $uname && $where .= " and uname like '%{$uname}%'";
        $page = $this->iniPage(M('jf_log')->where($where)->count());
        $list = M('jf_log')->where($where)
                        ->limit("{$page->firstRow},{$page->listRows}")
                        ->order('jf_log_id desc')->select();
        $this->a('page', $page->show());
        $this->a('list', $list);
        $this->a('type', $type);
        $this->d();
    }
    
    public function jfGoodsList(){
        $op = ggp('op');
        if($op=='del'){
            $jf_goods_id = ggp('jf_goods_id:i');
            M('jf_goods')->where("jf_goods_id='{$jf_goods_id}'")->delete();
            $this->mySuccess('操作成功');
        }else if($op=='state'){
            $jf_goods_id = ggp('jf_goods_id:i');
            $goods = M('jf_goods')->find($jf_goods_id);
            M('jf_goods')->where("jf_goods_id={$goods['jf_goods_id']}")->save(array('state'=>$goods['state']?0:1));
            $this->mySuccess('操作成功');
        } else if ($op=='order') {
            $this->setOrder($_POST, 'jf_goods', 'jf_goods_id');
            $this->mySuccess('msg_common_update_success');
        }
        
        $jf_goods_name = ggp('jf_goods_name:t2');$this->a('jf_goods_name', $jf_goods_name);
        
        $where = '1';
        $jf_goods_name && $where .= " and jf_goods_name like '%{$jf_goods_name}%'";
        $page = $this->iniPage(M('jf_goods')->where($where)->count());
        $jfGoodsList = M('jf_goods')->where($where)
                        ->limit("{$page->firstRow},{$page->listRows}")
                        ->order('`order` desc,jf_goods_id desc')->select();        
        $this->a('page', $page->show());
        $this->a('jfGoodsList', $jfGoodsList);        
        $this->d();
    }
    
    public function addJfGoods(){
        $op = ggp('op');
        $jf_goods_id = ggp('jf_goods_id:i');
        $item = M('jf_goods')->find($jf_goods_id);$this->a('item',$item);
        if($op=='do'){
            $item['jf_goods_name'] = ggp('jf_goods_name:t2');
                empty($item['jf_goods_name']) && $this->myError('请填写商品名称');
            $item['jf_goods_jf'] = ggp('jf_goods_jf:i');
                empty($item['jf_goods_name']) && $this->myError('请填写消耗积分');
            $item['jf_goods_expire'] = ggp('jf_goods_expire:i');
            $item['jf_goods_num'] = ggp('jf_goods_num:i');
            $item['intro'] = ggp('intro:t2');
            $item['state'] = ggp('state:i');
            
            if ($_FILES['jf_goods_img']['size']) {
                $dir='misc/'.date('Ym');
                $info = $this->saveFile($dir);
                if ($info['state'] > 0) {
                    $item['jf_goods_img'] = "/uploads/{$dir}/{$info['goods_img']}";
                } else {
                    $this->myError($info['msg']);
                }
            }
            
            if($jf_goods_id){
                M('jf_goods')->where("jf_goods_id='{$item['jf_goods_id']}'")->save($item);
                $this->mySuccess('修改成功');
            }
            $item['ctime'] = TIME;
            M('jf_goods')->add($item);
            $this->mySuccess('添加成功');
        }        
        $this->d();
    }

    private function _setting() {
        $op = ggp('op');
        if ($op == 'do') {
            foreach ($_POST as $key => $val) {
                M("setting")->where("setting_key='{$key}'")->save(array('setting_val' => $val));
            }
            $this->mySuccess('msg_common_update_success');
        }
    }
    
    public function clearCache(){
        $this->deldir('./Home/Runtime');
        $this->mySuccess('操作成功');
    }
    
    private function deldir($dir) {
        $dh=opendir($dir);
         while ($file=readdir($dh)) {
           if($file!="." && $file!="..") {
             $fullpath=$dir."/".$file;
             if(!is_dir($fullpath)) {
                 unlink($fullpath);
             } else {
                 $this->deldir($fullpath);
             }
           }
         }

         closedir($dh);
         //删除当前文件夹：
        if(rmdir($dir)) {
           return true;
         } else {
           return false;
         }
    }

    public function settingPerson() {
        $op = ggp('op');
        if ($op == 'do') {
            $new_password = ggp('newpassword');
            $new_password2 = ggp('newpassword2');
            if ($this->my['password'] != md5(ggp('old_password:t')))
                $this->myError('旧密码错误');
            if ($new_password != $new_password2)
                $this->myError('两次密码不一致');

            M('member')->where("uid={$this->my['uid']}")->save(array('password' => md5($new_password)));
            $this->mySuccess('msg_common_update_success');
        }
        $this->display();
    }

    public function settingMail() {
        $this->_setting();
        $this->display();
    }

    public function settingSeo() {
        $this->_setting();
        $this->display();
    }

    public function settingUrl() {
        if($_POST){
            $url_mod = ggp('url_mod:i');
            $str = '<?php $url_mod = array("URL_MODEL"=>'.$url_mod.');?>';
            $f = fopen('Conf/url_mod.php',w);
            fwrite($f, $str);
            fclose($f);
            $this->mySuccess('操作成功');
        }
        include 'Conf/url_mod.php';
        $this->a('url_mod',$url_mod);
        $this->display();
    }
    
    public function settingQQ() {
        if($_POST){
            $appid = ggp('appid:t2');
            $appkey = ggp('appkey:t2');
            $str = '<?php $config = array("appid"=>"'.$appid.'","appkey"=>"'.$appkey.'","callback"=>"http://'.$_SERVER['SERVER_NAME'].'/api/qqconnect/oauth/callback.php");';
            $f = fopen('api/qqconnect/config.php',w);
            fwrite($f, $str);
            fclose($f);
            $this->mySuccess('操作成功');
        }
        include 'api/qqconnect/config.php';
        $this->a('config',$config);        
        $this->display();
    }

    public function settingScore() {
        if(!M('setting')->where("setting_key='score_share'")->find()){
            M('setting')->add(array('setting_key'=>'score_share'));
        }
        $this->_setting();
        $this->display();
    }

    public function settingSite() {
        $op = ggp('op');
        if($op=='do'){//echo strlen($_POST['site_tongji']);exit; 
            if($_POST['site_tongji'] && strlen($_POST['site_tongji'])>=255){
                $this->mySuccess('统计代码过长，建议使用cnzz');
            }
            if($_FILES['site_logo']['size']>0){
               $res = $this->saveFile('misc');
                $_POST['site_logo'] = '/uploads/misc/'.$res['goods_img']; 
            }else{
                unset($_POST['site_logo']);
            }
            $this->_setting();
        }        
        $dir = 'Home/Tpl/';
            $mydir = dir($dir);
            while ($file = $mydir->read()) {
                if (is_dir($dir . $file) && !in_array($file, array('.', '..', 'a_tpl')))
                     $site_tpl[] = $file;
            }
            $this->a('site_tpl', $site_tpl);
        $this->display();
    }
    
    public function settingSlide(){
        $op = ggp('op');
        if($op=='do'){
            for($i=0;$i<5;$i++){
                $slide[$i] = ggp("slide{$i}:t2");
            }
            $_POST['slide'] = serialize($slide);
            $this->_setting();
        }
        $slide = unserialize($this->setting['slide']);
        
    }

    public function Setting() {
        $dir = 'Home/Tpl/';
        $mydir = dir($dir);
        $wx_dir = 'weixin/Tpl/';
        $wx_mydir = dir($wx_dir);
        while ($file = $mydir->read()) {
            if (is_dir($dir . $file) && !in_array($file, array('.', '..', 'a_tpl')))
                $theme[] = $file;
        }
        while ($file = $wx_mydir->read()) {
            if (is_dir($wx_dir . $file) && !in_array($file, array('.', '..')))
                $wx_theme[] = $file;
        }
        $host_name = explode(".", str_replace("www.", "", $_SERVER['HTTP_HOST']));
        $this->setting['zztj'] = file_get_contents('./Conf/zztj_' . $host_name[0] . '.txt');
        $this->a('setting', $this->setting);
        $this->a('theme', $theme);
        $this->a('wx_theme', $wx_theme);
        $this->display();
    }

    public function doSetting() {
        $info = $this->saveFile('site_logo', 'misc');
        $info2 = $this->saveFile('erweima', 'misc');
        if ($info['state']) {
            $_POST['site_logo'] = $info['path'];
        }
        if ($info2['state']) {
            $_POST['erweima'] = $info2['path'];
        }

        $_POST['msg_tpl'] = str_replace(",", "，", $_POST['msg_tpl']); //订单备注，统一转化为中文逗号
        $host_name = explode(".", str_replace("www.", "", $_SERVER['HTTP_HOST']));
        $f = fopen('./Conf/zztj_' . $host_name[0] . '.txt', 'w');
        fwrite($f, stripslashes($_POST['zztj']));
        fclose($f);
        unset($_POST['zztj']);
        foreach ($_POST as $key => $val) {
            $val = trim(htmlspecialchars($val));
            if (in_array($key, array("cuidan", "bili", "jifen_evaluate", "jifen_register", "jifen_order"))) {
                if ($val < 0)
                    $this->myError("运营设置项不能为负数");
            }
            M('setting')->where("setting_key='{$key}'")->save(array('setting_val' => $val));
        }
        $this->mySuccess(msg_common_update_success);
    }
    
    private function checkField($lang,$p){
        foreach($lang as $key=>$val){
            empty($p[$key]) && $this->mySuccess($val);
        }
    }

    private function setOrder($p, $table, $field) {
        foreach ($p as $key => $val) {
            list($hand, $id) = explode('_', $key);
            if ($hand === 'order') {
                $id = intval($id);
                $val = intval($val);
                M($table)->where("{$field}='{$id}'")->save(array('order' => $val));
            }
        }
    }
}