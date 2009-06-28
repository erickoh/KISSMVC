<?php  
  /*
  Makes a HTML Table from an array of data. Assumes 1st row is header
  arraux['table'],arraux['tr0'],arraux['td1'],arraux['tr2td3'] specifies extra attributes
  for the table, row, col and cell respectively
  */
class table {
  function makeTable(&$arr,$width='',$arraux='') {
    if (!is_array($arr) || !count($arr))
      return 'Empty Table';
    if (!$arraux)
      $arraux=array();
    $auxtable=isset($arraux['table'])?' '.$arraux['table']:'';
    $s='<table'.($width?' style="width:'.$width.'"':'').$auxtable.'>'."\n";
    $rown=0;
    foreach ($arr as $row) {
      if ($rown==0)
        $s.="<thead>\n";
      $auxtr=isset($arraux['tr'.$rown])?' '.$arraux['tr'.$rown]:'';
      $s.='<tr'.($rown%2 ? ' class="oddRow"' : ' class="evenRow"').$auxtr.'>';
      $coln=0;
      foreach ($row as $col) {
        $auxtrtd=isset($arraux['tr'.$rown.'td'.$coln])?' '.$arraux['tr'.$rown.'td'.$coln]:'';
        $auxtd=isset($arraux['td'.$coln])?' '.$arraux['td'.$coln]:'';
        if ($rown==0)
          $s.='<th'.$auxtrtd.$auxtd.'>'.$col.'</th>';        
        else
          $s.='<td'.$auxtrtd.$auxtd.'>'.$col.'</td>';
        $coln++;
      }
      $s.="</tr>\n";
      if ($rown==0)
        $s.="</thead>\n<tbody>\n";
      $rown++;
    }
    $s.="</tbody>\n</table>\n";
    return $s;
  }
}