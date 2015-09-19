<?php
class AjaxPage {
    // 分页栏每页显示的页数
    public $rollPage = 5;
    // 页数跳转时要带的参数
    public $parameter  ;
    // 默认列表每页显示行数
    public $listRows = 20;
    // 起始行数
    public $firstRow ;
    // 分页总页面数
    protected $totalPages  ;
    // 总行数
    protected $totalRows  ;
    // 当前页数
    protected $nowPage    ;
    // 分页的栏的总页数
    protected $coolPages   ;
    // 分页显示定制
       protected $config  =    array('header'=>'条记录','prev'=>'上一页','next'=>'下一页','first'=>'首页','last'=>'末页','theme'=>'  <p class="fr">第%nowPage%页/共%totalPage%页</p>
	 <form action="%url%" class="fr">
          <input type="text" class="fl" placeholder="页码" name="p" id="p_page">
          <input type="button" class="pager-submit fl" value="搜索" onclick="search_page()">
        </form>  %upPage% %prePage% %linkPage% %nextPage% %downPage%  ' );
    // 默认分页变量名
    // 默认分页变量名
    protected $varPage;


    public function __construct($totalRows,$listRows='',$ajax_func,$parameter='') {
        $this->totalRows = $totalRows;
        $this->ajax_func = $ajax_func;
        $this->parameter = $parameter;
        $this->varPage = C('VAR_PAGE') ? C('VAR_PAGE') : 'p' ;
        if(!empty($listRows)) {
            $this->listRows = intval($listRows);
        }
        $this->totalPages = ceil($this->totalRows/$this->listRows);     //总页数
        $this->coolPages  = ceil($this->totalPages/$this->rollPage);
        $this->nowPage  = !empty($_GET[$this->varPage])?intval($_GET[$this->varPage]):1;
        if(!empty($this->totalPages) && $this->nowPage>$this->totalPages) {
            $this->nowPage = $this->totalPages;
        }
        $this->firstRow = $this->listRows*($this->nowPage-1);
    }

public function setConfig($name,$value) {
        if(isset($this->config[$name])) {
            $this->config[$name]    =   $value;
        }
    }


    public function show() {
        if(0 == $this->totalRows) return '';
        $p = $this->varPage;
        $nowCoolPage      = ceil($this->nowPage/$this->rollPage);
        $url  =  $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':"?").$this->parameter;
        $parse = parse_url($url);
        if(isset($parse['query'])) {
            parse_str($parse['query'],$params);
            unset($params[$p]);
            $url   =  $parse['path'].'?'.http_build_query($params);
        }
        //上下翻页字符串
        $upRow   = $this->nowPage-1;
        $downRow = $this->nowPage+1;
        if ($upRow>0){
            $upPage="<a id='big' href='javascript:".$this->ajax_func."(".$upRow.")' class='pager-btn'>".$this->config['prev']."</a>";
        }else{
            $upPage="";
        }

if ($downRow <= $this->totalPages){
            $downPage="<a id='big' href='javascript:".$this->ajax_func."(".$downRow.")' class='pager-btn'>".$this->config['next']."</a>";
        }else{
            $downPage="";
        }
        // << < > >>
        if($nowCoolPage == 1){
            $theFirst = "";
            $prePage = "";
        }else{
            $preRow =  $this->nowPage-$this->rollPage;
           // $prePage = "<a id='big' href='javascript:".$this->ajax_func."(".$preRow.")'>上".$this->rollPage."页</a>";
            $theFirst = "<a id='big' href='javascript:".$this->ajax_func."(1)' >".$this->config['first']."</a>";
        }
        if($nowCoolPage == $this->coolPages){
            $nextPage = "";
            $theEnd="";
        }else{
            $nextRow = $this->nowPage+$this->rollPage;
            $theEndRow = $this->totalPages;
           // $nextPage = "<a id='big' href='javascript:".$this->ajax_func."(".$nextRow.")' >下".$this->rollPage."页</a>";
            $theEnd = "<a id='big' href='javascript:".$this->ajax_func."(".$theEndRow.")' >".$this->config['last']."</a>";
        }
        // 1 2 3 4 5
        $linkPage = "";
        for($i=1;$i<=$this->rollPage;$i++){
            $page=($nowCoolPage-1)*$this->rollPage+$i;
            if($page!=$this->nowPage){
                if($page<=$this->totalPages){
                   $linkPage .= "&nbsp;<a id='big' href='javascript:".$this->ajax_func."(".$page.")'>".$page."</a>";
                }else{
                    break;
                }
            }else{
                if($this->totalPages != 1){
                    $linkPage .= "&nbsp;<span class='pager-curr'>".$page."</span>";
                }
            }
        }
		if($this->totalPages>$this->nowPage)
		{
			$linkPage=$linkPage."<span>···</span>";
		}
        $pageStr  =  str_replace(
            array('%url%','%header%','%nowPage%','%totalRow%','%totalPage%','%upPage%','%downPage%','%first%','%prePage%','%linkPage%','%nextPage%','%end%'),
            array($urls,$this->config['header'],$this->nowPage,$this->totalRows,$this->totalPages,$upPage,$downPage,$theFirst,$prePage,$linkPage,$nextPage,$theEnd),$this->config['theme']);
        return $pageStr;
    }

}

 php?>