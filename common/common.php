<?php
function t2($text){
    $text = nl2br($text);
    $text = real_strip_tags($text);
    $text = addslashes($text);
    $text = trim($text);
    return $text;
}

/** 
 * h函数用于过滤不安全的html标签，输出安全的html
 * @param string $text 待过滤的字符串
 * @param string $type 保留的标签格式
 * @return string 处理后内容
 */
function h2($text, $type = 'html'){
    // 无标签格式
    $text_tags  = '';
    //只保留链接
    $link_tags  = '<a>';
    //只保留图片
    $image_tags = '<img>';
    //只存在字体样式
    $font_tags  = '<i><b><u><s><em><strong><font><big><small><sup><sub><bdo><h1><h2><h3><h4><h5><h6>';
    //标题摘要基本格式
    $base_tags  = $font_tags.'<p><br><hr><a><img><map><area><pre><code><q><blockquote><acronym><cite><ins><del><center><strike>';
    //兼容Form格式
    $form_tags  = $base_tags.'<form><input><textarea><button><select><optgroup><option><label><fieldset><legend>';
    //内容等允许HTML的格式
    $html_tags  = $base_tags.'<meta><ul><ol><li><dl><dd><dt><table><caption><td><th><tr><thead><tbody><tfoot><col><colgroup><div><span><object><embed><param>';
    //专题等全HTML格式
    $all_tags   = $form_tags.$html_tags.'<!DOCTYPE><html><head><title><body><base><basefont><script><noscript><applet><object><param><style><frame><frameset><noframes><iframe>';
    //过滤标签
    $text = real_strip_tags($text, ${$type.'_tags'});
    // 过滤攻击代码
    if($type != 'all') {
        // 过滤危险的属性，如：过滤on事件lang js
        while(preg_match('/(<[^><]+)(ondblclick|onclick|onload|onerror|unload|onmouseover|onmouseup|onmouseout|onmousedown|onkeydown|onkeypress|onkeyup|onblur|onchange|onfocus|action|background|codebase|dynsrc|lowsrc)([^><]*)/i',$text,$mat)){
            $text = str_ireplace($mat[0], $mat[1].$mat[3], $text);
        }
        while(preg_match('/(<[^><]+)(window\.|javascript:|js:|about:|file:|document\.|vbs:|cookie)([^><]*)/i',$text,$mat)){
            $text = str_ireplace($mat[0], $mat[1].$mat[3], $text);
        }
    }
    return $text;
}


function getPre(){
	return C('DB_PREFIX');
}

function ggp($key,$param=''){
	if(empty($param)){
		list($key,$param) = explode(':', $key);
	}	
	$input = array_merge($_GET,$_POST);
	$val = $input[$key];
	return _s($val,$param);
}
function gg($key,$param=''){
	if(empty($param)){
		list($key,$param) = explode(':', $key);
	}
	
	$val = $_GET[$key];
	return _s($val,$param);
}

function gp($key,$param=''){
	if(empty($param)){
		list($key,$param) = explode(':', $key);
	}
	$val = $_POST[$key];
	return _s($val,$param);
}

function _s($val,$param){
	$params = explode(',', $param);
	foreach($params as $p){
		switch($p){
		case 'i':$val = intval($val);break;
		case 't':$val = trim($val);break;
		case 'h':$val = htmlspecialchars($val);break;
		case 's':$val = strip_tags($val);break;
                case 'h2':$val = h2($val);break;
                case 't2':$val = t2($val);break;
		}
	}
	return $val;
}
function cutstr($string, $length, $dot = ' ...') {
	if(strlen($string) <= $length) {
		return $string;
	}
	
	$pre = chr(1);
	$end = chr(1);
	$string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array($pre.'&'.$end, $pre.'"'.$end, $pre.'<'.$end, $pre.'>'.$end), $string);

	$strcut = '';
	if(strtolower(CHARSET) == 'utf-8') {

		$n = $tn = $noc = 0;
		while($n < strlen($string)) {

			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t <= 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}

			if($noc >= $length) {
				break;
			}

		}
		if($noc > $length) {
			$n -= $tn;
		}

		$strcut = substr($string, 0, $n);

	} else {
		$_length = $length - 1;
		for($i = 0; $i < $length; $i++) {
			if(ord($string[$i]) <= 127) {
				$strcut .= $string[$i];
			} else if($i < $_length) {
				$strcut .= $string[$i].$string[++$i];
			}
		}
	}

	$strcut = str_replace(array($pre.'&'.$end, $pre.'"'.$end, $pre.'<'.$end, $pre.'>'.$end), array('&amp;', '&quot;', '&lt;', '&gt;'), $strcut);

	$pos = strrpos($strcut, chr(1));
	if($pos !== false) {
		$strcut = substr($strcut,0,$pos);
	}
	return $strcut.$dot;
}

