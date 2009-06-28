<?php
class pagination {
  function makePagination($n,$total_rows,$base_url,&$config=null) {
    //defaults
    $c['per_page']         = 10;
    $c['num_links']        = 2;
    $c['first_link']       = '&lsaquo; First';
    $c['next_link']        = '&gt;';
    $c['prev_link']        = '&lt;';
    $c['last_link']        = 'Last &rsaquo;';
    $c['full_tag_open']    = '';
    $c['full_tag_close']   = '';
    $c['first_tag_open']   = '';
    $c['first_tag_close']  = '&nbsp;';
    $c['last_tag_open']    = '&nbsp;';
    $c['last_tag_close']   = '';
    $c['cur_tag_open']     = '&nbsp;<b>';
    $c['cur_tag_close']    = '</b>';
    $c['next_tag_open']    = '&nbsp;';
    $c['next_tag_close']   = '&nbsp;';
    $c['prev_tag_open']    = '&nbsp;';
    $c['prev_tag_close']   = '';
    $c['num_tag_open']    = '&nbsp;';
    $c['num_tag_close']    = '';
  
    //initialize
    if (is_array($config))
      foreach ($config as $k => $v)
        if (isset($c[$k]))
          $c[$k] = $v;
    $per_page=$c['per_page'];
    $num_links=$c['num_links'];
  
    if (!$total_rows or !$per_page or $n > $total_rows)
      return '';
  
    $num_pages = ceil($total_rows / $per_page);
    if ($num_pages == 1)
      return '';
  
    $num_links = max(1,(int)$num_links);
    $n = max(0,(int)$n);
  
    // Is the page number beyond the result range?
    // If so we show the last page
    if ($n > $total_rows)
      $n = ($num_pages - 1) * $per_page;
  
    $uri_page_number = $n;
    $cur_page = floor(($n / $per_page) + 1);
  
    // Calculate the start and end numbers. These determine
    // which number to start and end the digit links with
    $start = (($cur_page - $num_links) > 0) ? $cur_page - ($num_links - 1) : 1;
    $end   = (($cur_page + $num_links) < $num_pages) ? $cur_page + $num_links : $num_pages;
  
    // Sanitize the trailing slash
    $base_url = rtrim($base_url, ' /') .'/';
  
    $output = '';
  
    // Render the "First" link
    if  ($cur_page > $num_links)
      $output .= $c['first_tag_open'].'<a href="'.$base_url.'0">'.$c['first_link'].'</a>'.$c['first_tag_close'];
  
    // Render the "previous" link
    if  ($cur_page != 1) {
      $i = $uri_page_number - $per_page;
      $output .= $c['prev_tag_open'].'<a href="'.$base_url.$i.'">'.$c['prev_link'].'</a>'.$c['prev_tag_close'];
    }
  
    // Write the digit links
    for ($loop = $start -1; $loop <= $end; $loop++) {
      $i = ($loop * $per_page) - $per_page;
      if ($i >= 0) {
        if ($cur_page == $loop)
          $output .= $c['cur_tag_open'].$loop.$c['cur_tag_close']; // Current page
        else
          $output .= $c['num_tag_open'].'<a href="'.$base_url.$i.'">'.$loop.'</a>'.$c['num_tag_close'];
      }
    }
  
    // Render the "next" link
    if ($cur_page < $num_pages)
      $output .= $c['next_tag_open'].'<a href="'.$base_url.($cur_page * $per_page).'">'.$c['next_link'].'</a>'.$c['next_tag_close'];
  
    // Render the "Last" link
    if (($cur_page + $num_links) < $num_pages) {
      $i = (($num_pages * $per_page) - $per_page);
      $output .= $c['last_tag_open'].'<a href="'.$base_url.$i.'">'.$c['last_link'].'</a>'.$c['last_tag_close'];
    }
  
    $output = $c['full_tag_open'].$output.$c['full_tag_close'];
  
    return $output;
  }
}