<?php

class AddController extends ControllerBase {

   public function beforeExecuteRoute(){ // function ที่ทำงานก่อนเริ่มการทำงานของระบบทั้งระบบ
	  $this->checkAuthen();
   }


  public function indexAction(){
	   if($this->request->isPost()){

	   $photoUpdate='';
	   if($this->request->hasFiles() == true){
		   	$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
			$uploads = $this->request->getUploadedFiles();

				$isUploaded = false;
				foreach($uploads as $upload){
					if(in_array($upload->gettype(), $allowed)){
					 $photoName=md5(uniqid(rand(), true)).strtolower($upload->getname());
					 $path = '../public/img/'.$photoName;
					 ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
					}
				}

				if($isUploaded)  $photoUpdate=$photoName ;
		}else
				 die('You must choose at least one file to send. Please try again.');

      	$name = trim($this->request->getPost('name')); // รับค่าจาก form
		$date = trim($this->request->getPost('date')); // รับค่าจาก form
		$detail = trim($this->request->getPost('detail')); // รับค่าจาก form

	  	$eventObj = new Event();
	  	$eventObj->event_name = $name;
		$eventObj->date = $date;
		$eventObj->detail = $detail;
		  
      	$eventObj->picture = $photoUpdate;
		$eventObj->save();
		$this->response->redirect('event');
	}
  }

}