function lang($code){
	return $code;
}

function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
	$ckey_length = 4;
	$key = md5($key ? $key : SITE_URL);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);
	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);
	$result = '';
	$box = range(0, 255);
	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}
	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}
	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}
	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}
}

/**
 * t函数用于过滤标签，输出没有html的干净的文本
 * @param string text 文本内容
 * @return string 处理后内容
 */
function stripTags($text){
    $text = nl2br($text);
    $text = real_strip_tags($text);
    $text = addslashes($text);
    $text = trim($text);
    return $text;
}

function real_strip_tags($str, $allowable_tags=""){
    $str = html_entity_decode($str,ENT_QUOTES,'UTF-8');
    return strip_tags($str, $allowable_tags);
}


function filterField($key,$val,$int,$stripTags,$double){
	if($int && in_array($key, $int)){
		return intval($val);
	}
	if($stripTags && in_array($key, $stripTags)){
		return stripTags($val);
	}
	if($double && in_array($key, $double)){
		return doubleval($val);
	}
	return $val;
}

/**
 * 获取字符串的长度
 *
 * 计算时, 汉字或全角字符占1个长度, 英文字符占0.5个长度
 *
 * @param string  $str
 * @param boolean $filter 是否过滤html标签
 * @return int 字符串的长度
 */
function get_str_length($str, $filter = false){
    if ($filter) {
        $str = html_entity_decode($str, ENT_QUOTES, 'UTF-8');
        $str = strip_tags($str);
    }
    return (strlen($str) + mb_strlen($str, 'UTF8')) / 4;
}

function orderStateNotice($to,$msg,$set){
    $addr_id['id'] = $to;
    $mobile = M("address")->where($addr_id)->getField("mobile");
    dump($to);dump($msg);dump($set);dump($mobile);
    $a = mobile_sms($mobile,$msg,$set);
    dump($a);
    exit;
}

function loadBm(){
	echo '<script type="text/javascript" src="'.PUBLIC_URL.'um/umeditor.config.js"></script>
                                <script type="text/javascript" src="'.PUBLIC_URL.'um/umeditor.js"></script>
                                <script type="text/javascript" src="'.PUBLIC_URL.'um/lang/zh-cn/zh-cn.js"></script>
                                <link href="'.PUBLIC_URL.'um/themes/default/css/umeditor.min.css" type="text/css" rel="stylesheet">';
}

function newBm($name,$content='',$width='100%',$height='160px',$var='editor'){
	echo '<script type="text/plain" id="'.$name.'" name="'.$name.'" style="width:'.$width.';height:'.$height.';"></script>';	
	echo '<script type="text/javascript">var '.$var.' = UM.getEditor("'.$name.'");'.$var.'.setContent("'.$content.'");</script>';
}

function setParam($name,$value=''){
	if(is_array($name)){
		foreach($name as $key=>$val){
			echo "<input type='hidden' name='{$key}' value='{$val}'>";
		}
	}else{
		echo "<input type='hidden' name='{$name}' value='{$value}'>";
	}	
}

function ajaxJson($state,$msg,$url=''){
	exit(json_encode(array('state'=>$state,'msg'=>L($msg))));
}

function evaluateLang($type,$score){
	$lang = array(
		'kouwei'=>array('1'=>'不能容忍，不会在来','2'=>'','3'=>'不是我的菜','4'=>'还可以，会再来','5'=>'非常满意',),
		'service'=>array('1'=>'没服务，不会再来','2'=>'','3'=>'没什么感觉','4'=>'挺热情','5'=>'非常贴心',),
		'speed'=>array('1'=>'等的花都谢了','2'=>'','3'=>'等了一小会','4'=>'比较快','5'=>'豹的速度',),
	);
	
	return $lang[$type][$score]; 
}

function sms($sp_moblie, $msg_str, $set){
	return mobile_sms($sp_moblie, $msg_str, $set);
}

