<?php
$authuid=isset($_SESSION['authuid']) ? $_SESSION['authuid'] : 0;
$pagetitle=isset($pagename) ? $GLOBALS['sitename'].' - '.$pagename : $GLOBALS['sitename'];
$foot[]=getjAlert();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=$pagetitle?></title>
<style type="text/css">
  @import "<?=myUrl('css/reset.css')?>";
  @import "<?=myUrl('css/text.css')?>";
  @import "<?=myUrl('css/2col.css')?>";
</style>
<?=(isset($head) && is_array($head)) ? implode("\n",$head) : ''?>
</head>
<body>
<div id="wrap">
  <div id="header"><h1><a href="http://kissmvc.com">KISSMVC.com</a> - Simple PHP MVC Framework </h1></div>
  <div id="nav">
    <ul>
      <li><a href="<?=myUrl('main')?>">Main</a></li>
      <li><a href="<?=myUrl('users/manage')?>">Manage Users</a></li>
      <li><a href="<?=myUrl('main/resetdb')?>">Reset User DB</a></li>
<?php
  if ($authuid)
    echo '<li><a href="'.myUrl('ops/logout').'">Logout</a></li>'."\n";
  else
    echo '<li><a href="'.myUrl('main/login').'">Login</a></li>'."\n";  
?>
    </ul>
  </div>
  <div id="main">
<?=(isset($body) && is_array($body)) ? implode("\n",$body) : ''?>
  </div>
  <div id="sidebar">
    <h3>Unordered List</h3>
    <ul>
      <li><a href="#">Item 1</a></li>
      <li><a href="#">Item 2</a></li>
      <li><a href="#">Item 3</a></li>
      <li><a href="#">Item 4</a></li>
      <li><a href="#">Item 5</a></li>
      <li><a href="#">Item 6</a></li>
      <li><a href="#">Item 7</a></li>
      <li><a href="#">Item 8</a></li>
    </ul>
<?php
if (isset($leftnav) && is_array($leftnav))
  foreach ($leftnav as $blockhtml)
    echo "$blockhtml\n";
?>
  </div>
  <div id="footer">
    <p>Footer</p>
  </div>
</div>
<?=(isset($foot) && is_array($foot)) ? implode("\n",$foot) : ''?>
</body>
</html>