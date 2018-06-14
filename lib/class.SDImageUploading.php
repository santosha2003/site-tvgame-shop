<?
class SDImageUploading {
	var $disk_path;
	var $new_uimage_name;
	var $uimage_extension;
	var $uimage;
	var $error;
	var $uploaded_file;
	
	function addcheckImgType(){
		if((strcmp($this->uimage['type'],'image/jpeg')==0)||(strcmp($this->uimage['type'],'image/gif')==0)|| (strcmp($this->uimage['type'],'image/pjpeg')==0)||(strcmp($this->uimage['type'],'image/jpg')==0)||(strcmp($this->uimage['type'],'image/x-png')==0)||(strcmp($this->uimage['type'],'image/png')==0)){ 
			switch($this->uimage['type']){ 
	 	 		case 'image/jpg': 
	 	 			$this->uimage_extension = '.jpg';
	 	 		break;
	 	 		case 'image/jpeg':
	 	 			$this->uimage_extension = '.jpg';
	 	 		break;
	 	 		case 'image/pjpeg':
	 	 			$this->uimage_extension = '.jpg';
	 	 		break;
	 	 		case 'image/gif':
	 	 			$this->uimage_extension = '.gif';
	 	 		break;
	 	 		case 'image/x-png':
	 	 			$this->uimage_extension = '.png';
	 	 		break;
	 	 		case 'image/png':
	 	 			$this->uimage_extension = '.png';
	 	 		break;
	 	 	}
	 	 	return true;
	 	}else{
	 		$this->error .= 'Загружаемый файл не является изображением. ';
	 		return false;
	 	} 
	}

	function doUpload($new_disk_path,$new_uimage,$new_uimage_name=''){
		$this->disk_path = $new_disk_path;
		$this->uimage = $new_uimage;
		$this->uploaded_file = '';
		if($new_uimage_name != ''){
			$this->new_uimage_name = $new_uimage_name;
		}else{
			$this->new_uimage_name = $this->uimage_name;
		}

		$this->addcheckImgType();

		if($this->uimage_extension){
			$uimageFinal = $this->disk_path.$this->new_uimage_name.$this->uimage_extension;
			if(@move_uploaded_file($this->uimage['tmp_name'], $uimageFinal)){
				$this->uploaded_file = $this->new_uimage_name.$this->uimage_extension;
				return $this->uimage_extension;
			}else{
				$this->error .= 'Не удалось скопировать файл '.$uimageFinal.'. Проверьте правильность пути для копирования '.$this->disk_path;
				return false;
			}
		}else{
			$this->error .= 'Проверьте расширение файла '.$this->uimage_extension;
			return false;
		}
	}
}
?>