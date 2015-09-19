<?php
class SetImage {
	
	/*
	$from_img    :图片路径
	$to_img      :生成后路径
	$new_width   :新图宽度
	$new_height  :新图高度
	$if_cut      :是否截图 1为截
	*/

	function Resize($from_img, $to_img, $new_width, $new_height, $if_cut = 1) { 
		//图片类型 
		$img_type = strtolower(substr(strrchr($from_img,"."),1)); 		
		
		//原始图象的宽和高，如果缩略的图像大于规格才进行缩小。 
		$old_width = imagesx($this->TempImg($from_img)); 
		$this->_width = $old_width;
		if($new_width>$old_width){$new_width=$old_width;}
		$old_height = imagesy($this->TempImg($from_img)); 
		$this->_height = $old_height;
		if($new_height>$old_height){$new_height=$old_height;}
		
		//改变前后的图象的比例 
		$new_ratio = $new_width/$new_height; 
		$old_ratio = $old_width/$old_height; 
		
		//生成新图象的参数 
		//情况一：裁图 则按设置的大小生成目标图象 
		if($if_cut=="1") { 
		//高度优先 
			if($old_ratio>=$new_ratio) { 
				$old_width = $old_height*$new_ratio; 
			} else { //宽度优先 
				$old_height = $old_width/$new_ratio; 
			} 
		} else { //情况二：不裁图 则按比例生成目标图象 
			//高度优先 
			if($old_ratio>=$new_ratio) { 
				$new_height = $new_width/$old_ratio; 
				if($new_height < 5) $new_height = 5;
			} else { //宽度优先 
				$new_width = $new_height*$old_ratio; 
				if($new_width < 5) $new_width = 5;
			} 
		} 
		//生成新图片 
		$new_img = imagecreatetruecolor($new_width,$new_height); 
		imagecopyresampled($new_img,$this->TempImg($from_img),0,0,0,0,$new_width,$new_height,$old_width,$old_height); 
		
		if($img_type=="jpg") imagejpeg($new_img, $to_img, 100); 
		if($img_type=="gif") imagegif($new_img,$to_img, 100); 
		if($img_type=="png") imagepng($new_img,$to_img, 100); 
		
		imagedestroy($new_img);
		
		//返回缩略图;文件名
		return $to_img;
	}
	function ResizeX($from_img, $to_img, $new_width, $new_height, $if_cut = 1) { 
		//图片类型 
		$img_type = strtolower(substr(strrchr($from_img,"."),1)); 		
		
		//原始图象的宽和高，如果缩略的图像大于规格才进行缩小。 
		$old_width = imagesx($this->TempImg($from_img)); 
		$this->_width = $old_width;
		if($new_width>$old_width){$new_width=$old_width;}
		$old_height = imagesy($this->TempImg($from_img)); 
		$this->_height = $old_height;
		if($new_height>$old_height){$new_height=$old_height;}
		
		//改变前后的图象的比例 
		$new_ratio = $new_width/$new_height; 
		$old_ratio = $old_width/$old_height; 
		
		//生成新图象的参数 
		//情况一：裁图 则按设置的大小生成目标图象 
		if($if_cut=="1") { 
		//高度优先 
			if($old_ratio>=$new_ratio) { 
				$old_width = $old_height*$new_ratio; 
			} else { //宽度优先 
				$old_height = $old_width/$new_ratio; 
			} 
		} else { //情况二：不裁图 则按比例生成目标图象 
			//高度优先 
	
				$new_height = $new_width/$old_ratio; 
				if($new_height < 5) $new_height = 5;
		
		} 
		//生成新图片 
		$new_img = imagecreatetruecolor($new_width,$new_height); 
		imagecopyresampled($new_img,$this->TempImg($from_img),0,0,0,0,$new_width,$new_height,$old_width,$old_height); 
		
		if($img_type=="jpg") imagejpeg($new_img, $to_img, 100); 
		if($img_type=="gif") imagegif($new_img,$to_img, 100); 
		if($img_type=="png") imagepng($new_img,$to_img, 100); 
		
		imagedestroy($new_img);
		
		//返回缩略图;文件名
		return $to_img;
	}
	/*高度优先的相关函数*/
	function ResizeY($from_img, $to_img, $new_width, $new_height, $if_cut = 1) { 
		//图片类型 
		$img_type = strtolower(substr(strrchr($from_img,"."),1)); 		
		
		//原始图象的宽和高，如果缩略的图像大于规格才进行缩小。 
		$old_width = imagesx($this->TempImg($from_img)); 
		$this->_width = $old_width;
		if($new_width>$old_width){$new_width=$old_width;}
		$old_height = imagesy($this->TempImg($from_img)); 
		$this->_height = $old_height;
		if($new_height>$old_height){$new_height=$old_height;}
		
		//改变前后的图象的比例 
		$new_ratio = $new_width/$new_height; 
		$old_ratio = $old_width/$old_height; 
		
		//生成新图象的参数 
		//情况一：裁图 则按设置的大小生成目标图象 
		if($if_cut=="1") { 
		//高度优先 
			if($old_ratio>=$new_ratio) { 
				$old_width = $old_height*$new_ratio; 
			} else { //宽度优先 
				$old_height = $old_width/$new_ratio; 
			} 
		} 
	else
		{ //情况二：不裁图 则按比例生成目标图象 
			 
		
				$new_width = $new_height*$old_ratio; 
				if($new_width < 5) $new_width = 5;
			
		} 
		//生成新图片 
		$new_img = imagecreatetruecolor($new_width,$new_height); 
		imagecopyresampled($new_img,$this->TempImg($from_img),0,0,0,0,$new_width,$new_height,$old_width,$old_height); 
		
		if($img_type=="jpg") imagejpeg($new_img, $to_img, 100); 
		if($img_type=="gif") imagegif($new_img,$to_img, 100); 
		if($img_type=="png") imagepng($new_img,$to_img, 100); 
		
		imagedestroy($new_img);
		
		//返回缩略图;文件名
		return $to_img;
	}
	
	
	/*
	输出数据流方式
	-
	$from_img    :图片路径
	$new_width   :新图宽度
	$new_height  :新图高度
	$if_cut      :是否截图 1为截
	*/
	
