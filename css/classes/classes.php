<?php
class Page
{	
	static function rhsWidth()
	{
		return 800;
	}
	static function base_url()
	{
		return "http%3A%2F%2Fwww.chorltonlittlegems.co.uk/ed";
	}
	static function ttl1()
	{
		return "Walking in the House";
	}
	static function ttl2()
	{
		return "Edward Barton";
	}

	static function fb_article_share($link,$fbtitle,$fbdescr,$pic)
	{
		$qt="'";
		$link="https://www.facebook.com/v2.4/dialog/feed";
		$link.="?app_id=828060457301904";
		$link.="&caption=".$fbtitle;
		$link.="&description=Ed%20Bartons%20Walking%20in%20the%20House%20Blog";
		$link.="&display=popup";
		$link.="&e2e=%7B%7D";
		$link.="&link=http%3A%2F%2Fwww.chorltonlittlegems.co.uk%2Fed";
		$link.="&locale=en_GB";
		$link.="&name=".$fbdescr;
		$link.="&next=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter%2FBhKMRj1sUPu.js%3Fversion%3D41%23cb%3Dfa5e76074%26domain%3Dwww.chorltonlittlegems.co.uk%26origin%3Dhttp%253A%252F%252Fwww.chorltonlittlegems.co.uk%252Ff1db5b94%26relation%3Dopener%26frame%3Df2c62aa41%26result%3D%2522xxRESULTTOKENxx%2522";
		$link.="&picture=".$pic;	
		$link.="&sdk=joey";
		$link.="&version=v2.4";
	//http://stackoverflow.com/questions/7357001/share-button-post-to-wall-facebook-api
		$setup='toolbar=0,location=0,statusbar=1,menubar=0,scrollbars=yes,width=600,height=400';
		$winttl="edswindow";
		$ret.= '<a href="#" 
	         onclick="javascript:window.open('.$qt.$link.$qt.','.$qt.$winttl.$qt.','.$qt.$setup.$qt.');";  
			 title="Share To Facebook">
	                <img src="img/posttofb.png" alt="Share To Facebook">
	       </a>';
	return $ret;
	}
	static function twt($t)
	{	
	return '<a href="https://twitter.com/intent/tweet?button_hashtag=EdwardBarton&text='.$t.'" 
		class="twitter-hashtag-button" 
		data-related="guylancaster" 
		data-url="http://www.chorltonlittlegems.co.uk/ed/index.php">Tweet #EdwardBarton</a>
		<script>
		!function(d,s,id)
		{
			var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";
			if(!d.getElementById(id))
			{
				js=d.createElement(s);
				js.id=id;
				js.src=p+"://platform.twitter.com/widgets.js";
				fjs.parentNode.insertBefore(js,fjs);
			}
		}
		(document, "script","twitter-wjs");
		</script>';
		}
	static function pin($g,$drctry,$descr="Next%20stop%3A%20Pinterest")
	{ 
		$ret='<a title="Pin It" ';
		$ret.='href="//www.pinterest.com/pin/create/button/';
		$ret.='?url='.Page::base_url();
		$ret.='&media='.Page::base_url().'%2F'.$drctry.'%2F'.$g;
		$ret.='&description='.$descr.'" ';
		$ret.=' data-pin-do="buttonPin" data-pin-config="beside" data-pin-color="red">';
		$ret.='<img src="img/pinit.jpg" alt="Pin it" height="24"/>';
		$ret.='</a>';
		return $ret;
	}
	static function logged_in()
	{
		session_start();
		$pass 	= $_SESSION["pass"];
		$rslt	= Page::test_psw($pass);
		if ($rslt!= 1)
		{	
			header("Location: mngr_login.php?err=Incorrect-Password ");
			exit;
		}
	}
	static function test_psw($t)
	{ 	
		$md	=md5(strtoupper($t));
		$ret= ($md=="34e0ffd10021627fccd616976b9ffaf0");
		return $ret;
	}
	static function clean_text($s)
	{
		$ret=str_replace ("'","~1",$s);
		$ret=str_replace ('"',"~2",$ret);
		$ret= str_replace(chr(13).chr(10),"~3",$ret);
		return $ret;
	}
	static function unclean_text($s)
	{
		$ret=str_replace ("~2","&quot;",$s);
		$ret=str_replace ("~1","&lsquo;",$ret);
		$ret= str_replace("~3",chr(13).chr(10),$ret);
		return $ret;
	}
	