function mobile_sms($moblie,$content,$set){
    /*
	$set['sms'] = unserialize($set['sms']);
	if(!$set['sms']['url'] || !$set['sms']['code']){
		return mobile_sms4($moblie,$content,$set);
	}
	if($set['sms']['charset']==1){
		$set['sms']['url'] = iconv('UTF-8', 'GBK//IGNORE', $set['sms']['url']);
	}
	$re = array("{mobile}","{content}");
	$re_str = array($moblie,$content);
	$set['sms']['url'] = str_replace($re,$re_str,$set['sms']['url']);
	$code = file_get_contents($set['sms']['url']);
     */
	return true;
}

function mobile_sms4($sp_moblie,$msg_str,$set){
	//http://210.5.158.31/hy?uid=1234&auth=faea920f7412b5da7be0cf42b8c93759&mobile=13612345678&msg=hello&expid=0
	$set['sms_pwd'] = md5("07279870-1123qweasd");
	$set['sms_uname'] = '503281';
	$smsUrl = "http://210.5.158.31:9011/hy?uid={$set['sms_uname']}&auth={$set['sms_pwd']}&mobile={$sp_moblie}&msg={$msg_str}&expid=0&encode=utf-8";
	$state = intval(file_get_contents($smsUrl));
	/*
	$h = fopen('./sms.txt','w');
	fwrite($h, $state);
	fclose($h);
	*/
	return intval($state)<0?false:true;
}

function mobile_sms3($sp_moblie,$msg_str,$set){
	$user = '70200874';
	$password = '365610866';
	$password = md5($password);
	$smsUrl = "http://api.momingsms.com/?action=send&username={$user}&password={$password}&phone={$sp_moblie}&content={$msg_str}&encode=utf8";
	$state = intval(file_get_contents($smsUrl));
	return intval($state)==100?true:false;
}

function post($url, $param=array()){
    if(!is_array($param)){
        throw new Exception("参数必须为array");
    }
   $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// 我们在POST数据哦！
	curl_setopt($ch, CURLOPT_POST, 1);
	// 把post的变量加上
	curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
	$output = curl_exec($ch);
	curl_close($ch);
    return $output;
 }

function iniSetting($setting){
    foreach($setting as $key=>$val){
            $settingList[$val['setting_key']] = $val['setting_val']; 
    }
    return $settingList;
}
	
function validEmail($email) {
	return preg_match("/^[_a-zA-Z\d\-\.]+@[_a-zA-Z\d\-]+(\.[_a-zA-Z\d\-]+)+$/i", $email) !== 0;
}

function OutputExcel($excelArr,$title,$tit="订单统计"){
    	Vendor('PHPExcel.PHPExcel');
    	$objPHPExcel = new PHPExcel();
    	$objPHPExcel->getProperties()  //获得文件属性对象，给下文提供设置资源
	    ->setCreator( "xinba")                 //设置文件的创建者
	    ->setLastModifiedBy( "xinba")          //设置最后修改者
	    ->setTitle( "Office 2007 XLSX Test Document" )    //设置标题
	    ->setSubject( "Office 2007 XLSX Test Document" )  //设置主题
	    ->setDescription( "Test document for Office 2007 XLSX, generated using PHP classes.") //设置备注
	    ->setKeywords( "office 2007 openxml php")        //设置标记
	    ->setCategory( "Test result file");                //设置类别
		$arrNum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$excelArr = array_merge(array($title),$excelArr);
		$obj = $objPHPExcel->setActiveSheetIndex(0); 
	    $j=1;
	    $count = count($excelArr[0]);
	    foreach($excelArr as $k=>$v){	    	
	    	$newData = array_values($v);
	    	for($i=0;$i<$count;$i++){
				$obj->setCellValue( $arrNum{$i}."{$j}",$newData[$i]);
	    	}
	    	$j++;     
	    }
        $objActSheet = $objPHPExcel->getActiveSheet();
        $objActSheet->setTitle("{$tit}");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('myexchel.xlsx');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$tit.'.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
}