	function MakeTempImage($from_img, $new_width, $new_height, $if_cut = 1) {
		header('Content-type: image/jpeg');
		$this->Resize($from_img, '', '60', '60', $if_cut = 1);
	}
	
	
	/*
	图片加水印
	参数:
	$from_img    - 加水印图片路径
	$makrurl     - 水印图片路径
	*/
	function Remark($from_img, $markurl = '') {
		//图片类型 
		$img_type = strtolower(substr(strrchr($markurl,"."),1)); 
		
		//初始化图像
		$temp_from_img = $this->TempImg($from_img);
		$temp_markurl_img = $this->TempImg($markurl);
		
		//计算得出水印在图片上的位置
		$imgw = imagesx($temp_from_img) - (imagesx($temp_markurl_img)+10);
		$imgh = imagesy($temp_from_img) - (imagesy($temp_markurl_img)+5);
		if($imgw < 0) {$imgw = 0;} //宽度不够
		if($imgh < 0) {$imgh = 0;} //高度不够
		
		//水印
		$Mark = $this->TempImg($markurl);
		//图片 
		$new_img = $this->TempImg($from_img);
		//
		imagecopy($new_img, $Mark, $imgw, $imgh, 0, 0, imagesx($temp_markurl_img), imagesy($temp_markurl_img));
		imagejpeg($new_img, $from_img, 100);
		imagedestroy($new_img);
	}
	
	
	
	/*
	初始化图像
	参数 - 
	$from_img   - 要初始化的图像路径
	*/
	function TempImg($from_img) {
		//图片类型 
		$img_type = strtolower(substr(strrchr($from_img, "."),1)); 
		
		if($img_type=="jpg") $temp_img = @imagecreatefromjpeg($from_img); 
		if($img_type=="gif") $temp_img = @imagecreatefromgif($from_img); 
		if($img_type=="png") $temp_img = @imagecreatefrompng($from_img);
		//
		return $temp_img;
	}
	
	
	
