<?php

class IniAction extends Action {

    public $my;
    public $mod;
    public $act;
    public $gp;
    public $setting;
    public $pre;
    public $adlist;

    public function __construct() {
        parent::__construct();
        $this->ini();
        $this->iniad();
        $plugin =  "public/plugin.php";
        if(file_exists($plugin)){
            include $plugin;
        }
        if (strtolower($this->mod)!='wap' && isMobile()) {
            header("location:" . SITE_URL . 'index.php?m=wap');exit;
        }
    }        

    public function ini() {
        $authcookie = cookie('authcookie');
        if ($authcookie) {
            list($uid, $password) = explode("\t", authcode($authcookie, 'DECODE'));
            if ($uid && $password) {
                $this->my = D('Member')->where("uid='{$uid}' and password='{$password}'")->find();
                $this->assign('my', $this->my);
            }
        }
        $this->gp = array_merge($_GET, $_POST);
        $this->mod = MODULE_NAME;
        $this->act = ACTION_NAME;
        $this->pre = C('DB_PREFIX');
        $this->iniSetting();
        $this->_getNav();
        $this->_getFooterArticle();
        $this->a('setting', $this->setting);
        $this->a('mod', strtolower($this->mod));
        $this->a('act', strtolower($this->act));
        $this->a('my', $this->my);
    }
    
    public function iniAd(){
        $adlist = S('adlist');
        if(!$adlist){
            $adlist = M('ad')->where('state=1')->order('`order` desc')->select();
            S('adlist',$adlist,3600*10);
        }
        $this->adlist = $adlist;
        $this->a('adlist', $adlist);
    }

    private function iniSetting() {
        $settingList = iniSetting(M('setting')->select());
        $this->setting = $settingList;
        $this->setting['theme'] && C('DEFAULT_THEME', $this->setting['theme']);
        $this->setting['html_suffix'] && C('TMPL_TEMPLATE_SUFFIX', $this->setting['html_suffix']);
    }

    private function _getNav() {
        $nav = S('nav');
        if(empty($nav)){
            $where['state'] = 1;
            $where['nav'] = 1;
            $nav = M('sort')->where($where)->order("`order` DESC,`sort_id` DESC")->limit(9)->select();
            S('nav',$nav,3600);
        }
        $this->assign('nav', $nav);
    }

    private function _getFooterArticle() {

        $where_asort['state'] = 1;
        $where_asort['type'] = 2;
        $where_asort['fnav'] = 1;
        $articleSort = M('sort')->where($where_asort)->limit(4)->order('`order` DESC,sort_id DESC')->select();
		//echo M()->getlastsql();
		//exit;
        foreach ($articleSort as $k => $v) {
            $where_article['state'] = 1;
            $where_article['sort_id'] = $v['sort_id'];
            $article[$v['sort_id']] = M('article')->where($where_article)->limit(3)->order('`order` DESC,aid DESC')->select();
        }
        $this->assign('article', $article);
        $this->assign('articleSort', $articleSort);
    }

    public function isLogin($referer = "") {
        if (empty($this->my)) {
            if (false && $referer) {
                $this->myError(L('error_member_no_login'), U('member/login', array('referer' => $referer)));
            } else {
                $this->myError(L('error_member_no_login'), U('member/login'));
            }
        }
    }

    public function isAdmin() {
        if (empty($this->my) || $this->my['level'] <= 0)
            $this->error(L('error_member_not_admin'), U('admin/login'));
    }

    public function a($n, $v) {
        if ($n[0] == '$') {
            $n = substr($n, 1);
        }
        $this->assign($n, $v);
    }

    public function d($tpl = '') {
        $this->display($tpl);
    }

    public function iniPage($count, $listRows = 20) {
        import('ORG.Util.Page');
        $page = new Page($count, $listRows);
        $page->rollPage = 7;
        return $page;
    }

    public function mySuccess($message = '', $jumpUrl = '', $ajax = false) {
        if (IS_AJAX) {
            ajaxJson(1, $message);
        }
        $this->success(L($message), $jumpUrl, $ajax);
        exit;
    }

    public function myError($message = '', $jumpUrl = '', $ajax = false) {
        if (IS_AJAX) {
            ajaxJson(0, $message);
        }
        $this->error(L($message), $jumpUrl, $ajax);
        exit;
    }

    public function saveFile($path, $size = 3145728, $exts = array('jpg', 'gif', 'png', 'jpeg')) {
        import('ORG.Net.UploadFile');
        $upload = new UploadFile(); // 实例化上传类
        $upload->maxSize = $size; // 设置附件上传大小
        $upload->thumb = true;
        $upload->thumbMaxWidth = "236";
        $upload->thumbMaxHeight = "150";
        $upload->allowExts = $exts; // 设置附件上传类型
        $upload->savePath = "./uploads/{$path}/"; // 设置附件上传目录
        if (!$upload->upload()) {//上传错误提示错误信息
            return array('state' => -1, 'msg' => $upload->getErrorMsg());
        } else {// 上传成功 获取上传文件信息
            $info = $upload->getUploadFileInfo();
        }
        return array('state' => 1, 'goods_img' => $info[0]['savename']);
    }

    public function myCheckToken($data = '') {
        $data == '' && $data = $_POST;
        if (!M()->autoCheckToken($_POST))
            $this->myError('error_token');
    }

}
