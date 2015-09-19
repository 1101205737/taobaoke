<?php
class SetImage {
	
	/*
	$from_img    :ͼƬ·��
	$to_img      :���ɺ�·��
	$new_width   :��ͼ���
	$new_height  :��ͼ�߶�
	$if_cut      :�Ƿ��ͼ 1Ϊ��
	*/

	function Resize($from_img, $to_img, $new_width, $new_height, $if_cut = 1) { 
		//ͼƬ���� 
		$img_type = strtolower(substr(strrchr($from_img,"."),1)); 		
		
		//ԭʼͼ��Ŀ�͸ߣ�������Ե�ͼ����ڹ��Ž�����С�� 
		$old_width = imagesx($this->TempImg($from_img)); 
		$this->_width = $old_width;
		if($new_width>$old_width){$new_width=$old_width;}
		$old_height = imagesy($this->TempImg($from_img)); 
		$this->_height = $old_height;
		if($new_height>$old_height){$new_height=$old_height;}
		
		//�ı�ǰ���ͼ��ı��� 
		$new_ratio = $new_width/$new_height; 
		$old_ratio = $old_width/$old_height; 
		
		//������ͼ��Ĳ��� 
		//���һ����ͼ �����õĴ�С����Ŀ��ͼ�� 
		if($if_cut=="1") { 
		//�߶����� 
			if($old_ratio>=$new_ratio) { 
				$old_width = $old_height*$new_ratio; 
			} else { //������� 
				$old_height = $old_width/$new_ratio; 
			} 
		} else { //�����������ͼ �򰴱�������Ŀ��ͼ�� 
			//�߶����� 
			if($old_ratio>=$new_ratio) { 
				$new_height = $new_width/$old_ratio; 
				if($new_height < 5) $new_height = 5;
			} else { //������� 
				$new_width = $new_height*$old_ratio; 
				if($new_width < 5) $new_width = 5;
			} 
		} 
		//������ͼƬ 
		$new_img = imagecreatetruecolor($new_width,$new_height); 
		imagecopyresampled($new_img,$this->TempImg($from_img),0,0,0,0,$new_width,$new_height,$old_width,$old_height); 
		
		if($img_type=="jpg") imagejpeg($new_img, $to_img, 100); 
		if($img_type=="gif") imagegif($new_img,$to_img, 100); 
		if($img_type=="png") imagepng($new_img,$to_img, 100); 
		
		imagedestroy($new_img);
		
		//��������ͼ;�ļ���
		return $to_img;
	}
	function ResizeX($from_img, $to_img, $new_width, $new_height, $if_cut = 1) { 
		//ͼƬ���� 
		$img_type = strtolower(substr(strrchr($from_img,"."),1)); 		
		
		//ԭʼͼ��Ŀ�͸ߣ�������Ե�ͼ����ڹ��Ž�����С�� 
		$old_width = imagesx($this->TempImg($from_img)); 
		$this->_width = $old_width;
		if($new_width>$old_width){$new_width=$old_width;}
		$old_height = imagesy($this->TempImg($from_img)); 
		$this->_height = $old_height;
		if($new_height>$old_height){$new_height=$old_height;}
		
		//�ı�ǰ���ͼ��ı��� 
		$new_ratio = $new_width/$new_height; 
		$old_ratio = $old_width/$old_height; 
		
		//������ͼ��Ĳ��� 
		//���һ����ͼ �����õĴ�С����Ŀ��ͼ�� 
		if($if_cut=="1") { 
		//�߶����� 
			if($old_ratio>=$new_ratio) { 
				$old_width = $old_height*$new_ratio; 
			} else { //������� 
				$old_height = $old_width/$new_ratio; 
			} 
		} else { //�����������ͼ �򰴱�������Ŀ��ͼ�� 
			//�߶����� 
	
				$new_height = $new_width/$old_ratio; 
				if($new_height < 5) $new_height = 5;
		
		} 
		//������ͼƬ 
		$new_img = imagecreatetruecolor($new_width,$new_height); 
		imagecopyresampled($new_img,$this->TempImg($from_img),0,0,0,0,$new_width,$new_height,$old_width,$old_height); 
		
		if($img_type=="jpg") imagejpeg($new_img, $to_img, 100); 
		if($img_type=="gif") imagegif($new_img,$to_img, 100); 
		if($img_type=="png") imagepng($new_img,$to_img, 100); 
		
		imagedestroy($new_img);
		
		//��������ͼ;�ļ���
		return $to_img;
	}
	/*�߶����ȵ���غ���*/
	function ResizeY($from_img, $to_img, $new_width, $new_height, $if_cut = 1) { 
		//ͼƬ���� 
		$img_type = strtolower(substr(strrchr($from_img,"."),1)); 		
		
		//ԭʼͼ��Ŀ�͸ߣ�������Ե�ͼ����ڹ��Ž�����С�� 
		$old_width = imagesx($this->TempImg($from_img)); 
		$this->_width = $old_width;
		if($new_width>$old_width){$new_width=$old_width;}
		$old_height = imagesy($this->TempImg($from_img)); 
		$this->_height = $old_height;
		if($new_height>$old_height){$new_height=$old_height;}
		
		//�ı�ǰ���ͼ��ı��� 
		$new_ratio = $new_width/$new_height; 
		$old_ratio = $old_width/$old_height; 
		
		//������ͼ��Ĳ��� 
		//���һ����ͼ �����õĴ�С����Ŀ��ͼ�� 
		if($if_cut=="1") { 
		//�߶����� 
			if($old_ratio>=$new_ratio) { 
				$old_width = $old_height*$new_ratio; 
			} else { //������� 
				$old_height = $old_width/$new_ratio; 
			} 
		} 
	else
		{ //�����������ͼ �򰴱�������Ŀ��ͼ�� 
			 
		
				$new_width = $new_height*$old_ratio; 
				if($new_width < 5) $new_width = 5;
			
		} 
		//������ͼƬ 
		$new_img = imagecreatetruecolor($new_width,$new_height); 
		imagecopyresampled($new_img,$this->TempImg($from_img),0,0,0,0,$new_width,$new_height,$old_width,$old_height); 
		
		if($img_type=="jpg") imagejpeg($new_img, $to_img, 100); 
		if($img_type=="gif") imagegif($new_img,$to_img, 100); 
		if($img_type=="png") imagepng($new_img,$to_img, 100); 
		
		imagedestroy($new_img);
		
		//��������ͼ;�ļ���
		return $to_img;
	}
	
	
	/*
	�����������ʽ
	-
	$from_img    :ͼƬ·��
	$new_width   :��ͼ���
	$new_height  :��ͼ�߶�
	$if_cut      :�Ƿ��ͼ 1Ϊ��
	*/
	
