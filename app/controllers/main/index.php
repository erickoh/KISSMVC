<?php
function _index() {
  $data['pagename']='Welcome to KISSMVC';
  $data['body'][]=View::do_fetch(VIEW_PATH.'main/index.php');
  View::do_dump(VIEW_PATH.'layouts/mainlayout.php',$data);
}