	/*====================================
	文件上传
	$InputName    - 上传表单文件域名
	$UpPath       - 上传文件路径
	$FileType     - 允许上传的文件类型，文件扩展名以度号分开
	$Size         - 允许上传的大小，单位M
	$mark         - 文件标识前缀
	*/
	function UpFile($InputName, $UpPath, $FileType, $Size = 2, $mark, $Back = '') {

		set_time_limit(0);
		/*
		$userupimgfile        = 表单名
		$upimgpath            = 文件路径
		$filetype             = 文件上传类型
		$size                 = 文件大小限止(K)
		$back                 = 返回类型，1为返回上页，0为停止执行。
		*/
		
		$UID = $_SESSION['uid'];
		//1 为严格检查上传文件类型,2 判断文件后缀。
		$UpFileType = 2; 
		//
		if($FileType == 'jpg,gif,png') {
			$UpFileType = 1; 
		}
		//文件大小
		$File_Size = $_FILES[$InputName]['size'];
		//文件类型
		$File_Type = $_FILES[$InputName]['type'];
		//文件本地名称
		$File_Name = $_FILES[$InputName]['name'];
		
		//成生文字类型数组
		$FileType = explode(',',$FileType);
		//限文件大小，按字节
		$UpFileSize = ($Size*1024*1024);

		//文件判断类型
		if($UpFileType == 1) {//严格判断
			switch($File_Type) {
				// OFFICE
				case "application/msword": $Type='doc';break;
				case "application/vnd.ms-excel": $Type = 'xls';break;
				case "application/vnd.ms-powerpoint": $Type = 'ppt';break;
				//压缩
				case "application/octet-stream": $Type = 'rar';break;
				//文本
				case "text/plain": $Type = 'txt';break;
				//图片
				case "image/pjpeg": $Type = 'jpg';break;
				case "image/jpg": $Type = 'jpg';break;
				case "image/jpeg": $Type = 'jpg';break;
				case "image/gif": $Type = 'gif';break;
				case "image/x-png": $Type = 'png';break;
				case "image/png": $Type = 'png';break;
				case "image/bmp": $Type = 'bmp';break;
				//错误类型
				default: $Type = 'err';
			}
		} else {
			//根据扩展名判断
			$Type = strtolower(substr(strrchr($File_Name,"."),1));
		}
		//定义返回
		if($Back == 1) {
			$Back = "window.location.href=('javascript:history.back()')";
		}
		//判断上传文件类型是否合法
		if($File_Size > 0) { //文件不为空
			if(!in_array($Type, $FileType) || $Type == 'err') {
				echo "<script>alert('暂不支持此文件类型。');top.document.getElementById('submit').disabled=false;top.imgList.location.href=('?".$_SERVER['QUERY_STRING']."');</script>";
				exit;
			}
		} else { // 文件为空
			$Type = 'err';
		}

		//判断大小
		if($File_Size > $UpFileSize) {
			if($mark == 'p') {
				echo "<script>alert('您的上传的文件不能大于".$Size."M。');window.location.href=('javascript:history.back()');parent.document.getElementById('submit').disabled=false</script>";
				exit;
			}
			BASE::js_msg('您的上传的文件不能大于'.$Size.'M。');
		}
		
		//类型合法上传文件
		if($Type != 'err'){
			$FileTime = $UID.date('YmdHis');
			@$UpFile = $UpPath.$mark.'_'.$FileTime.".".$Type;  //文件所放的路径
			if(is_uploaded_file($_FILES[$InputName]['tmp_name'])){
				if(!move_uploaded_file($_FILES[$InputName]['tmp_name'], $UpFile)){
					return false;
					exit;
				}
			} else {
				return false;
				exit;
			}
			
			$UpFile = $mark.'_'.$FileTime.".".$Type;//截路径
			$File[0] = $UpFile;
			$File[1] = $File_Name;
			$File[2] = $File_Size;
		} else {
			$File = '';
		}
		return $File;
	}
	//END
	
	
	
	

}
?>