function isMobile(){  
    $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';  
    $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';        
    function CheckSubstrs($substrs,$text){  
        foreach($substrs as $substr)  
            if(false!==strpos($text,$substr)){  
                return true;  
            }  
            return false;  
    }
    $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
    $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');  
          
    $found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) ||  
              CheckSubstrs($mobile_token_list,$useragent);  
          
    if ($found_mobile){  
        return true;  
    }else{  
        return false;  
    }  
}
//获取网站顶级域名
function getdomain($url) {
	$host = strtolower ( $url );
	if (strpos ( $host, '/' ) !== false){
	$parse = @parse_url ( $host );
	$host = $parse ['host'];
	} 
	$topleveldomaindb = array ('com', 'edu', 'gov', 'int', 'mil', 'net', 'org', 'biz', 'info', 'pro', 'name', 'museum', 'coop', 'aero', 'xxx', 'idv', 'mobi', 'cc', 'me' ); 
	$str = ''; 
	foreach ( $topleveldomaindb as $v ) { 
	$str .= ($str ? '|' : '') . $v; 
	} 
	
	$matchstr = "[^\.]+\.(?:(" . $str . ")|\w{2}|((" . $str . ")\.\w{2}))$"; 
	if (preg_match ( "/" . $matchstr . "/ies", $host, $matchs )) { 
	$domain = $matchs ['0']; 
	} else { 
	$domain = $host; 
	} 
	return $domain; 
}

//邮件发送函数
function sendMail($title,$msg,$address,$set){
    if(empty($title) || empty($msg) || empty($address) || empty($set)) return false;
    $set['title'] = $title;
    $temp = "smtp".strstr($set['mail_login_name'],"@");
    $set['mail_smtp'] = str_replace("@", ".", $temp);

    Vendor('PHPMailer.phpmailer');
    $mail=new PHPMailer();
    // 设置PHPMailer使用SMTP服务器发送Email
    $mail->IsSMTP();
    // 设置邮件的字符编码，若不指定，则为'UTF-8'
    $mail->CharSet='UTF-8';
    // 添加收件人地址，可以多次使用来添加多个收件人
    $mail->AddAddress($address);
    // 设置邮件正文
    $mail->Body=$msg;
    // 设置邮件头的From字段。
    $mail->From=$set['mail_login_name'];
    // 设置发件人名字
    $mail->FromName=$set['from_name'];
    // 设置邮件标题
    $mail->Subject=$title;
    // 设置SMTP服务器。
    $mail->Host=$set['mail_smtp'];
    // 设置为“需要验证”
    $mail->SMTPAuth=true;
    // 设置用户名和密码。
    $mail->Username=$set['mail_login_name'];
    $mail->Password=$set['mail_password'];
    // 发送邮件。
    return($mail->Send());
} 


//验证邮件地址
function is_email($email){
    return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-]+(\.\w+)+$/", $email)?true:false;
}
//验证电话号码 
function is_phone($str) 
{ 
     return (preg_match("/^((0\d{2,3}))(\d{7,8})(-(\d{3,}))?$/",$str))?true:false;
}
//验证手机号码
function is_mobile($str){
    return (preg_match("/^1\d{10}$/",$str))?true:false;
} 
//验证邮编 
function is_zip($str) 
{ 
   return (preg_match("/^[1-9]\d{5}$/",$str))?true:false; 
} 
//验证url地址 
function is_url($str) 
{ 
   return (preg_match("/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/",$str))?true:false; 
}
//验证身份证号码
function is_status($str)
{
   return (preg_match('/(^([\d]{15}|[\d]{18}|[\d]{17}x)$)/',$str))?true:false;
}
//生成缩略图
function getThumb($filepath,$thumbpath, $type='', $maxWidth=236, $maxHeight=150,$prefix = "thumb_"){
	$imgname = explode("/",$filepath);
	$c=count($imgname)-1;
	$thumbpath = $thumbpath?$thumbpath:dirname($filepath).'/';
	import("ORG.Util.Image");
	$thumb = Image::thumb($filepath, $thumbpath.$prefix.$imgname[$c], $type='', $maxWidth, $maxHeight, $interlace=true);
	return $thumb;
}

function urlSwitch($url,$vars){
	$Rewrite = C("URL_MODEL");
	if($Rewrite==2){
		$url_arr = explode("/",$url);
		$url = $url_arr[1];
		if(is_array($vars)){
			$check = array("sid","sort_id","aid");
			foreach($vars as $k=>$v){
				if(in_array($k, $check)){
					$url .= "/".$v;
				}else if($v){
					$url .= "/".$k."/".$v;
				}
			}
		}
		return $url;
	}else{
		return U($url,$vars);
	}
}