	static function unclean_text1($s)
	{
		$ret=str_replace ("~2","&quot;",$s);
		$ret=str_replace ("~1","&lsquo;",$ret);
		$ret= str_replace("~3","",$ret);
		return $ret;
	}
	static function display_text($s)
	{
		$ret=str_replace ("~2","&quot;",$s);
		$ret=str_replace ("~1","&lsquo;",$ret);
		$ret= str_replace("~3","<br/>",$ret);
		return $ret;
	}
	static function bar($c)
	{
		$ret= '&nbsp;';
		$ret.='<span style="height:30px;background-color:#'.$c.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
		$ret.= '&nbsp;&nbsp;&nbsp;&nbsp;';
		print $ret;
		return;
	}
	static function fmt_page($t,$artid,$hdg,$screentype)
	{
		$txtspan=Page::get_span('txt');
		$ret	=$txtspan;
		$stat	=0;
		$param1	=$param2=$param3="";
		$imgToPost="img/mastheadedward_240.jpg";
		$fbdescr="";
		
		for ($i=0;$i<=strlen($t);$i++)
		{
			$c=substr($t,$i,1);
			switch ($c)
			{
				case"[":
				$stat	=1;
				$mode	="";
				$ttl	="";
				break;
		
				case "|":
				$stat++;
				break;
				
				case "]";
			$param1=strtolower(trim($param1));
	
			switch ($param1)
			{
			case 'image':
                $qryImg		="select descr,filenm from edartimg  ";
				$qryImg		.="where artid=".$artid ." and code=".$param2.";";
			    $resultImg	= mysql_query($qryImg) or die('Query '.$qryImg.' failed: ' . mysql_error());
				$rowImg 	= mysql_fetch_array($resultImg, MYSQL_ASSOC);
				$imgDescr	= $rowImg['descr'];
				$imgFilenm	= $rowImg['filenm'];
				$ret		.='<br/>';
				$ret		.='<a href="#" title="'.$imgDescr.'">';
				$ret		.='<img src="uploads/'.$imgFilenm.'" alt="'.$imgDescr.'" class="img-responsive">';
				$ret		.='</a>';
				$ret		.="<br/>";
				$ret		.= Page::fmt_element($imgDescr,"image")."&nbsp;&nbsp;";
				$ret		.="&nbsp;";
				$ret		.= Page::pin($imgFilenm,"uploads",$imgDescr);
				$imgToPost   ='uploads/'.$imgFilenm;
        	
			case 'link':
				$ret.='</span>';
				$ret.=Page::get_span('link');
				$ret.='<a href='.$param2.'>'.$param3.'</a>';
				$ret.='</span>';
				$ret.=$txtspan;
				break;
        	case 'center':
				$ret.="<div style='text-align:center;'>";
				break;
			
			case '/center':
				$ret.="</div>"	;
				break;
		
			case 'sound':
					$ret.='</span>';
					$ret.=Page::get_span('sound');
					$ret.='<a href='.$param2.'>'.$param3.'</a>';
					$ret.='</span>';
					$ret.=$txtspan;
					break;
			case 'video':
			 	  $ret.='<div class="hs-responsive-embed-youtube">
				  <iframe src="'.$param2.'"    ></iframe>
				  </div>';
					break;
			case 'poem':
					$ret.='</span>';
					$ret.=Page::get_span('poem');
					$ret.=$param2;
					$ret.='</span>';
					$ret.=$txtspan;
					break;
			default:
				$ret.='</span>';
				$ret.=Page::get_span($param1).$param2.'</span>';
				$ret.=$txtspan;
				}
				$stat=0;
				$param1=$param2=$param3="";
				break;
				default:
				switch($stat)
				{
					case 0:
					$ret.=$c;
					if (strlen($fbdescr)<999)
					{
						$fbdescr.=$c;
					}
					break;
					case 1:
					$param1.=$c;
					break;
					case 2:$param2.=$c;
					break;
					case 3:
					$param3.=$c;
					default:
				}
			}
		}
		$ret.="</span>";
		$ret = Page::display_text($ret);
        $ret.= "<br/><br/>";
				
		//comments
		$link	="index_comments.php";
		$link	.="?artid=".$artid;
		$link	.="&screentype=".$screentype;
		$link	.="&hdg=".$hdg;	
		$qts	='"';
		$ret.="<a onclick='javascript:window.open( ".$qts.$link.$qts.", 
        			".$qts.$qts.",
				   ".$qts."toolbar=0,location=0,statusbar=1,menubar=0,scrollbars=yes,width=800,height=600".$qts."); 
				   return false;'>".Page::fmt_element("Comments","comment")."</a>";
		$qryCom 		="select count(*) as ctr ";
		$qryCom 		.=" from edartcomment ";
		$qryCom 		.=" where artid=".$artid." and delflag='N' ";
		$rsltCom 		= mysql_query($qryCom) or die('Query '.$qryCom.' failed: ' . mysql_error());
		$rowCom  = mysql_fetch_array($rsltCom , MYSQL_ASSOC);
		$ctr	=$rowCom['ctr'];
		$ret.=Page::fmt_element(" (".$ctr.")","comment");
		$ret.="&nbsp;&nbsp;&nbsp;";
		
