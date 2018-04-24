<?php

class DeleteController extends ControllerBase {

   public function beforeExecuteRoute(){ // function ที่ทำงานก่อนเริ่มการทำงานของระบบทั้งระบบ
	  $this->checkAuthen();

	  	$eventObj = Event::findFirst($_GET['id']);
	  	$eventObj->delete();
		$this->response->redirect('event');
   }

   public function indexAction(){
	
   }


}