	function MakeTempImage($from_img, $new_width, $new_height, $if_cut = 1) {
		header('Content-type: image/jpeg');
		$this->Resize($from_img, '', '60', '60', $if_cut = 1);
	}
	
	
	/*
	ͼƬ��ˮӡ
	����:
	$from_img    - ��ˮӡͼƬ·��
	$makrurl     - ˮӡͼƬ·��
	*/
	function Remark($from_img, $markurl = '') {
		//ͼƬ���� 
		$img_type = strtolower(substr(strrchr($markurl,"."),1)); 
		
		//��ʼ��ͼ��
		$temp_from_img = $this->TempImg($from_img);
		$temp_markurl_img = $this->TempImg($markurl);
		
		//����ó�ˮӡ��ͼƬ�ϵ�λ��
		$imgw = imagesx($temp_from_img) - (imagesx($temp_markurl_img)+10);
		$imgh = imagesy($temp_from_img) - (imagesy($temp_markurl_img)+5);
		if($imgw < 0) {$imgw = 0;} //��Ȳ���
		if($imgh < 0) {$imgh = 0;} //�߶Ȳ���
		
		//ˮӡ
		$Mark = $this->TempImg($markurl);
		//ͼƬ 
		$new_img = $this->TempImg($from_img);
		//
		imagecopy($new_img, $Mark, $imgw, $imgh, 0, 0, imagesx($temp_markurl_img), imagesy($temp_markurl_img));
		imagejpeg($new_img, $from_img, 100);
		imagedestroy($new_img);
	}
	
	
	
	/*
	��ʼ��ͼ��
	���� - 
	$from_img   - Ҫ��ʼ����ͼ��·��
	*/
	function TempImg($from_img) {
		//ͼƬ���� 
		$img_type = strtolower(substr(strrchr($from_img, "."),1)); 
		
		if($img_type=="jpg") $temp_img = @imagecreatefromjpeg($from_img); 
		if($img_type=="gif") $temp_img = @imagecreatefromgif($from_img); 
		if($img_type=="png") $temp_img = @imagecreatefrompng($from_img);
		//
		return $temp_img;
	}
	
	
	
