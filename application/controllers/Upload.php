<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Upload_m');		
	}
	/*
	Function Name		: save_image
	Purpose				: save image in folder
	Created Date		: 10/Feb/2016
	*/
	public function save_image() {
        error_reporting(E_ALL | E_STRICT);
        require_once(APPPATH.'/third_party/image_uploader/UploadHandler.php');
        $upload_handler = new UploadHandler();
    }
    /*
	Function Name		: update_image_title
	Purpose				: update image title
	Created Date		: 10/Feb/2016
	*/
	public function update_image_title(){
		$title					= isset($_POST['title'])?$_POST['title']:'';
		$id						= isset($_POST['id'])?$_POST['id']:'';
        $data['title']          = $title;
		$this->Upload_m->save($data,$id);
		
	}
    /*
	Function Name		: updateImage
	Purpose				: insert new image detail 
	Created Date		: 10/Feb/2016
	*/
	public function update_image(){
		/* check if its valid ajax call */
		$this->secureAjaxCall();
		$imageName					= isset($_POST['image'])?$_POST['image']:'';
		$type						= isset($_POST['type'])?$_POST['type']:'';
        $imagePath                  = base_url("uploads/gallery/orignal/".$imageName);
        $imagePath1                 = CDN_STORAGE ."uploads/gallery/orignal/".$imageName;
        $expl 					    = explode('.',$imageName);
        $imgName				    = $expl[0];
        $count					    = count($expl)-1;
        $ext					    = strtolower($expl[$count]);
        $path 					    = 'uploads/gallery/'.$imageName;
	
        if($ext=='jpeg' || $ext=='jpg'|| $ext=='png'||$ext=='gif'){
            list($width, $height) = @getimagesize($imagePath1);
            $data['title']					= '';
            $data['file_name']				= $imgName;
            $data['file_extension']			= '.'.$ext;
            $data['type']					= $type;
            $data['image_width']			= $width;
            $data['image_height']			= $height;
            $data['thumb_path']				= $imageName;
            $data['status']					= 1;
            $data['mime_type']				= "image/".$ext;
            $data['created']				= date('Y-m-d H:i:s');
            $data['id']						= $this->Upload_m->save($data,NULL);
            $data['path']					= $imagePath;
			$rules 		  					= $this->config->item('type');
							
			if($type=="product"){
				$icon_width 		  	= $rules[$type]['icon_width'];
				$this->__resize_image($imageName,'icons',$icon_width,$width,$height);
			}
			
			if($type=="category"){
				$icon_width 		  	= $rules[$type]['icon_width'];
				$this->__resize_image($imageName,'icons',$icon_width,$width,$height);
			}
			
			if($type=="gallery"){
				$icon_width 		  	= $rules[$type]['icon_width'];
				$this->__resize_image($imageName,'icons',$icon_width,$width,$height);
			}
			
			if($type=="solution"){
				$icon_width 		  	= $rules[$type]['icon_width'];
				$this->__resize_image($imageName,'icons',$icon_width,$width,$height);
			}
			
			$extra_large_width 		  	= $rules[$type]['extra-large_width'];
			$small_width 		  		= $rules[$type]['small_width'];
			$medium_width 		  		= $rules[$type]['medium_width'];
			$large_width 		  		= $rules[$type]['large_width'];		
			
            $this->__resize_image($imageName,'small',$small_width,$width,$height);
            $this->__resize_image($imageName,'medium',$medium_width,$width,$height);
            $this->__resize_image($imageName,'large',$medium_width,$width,$height);
            $this->__resize_image($imageName,'extra-large',$extra_large_width,$width,$height);
			
            echo json_encode($data);
            exit;
        }else if($ext=='pdf' || $ext=='docx' ){
			
			$data['title']					= '';
            $data['file_name']				= $imgName;
            $data['file_extension']			= '.'.$ext;
            $data['type']					= $type;
            $data['image_width']			= 0;
            $data['image_height']			= 0;
            $data['thumb_path']				= 0;
            $data['status']					= 1;
            $data['mime_type']				= $ext;
            $data['created']				= date('Y-m-d H:i:s');
            $data['id']						= $this->Upload_m->save($data,NULL);
            $data['path']					= $imagePath;
            echo json_encode($data);
            exit;
		}
        else{
			
				if (file_exists(dirname(FCPATH)."/uploads/gallery/orignal/".$imageName)) {
					unlink(dirname(FCPATH)."/uploads/gallery/extra-large/".$imageName);
					unlink(dirname(FCPATH)."/uploads/gallery/medium/".$imageName);
					unlink(dirname(FCPATH)."/uploads/gallery/large/".$imageName);
					unlink(dirname(FCPATH)."/uploads/gallery/small/".$imageName);
					echo '1';
				}	else{
					echo '1';
				}
				
				exit;
		}
	}

	 /*
		Function Name		: resize-image
		Purpose				: insert new image detail 
		Created Date		: 10/Feb/2016
	*/
		private function __resize_image($image_name = '',$path='',$width='',$Orwidth,$Orheight) {
			
			$source_full_path = CDN_STORAGE . "uploads/gallery/orignal/". $image_name;
			$thumb_file_name = $image_name;
			$thumb_path = CDN_STORAGE . "uploads/gallery/".$path."/";

			if( $Orwidth > $width && $Orheight > $width){
				 $this->build_image(array(
							'source_path' => $source_full_path,
							'target_path' => $thumb_path,
							'desired_image_width' => $width,
							'desired_image_height' => $width
						));
			}else if($Orwidth < $width && $Orheight > $width){
				$this->build_image(array(
							'source_path' => $source_full_path,
							'target_path' => $thumb_path,
							'desired_image_width' => $Orwidth,
							'desired_image_height' => $width
						));
			}else if($Orwidth < $width && $Orheight < $width){
				$this->build_image(array(
						'source_path' => $source_full_path,
						'target_path' => $thumb_path,
						'desired_image_width' => $Orwidth,
						'desired_image_height' => $Orheight
					));
			}
			

		}
		
	private function build_image($config){
	  
		foreach($config as $key => $value) {
            $$key = $value;
        }
		$image_name = basename($source_path);
        list($source_width, $source_height, $source_type) = getimagesize($source_path);
		if(!isset($source_width) || empty($source_width)) {
			return false;
		}
        switch ($source_type) {
            case IMAGETYPE_GIF:
                $source_gdim = imagecreatefromgif($source_path);
                break;
            case IMAGETYPE_JPEG:
                $source_gdim = imagecreatefromjpeg($source_path);
                break;
            case IMAGETYPE_PNG:
                $source_gdim = imagecreatefrompng($source_path);
                break;
        }
        $source_aspect_ratio = $source_width / $source_height;
        $desired_aspect_ratio = $desired_image_width / $desired_image_height;
        if ($source_aspect_ratio > $desired_aspect_ratio) {
            $temp_height = $desired_image_height;
            $temp_width = ( int ) ($desired_image_height * $source_aspect_ratio);
        } else {
            $temp_width = $desired_image_width;
            $temp_height = ( int ) ($desired_image_width / $source_aspect_ratio);
        }
        $temp_gdim = imagecreatetruecolor($temp_width, $temp_height);
        imagecopyresampled(
            $temp_gdim,
            $source_gdim,
            0, 0,
            0, 0,
            $temp_width, $temp_height,
            $source_width, $source_height
        );
        $x0 = ($temp_width - $desired_image_width) / 2;
        $y0 = ($temp_height - $desired_image_height) / 2;
        $desired_gdim = imagecreatetruecolor($desired_image_width, $desired_image_height);
        imagecopy(
            $desired_gdim,
            $temp_gdim,
            0, 0,
            $x0, $y0,
            $desired_image_width, $desired_image_height
        );
	
        imagejpeg($desired_gdim, $target_path.'/'.$image_name);
		return true;
	}
		public function delete_file(){
			
			if (!$this->input->is_ajax_request()) {
				exit('No direct script access allowed');
			} 
			
			$json_response = [
								"status" 	=> 0,
								"section" 	=> '',
								"message" 	=> '',
								"url" 		=> '',
							];
							
			$this->load->helper('file');
			$file_id 		= $this->input->post('id');
			$file 	 		= []; 
			$extra_large	= '';
			$icons 			= '';
			$medium 		= '';
			$large 			= '';
			$small 			= '';
			$orignal 		= '';
			
			if(is_numeric($file_id) && !empty($file_id)){
				
				$file 				= $this->Upload_m->get_by([ 'id' => $file_id ],TRUE);
			
				$orignal      		=  dirname(FCPATH).'/uploads/gallery/orignal/'.$file['thumb_path'];
			
				$extra_large      	=   dirname(FCPATH).'/uploads/gallery/extra-large/'.$file['thumb_path'];
			
				$medium      		=   dirname(FCPATH).'/uploads/gallery/medium/'.$file['thumb_path'];
			
				$large      		=   dirname(FCPATH).'/uploads/gallery/large/'.$file['thumb_path'];
			
				$small      		=   dirname(FCPATH).'/uploads/gallery/small/'.$file['thumb_path'];
			
				$icons      		=  file_exists( dirname(FCPATH).'/uploads/gallery/icons/'.$file['thumb_path'])?dirname(FCPATH).'/uploads/gallery/icons/'.$file['thumb_path']:'';
				
				$exist_image = [
								'lr_admin' 		=> '<i class="fa fa-users" aria-hidden="true"></i> User Management',
								'lr_gallery' 	=> '<i class="fa fa-file-image-o"></i> Gallery Management',
								'lr_gallery_options' 	=> '<i class="fa fa-file-image-o"></i> Gallery Management',
							   ];
				$extension = ['image'=>[
											'.jpeg',
											'.jpg',
											'.png',
											'.gif',
										 ],
								'pdf' => ['.pdf'],		 
								'docx' => ['.docx'],
							 ];			   
							   
				$response 	= [];			   
				$result 	= [];			   
				$result_data 	= [];			   
				$response = $this->Upload_m->imageSearch($file_id);
				
				if(is_array($response) && !empty($response)){
					foreach($exist_image as $t => $image){
						$result[$t] = $this->Upload_m->get_where_all($t,'image_id',['image_id' =>$file_id]);		 	
						
					}
					if(is_array($result) && !empty($result)){
						foreach($result as $key => $resultData){
							if(is_array($resultData) && !empty($resultData)){
								foreach($resultData as $val){
									if($val['image_id'] == $file_id){
										$result_data[$key] = CDN_DOMAIN.'uploads/gallery/small/'.$response['thumb_path'];
										$result_data['extension'] = $response['file_extension'];
									}	
								}	
							}							
													
						}
					}
				
				   if(is_array($result_data) && !empty($result_data)){
						  $json_response['status'] = 1;
				
						   foreach($result_data as $index => $data){
							   if(array_key_exists($index,$exist_image)){
								   $json_response['section'][] = $exist_image[$index];
								   $json_response['message']   = 'Can not delete file';
								   if(in_array($result_data['extension'],$extension['image'])){
									   $json_response['url']   = '<img src="'.$data.'" class="img-thumbnail"/>';
								   }else{
									  if(in_array($result_data['extension'],$extension['pdf'])){
										  $json_response['url']  = '<img src="'.CDN_DOMAIN.'uploads/pdf_icon.png" />';
									  } else{
										 $json_response['url']  = '<img src="'.CDN_DOMAIN.'uploads/docx_icon.png" />';
									  }
								   }							   								   
							   }
						   }
				
				   }else{
					   if($this->Upload_m->delete($file_id)){
							
								if(file_exists($extra_large)){
									unlink($extra_large);
								}
								
								if($icons != ''){
								unlink($icons);	
								}	
								if(file_exists($large)){								
									unlink($large);
								}
								if(file_exists($medium)){	
									unlink($medium);
								}
								if(file_exists($orignal)){
									unlink($orignal);
								}
								if(file_exists($small)){
									unlink($small);
								}
							
							 $json_response['status'] = 2;
							 $json_response['message'] = 'Successfully delete file';		
						}else{
							$json_response['status'] = 0;
							$json_response['message'] = 'Failed delete file';
						}
					}
				   
				   }
				  
				}
				
				echo json_encode($json_response);
				exit;	
		}
}