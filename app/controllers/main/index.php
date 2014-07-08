<?php
function _index($msg='Hello World!') {
  $view = new View(APP_PATH.'views/layout.php');
  $view->set('msg',$msg);
  $view->dump();
}