	/*====================================
	�ļ��ϴ�
	$InputName    - �ϴ����ļ�����
	$UpPath       - �ϴ��ļ�·��
	$FileType     - �����ϴ����ļ����ͣ��ļ���չ���ԶȺŷֿ�
	$Size         - �����ϴ��Ĵ�С����λM
	$mark         - �ļ���ʶǰ׺
	*/
	function UpFile($InputName, $UpPath, $FileType, $Size = 2, $mark, $Back = '') {

		set_time_limit(0);
		/*
		$userupimgfile        = ����
		$upimgpath            = �ļ�·��
		$filetype             = �ļ��ϴ�����
		$size                 = �ļ���С��ֹ(K)
		$back                 = �������ͣ�1Ϊ������ҳ��0Ϊִֹͣ�С�
		*/
		
		$UID = $_SESSION['uid'];
		//1 Ϊ�ϸ����ϴ��ļ�����,2 �ж��ļ���׺��
		$UpFileType = 2; 
		//
		if($FileType == 'jpg,gif,png') {
			$UpFileType = 1; 
		}
		//�ļ���С
		$File_Size = $_FILES[$InputName]['size'];
		//�ļ�����
		$File_Type = $_FILES[$InputName]['type'];
		//�ļ���������
		$File_Name = $_FILES[$InputName]['name'];
		
		//����������������
		$FileType = explode(',',$FileType);
		//���ļ���С�����ֽ�
		$UpFileSize = ($Size*1024*1024);

		//�ļ��ж�����
		if($UpFileType == 1) {//�ϸ��ж�
			switch($File_Type) {
				// OFFICE
				case "application/msword": $Type='doc';break;
				case "application/vnd.ms-excel": $Type = 'xls';break;
				case "application/vnd.ms-powerpoint": $Type = 'ppt';break;
				//ѹ��
				case "application/octet-stream": $Type = 'rar';break;
				//�ı�
				case "text/plain": $Type = 'txt';break;
				//ͼƬ
				case "image/pjpeg": $Type = 'jpg';break;
				case "image/jpg": $Type = 'jpg';break;
				case "image/jpeg": $Type = 'jpg';break;
				case "image/gif": $Type = 'gif';break;
				case "image/x-png": $Type = 'png';break;
				case "image/png": $Type = 'png';break;
				case "image/bmp": $Type = 'bmp';break;
				//��������
				default: $Type = 'err';
			}
		} else {
			//������չ���ж�
			$Type = strtolower(substr(strrchr($File_Name,"."),1));
		}
		//���巵��
		if($Back == 1) {
			$Back = "window.location.href=('javascript:history.back()')";
		}
		//�ж��ϴ��ļ������Ƿ�Ϸ�
		if($File_Size > 0) { //�ļ���Ϊ��
			if(!in_array($Type, $FileType) || $Type == 'err') {
				echo "<script>alert('�ݲ�֧�ִ��ļ����͡�');top.document.getElementById('submit').disabled=false;top.imgList.location.href=('?".$_SERVER['QUERY_STRING']."');</script>";
				exit;
			}
		} else { // �ļ�Ϊ��
			$Type = 'err';
		}

		//�жϴ�С
		if($File_Size > $UpFileSize) {
			if($mark == 'p') {
				echo "<script>alert('�����ϴ����ļ����ܴ���".$Size."M��');window.location.href=('javascript:history.back()');parent.document.getElementById('submit').disabled=false</script>";
				exit;
			}
			BASE::js_msg('�����ϴ����ļ����ܴ���'.$Size.'M��');
		}
		
		//���ͺϷ��ϴ��ļ�
		if($Type != 'err'){
			$FileTime = $UID.date('YmdHis');
			@$UpFile = $UpPath.$mark.'_'.$FileTime.".".$Type;  //�ļ����ŵ�·��
			if(is_uploaded_file($_FILES[$InputName]['tmp_name'])){
				if(!move_uploaded_file($_FILES[$InputName]['tmp_name'], $UpFile)){
					return false;
					exit;
				}
			} else {
				return false;
				exit;
			}
			
			$UpFile = $mark.'_'.$FileTime.".".$Type;//��·��
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