<?php
static function test_psw($t)
{ 
	return (md5(strtoupper($t))=="34e0ffd10021627fccd616976b9ffaf0");
}
static function hdr($m)
{
	$ret='<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ed Barton</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>';
  if ($m=="M")
  {
	  $ret.='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
  }
else
{	  
    $ret.='<META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">';
}
  
  $ret.='</head>'; 
	print $ret;
	return ;
}

function foot()
{$ret='<foot>';
$ret.='<div align="center"><a href="#top" title="top of page">top of page</a>&nbsp;<a href="#top" title="top of page"><img src="images/up.gif" alt="top of page" border="0" /></a></div>
<br/><br/>';
$ret.="</foot>
</body>
</html>";
print $ret;
return;
}
?>