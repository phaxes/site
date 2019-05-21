<?php

abstract class SITE_CONTROLLER{

  /**
  * @var SITE
  */
  public $view;
  
  public function __construct(){
    $this->view = new SITE();
  }
}


/**
* Class MyController
*/
class SITE extends SITE_CONTROLLER{

  /**
  * @param UserRepository $repository
  * @throws Exception
  */
  public function testAction(UserRepository $repository) {
    $userList = $repository->getUsers();
    $this->view->assignVar('userList', $userList);
    $this->view->render('test.html');
  }
} 
?>