		//twitter feed
		$ret.=Page::twt($hdg);
		$ret.="&nbsp;&nbsp;&nbsp;";
		
		//facebook feed
		$ret.=Page::fb_article_share("http://www.chorltonlittlegems.co.uk/ed",Page::unclean_text1($fbdescr),$hdg,
		"http://www.chorltonlittlegems.co.uk/ed/".$imgToPost);
		$ret.="<br/><br/>";
		return $ret;
	} 
	static function fmt_link($ttl,$lnk,$fmttyp)
	{
		$ret=Page::get_span($fmttype);
		$ret.="<a href='".$lnk."'>".$ttl."</a>" ; 
		$ret.="</span>";
		return $ret;
	}
	static function fmt($s,$col,$font,$fontsize,$fontweight,$italic="N")
	{
		$style='font-family:'.$font.',sans-serif;';
		$style.=" font-weight:".$fontweight.";";
		$style.=" color:#".$col.";";
		$style.=" font-size:".$fontsize."pt;"; 
		$style.=" font-style:".($italic=="Y"? "italic": "normal").";";
		$ret.= "<span style='".$style."'>";
		$ret.=$s;
		$ret.="</span>";

		return $ret;
    }
	static function get_span($element)
	{
		$qry		="select font,fontsize,fontweight,color,italic ";
		$qry		.=" from edelement ";
		$qry		.=" where code='".$element."';";
		$result 	= mysql_query($qry) or die('Query failed: ' . mysql_error());
		$row 		= mysql_fetch_array($result, MYSQL_ASSOC);
		$fontsize	= $row['fontsize'].'pt';
		$font		=  $row["font"].',sans-serif';
		$fontweight	= $row["fontweight"];
		$italic 	= $row["italic"];
		$color		= "#".$row["color"];
		$ret		.= "<span "; 
		$ret		.=" style='font-size:".$fontsize.";";
		$ret        .= "font-style:".($italic=="Y"?"italic":"normal").";";
		$ret		.=' font-family:'.$font.';';
		$ret		.=" font-weight:".$fontweight.";";
		$ret		.=" color:".$color."'>";
		return $ret;
	}
	
	static function fmt_element($s,$element)
	{
		$ret=Page::get_span($element);
		$ret.=$s;
		$ret.="</span>";
		return $ret;
    }
	static function fix_link($s)
	{
		return  str_replace (" ","%20",$s);
	}
	static function count_digits($d)
	{	
	$ctr=0;
	for ($i=0;$i<strlen($d); $i++)
	{
		$c=substr($d,$i,1);
		if ($c>="0" && $c<="9")
		{
			$ctr++;
		}
	}
	return $ctr;
	}
	static function validate_fontsize($s,$d="")
	{
		$ret="";
		if (Page::count_digits($s)!=2)
		{
			$ret.=$d." Font Size must be 00-99. ";
		}
		return $ret;
	}
	static function validate_required($s,$dscr)
	{
		$ret="";
		if (strlen($s)==0)
		{
			$ret=$dscr." required. ";
		}
		return $ret;
	}
	static function validate_fontweight($w,$d="")
	{
		$ret="";
		if (Page::count_digits($w)!=3)
		{
			$ret=$d." Font Weight must be 000-909. ";
		}
		return $ret; 
	}
	static function default_blank($s,$d)
	{
		$s=trim($s);
		
		if (strlen($s)==0)
		{
			$s=$d;
		}
		return $s;
	}	
	static function validate_colour($c,$d="")
	{$ret="";
	if(Page::count_hex($c)!=6)
		{
			$ret=$d." Colour ".$c." must be in correct format - 000000 to FFFFFF. ";
		}
		return $ret;
	}
	static function count_hex($d)
	{	 
		$ctr =0;
		for ($i=0;$i<strlen($d); $i++)
		{
			$c=substr($d,$i,1);

			if (($c>="0" && $c<="9")|| ($c>="A" && $c<="F"))
			{
				$ctr++;
			}
		}
		return $ctr;
	}
	static function testDt($d)
	{
		$ok = (Page::count_digits($d)==8);
		if ($ok)
		{
			$dd		=substr($d,0,2);
			$mm		=substr($d,2,2);
			$yyyy	=substr($d,4,4);
			$ok		=($dd>="01" && $dd<="31")&&($mm>="01"&& $mm<="12")&& ($yyyy>"1950" && $yyyy<="2100");
		}
		return $ok;
	}
	static function date_to_f($d)
	{	
		return substr($d,4,4).substr($d,2,2).substr($d,0,2);
	}
	
	static function date_to_s($d)
	{
		return substr($d,6,2).substr($d,4,2).substr($d,0,4);
	}
	static function date_to_s2($d)
	{
		return substr($d,6,2).'/'.substr($d,4,2).'/'.substr($d,0,4);
	}
	static function date_to_s1($d)
	{
		if (substr($d,6,1)=="0")
		{$ret=substr($d,7,1);}
		else
		{$ret=substr($d,6,2);}
			$ret.=" ";	
		switch(substr($d,4,2))
		{case "01":
		$ret.="January";
		break;
		case "02":
		$ret.="February";
		break;
	case "03":
		$ret.="March";
		break;
	case "04":
		$ret.="April";
		break;
	case "05":
		$ret.="May";
		break;
	case "06":
		$ret.="June";
		break;
	case "07":
		$ret.="July";
		break;
	case "08":
		$ret.="August";
		break;
	case "09":
		$ret.="September";
		break;
	case "10":
		$ret.="October";
		break;
	case "11":
		$ret.="November";
		break;
	case "12":
		$ret.="December";
		break;		
		}
		$ret.=" ".substr($d,0,4);
		return $ret;
	}
	static function User_Menu()
	{
		return;
	}
	static function Mngr_Menu()
	{
		print '<h1>Ed Barton</h1>  
		<h3>Manage Data</h3>
	   <ul>
	  <li><a href="mngr_category.php">Category</a></li>
	  <li><a href="mngr_art.php">Artwork</a></li>
	  <li><a href="mngr_comments.php">Comments</a></li>
	    <li><a href="mngr_element.php">Fonts</a></li>
	  <li><a href="do_logout.php">Logout</a></li>
	  <LI><A HREF="/ed">Public</a></li>
	  </ul>';
	return;
	}
	
	static function hdr($m)
	{
		$ret='<!DOCTYPE html>
		<html lang="en">
		<head>
		<link rel="shortcut icon" href="favicon.ico" />
	<link rel="icon" href="favicon.ico" type="image/x-icon">
  	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/index.css">
	<link href="http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700" rel="stylesheet" type="text/css">';
	 
  if ($m=="M")
  {
	  $ret.='<title></title>';
    $ret.='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
  }
else
{	  
    $ret.='<title>Ed Barton</title>';
	$ret.='<META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">
	<meta name="description" content="Edward Barton : Manchester Artist/Musician">
	<meta name="keywords" content="Edward, Barton, Manchester, Artist, Musician">
	<meta name="author" content="Guy Lancaster">';
}
  		$ret.='</head>'; 
		print $ret;
		return ;
	}
}//class
//Admin View--------------------------------------------------------------------------------------------------------
class DbAdmin
{	
	static function open_db()
	{
		$ret = mysql_connect("atlas.elite.net.uk", "chorlt02_db1_ms", "mW7ptYRKk") or die('Could not connect: ' . mysql_error());
		$ret = mysql_select_db('chorlt02_db1', $ret);
		return $ret;
	}	 
}