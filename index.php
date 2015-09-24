<?php
require "classes/classes.php";
Page::hdr("U");
?>
<body>
<script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php 
DbAdmin::open_db();
$cat			= $_REQUEST["cat"];
$search			= $_REQUEST["search"];
$screentype		= Page::default_blank($_REQUEST["screentype"],"category");
?>
<div class="container">
  <div class="row" >
<!--
*---------------------------------------------------------------------------------------------------*
|                          Column 1                                                                 |
*---------------------------------------------------------------------------------------------------*	
-->
  <div class="col-sm-8" >
	<?php
	print Page::fmt_element(Page::TTL1,"ttl1");
	print "<br/>";

	switch ($screentype)
	{
	case "search":
	
  	$qry 	="select hdg, txt, artdate, category, code as artid ";
	$qry	.=" from edart ";
	$qry	.=" where (hdg like '%".trim($search)."%') ";
	$qry	.=" order by artdate";    
	$result = mysql_query($qry) or die('Query '.$qry.' failed: ' . mysql_error());
	$ctr	= 0;
		
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$ctr++;
		$artdate	=$row["artdate"];
		$hdg		=$row["hdg"];
		$txt		=$row["txt"];
		$category	=$row["category"];
		$artid		=$row["artid"];
		$dt			=Page::date_to_s1($artdate);
		print "<br/>".Page::fmt_element($hdg,"hdg")."<br/>";
		print Page::fmt_element($dt,"date");
		print "<br/><br/><br/>";
		print Page::fmt_page($txt,$artid,$hdg,$screentype);
	}
	if ($ctr==0)
	{
		print Page::fmt_element("No articles found for [".$search."]","footer");
	}
	else
	{
		print Page::fmt_element("Articles found for [".$search."] in date order.","footer");
	}	 	
	break;
		
	case "archive":
		print  Page::fmt_element("Archive","archivettl")."<br><br>";
		$prevy4  ="*";
		$qry 	 ="select hdg,txt, artdate,category,code as artid ";
		$qry	.=" from edart ";
		$qry	.=" order by artdate desc;";
		$result = mysql_query($qry) or die('Query '.$qry.' failed: ' . mysql_error());
		
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$artdate	=$row["artdate"];
			$hdg		=$row["hdg"];
			$txt		=$row["txt"];
			$category	=$row["category"];
			$artid		=$row["artid"];
			$y4			=substr($artdate,0,4);
		
			if ($prevy4 !=$y4)
			{
				print "<a name='Y".$y4."'></a>";
				print Page::fmt_element($y4,archive);
				print "<br><br>";
				$prevy4 = $y4;
			}
			print "<a name='ID".$artid."'></a>";
			print "<br/>".Page::fmt_element($hdg,"hdg")."<br/>";
			$dt	= Page::date_to_s1($artdate);
			print Page::fmt_element($dt,"date");
			print "<br/><br/><br/>";
			print Page::fmt_page($txt,$artid,$hdg,$screentype);
 		}
		print Page::fmt_element("Articles listed in reverse date order.","footer");
		break;
	
	case "category":
	$submit	 = $_REQUEST["submit"];
 	$qry ="select a.hdg,a.txt ,a.artdate,a.category,a.code as artid ";
	$qry.="from edart as a,edcategory as b";
	$qry.=" where a.category=b.code ";
	
	if (strlen($cat)>0)
	{
	    $qryCat		= "select descr from edcategory where code =".$cat.";";
		$resultCat 	= mysql_query($qryCat) or die('Query '.$qryCat.' failed: ' . mysql_error());
		$rowCat 	= mysql_fetch_array($resultCat, MYSQL_ASSOC);
		$descrCat	= $rowCat["descr"];
		$qry		.=" and (a.category = ".$cat.") ";
	}	
	$qry	.=" order by  b.ordr, a.artdate;";
	$result = mysql_query($qry) or die('Query '.$qry.' failed: ' . mysql_error());
	$prevcat="*";
	$ctr	=0;
		
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$ctr++;
		$artdate	=$row["artdate"];
		$hdg		=$row["hdg"];
		$txt		=$row["txt"];
		$category	=$row["category"];
		$artid		=$row["artid"];
  		$dt			=Page::date_to_s1($artdate);
		print "<br/>".Page::fmt_element($hdg,"hdg")."<br/>";
		print Page::fmt_element($dt,"date");
		print "<br/><br/><br/>";
		print Page::fmt_page($txt,$artid,$hdg,$screentype);
 		}
		if ($ctr==0)
		{
			print Page::fmt_emlement("No articles found for category ".$descrCat,"footer");
		}
		else
		{
			print Page::fmt_element("Articles listed ".(strlen($cat)>0?" for ".$descrCat :"")." in Date order.","footer");  
		}
		   
} //switch screentype
?>
<br/>
<br/>
 </div>   
   <div class="col-sm-4">
<!--
*---------------------------------------------------------------------------------------------------*
|                          Column 2                                                                 |
*---------------------------------------------------------------------------------------------------*
-->
	<?php print Page::fmt_element(Page::TTL2,"ttl2"); ?>
    <br/>
  <br/>
	<a href="index.php" title="Edward Barton">
		<img src="img/mastheadedward_240.jpg" alt="Edward Barton" class="img-responsive"/>
	</a>	
<?php print Page::pin("mastheadedward_240.jpg","img","Edward Barton");?>
<br/><br/><div> 
<?php
 	$qry="select code,descr,colr,font,fontweight,fontsize, italic ";
	$qry.=" from edcategory";
	$qry.=" order by ordr";
	$result = mysql_query($qry) or die('Query '.$qry.' failed: ' . mysql_error());

	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
	{
		$code		=$row["code"];
		$colr		=$row["colr"];
		$descr		=$row["descr"];
		$font		=$row["font"];
		$fontweight	=$row["fontweight"];
		$fontsize	=$row["fontsize"];
		$italic		=$row["italic"];
		print '<a href="index.php?screentype=category&cat='.$code.'">';
		print Page::fmt($descr,$colr,$font,$fontsize,$fontweight,$italic,($code==$cat?"Y":"N"));
		print '</a>';
    	print '<br/>';
	}
	print "</div>";
    ?>	 
	<BR/>
	<br/><a name="archive"></a>
	<div >
	<?php
	print "<a href='index.php?screentype=archive#archive'>".Page::fmt_element("Archive","archivettl")."</a>";
	print "<br/>";
	
	if ($screentype=="archive")
	{
		$qry		= "select hdg,artdate,code ";
		$qry.=		" from edart order by artdate desc;";
		$result 	= mysql_query($qry) or die('Query '.$qry.' failed: ' . mysql_error());
		$prevy4		= "#";
		$ctr		= 0;
		$hdgs		= "";
		$archive	= $_REQUEST["archive"];

	while($row = mysql_fetch_array($result, MYSQL_ASSOC) ) 
	{
		$artid	=$row["code"];
		$date	=$row["artdate"];
		$hdg	=$row["hdg"];
		$y4		=substr($date,0,4);

		if ($y4!=$prevy4)
		{
			if ($ctr>0)
			{
				$link='index.php';
				$link.='?screentype=archive';
				$link.="&archive=".$prevy4;
				$link.='#Y'.$prevy4;
				print '<a href="'.$link.'">'.Page::fmt_element($prevy4,"archive"). "</a>";
				print "&nbsp;&nbsp;".Page::fmt_element("(". $ctr.")","archivectr")."<br/>";
				if ($archive == $prevy4)
				{
					print $hdgs;
				}
				$ctr=0;
				$hdgs="";
			}
		}
		$ctr++;
		$prevy4	=$y4;
	    $hdgs	.="&nbsp;&nbsp;&nbsp;";
		$link	="index.php";
		$link	.="?screentype=archive";
		$link	.="&archive=".$prevy4;
		$link	.="#ID".$artid;
		$hdgs	.=	'<a href="'.$link.'">'.Page::fmt_element($hdg,"archive")."</a><br/>";
	} 
	if ($ctr>0)
	{
		$link='index.php';
		$link.='?screentype=archive';
		$link.="&archive=".$prevy4;
		$link.='#Y'.$prevy4;
		print '<a href="'.$link.'">'.Page::fmt_element($prevy4,"archive")."</a>";
		print "&nbsp;&nbsp;".Page::fmt_element("(".$ctr.")","archivectr")."<br/>";

		if ($archive ==$prevy4)
				{
					print $hdgs;
				}
		}			
	}
	?>	
	</div>
	<br/>
   <div>
   <form method="Post" action="index.php">
   <input type="hidden" id="screentype" name="screentype" value="search"/>
   <table>
   <tr>
   <td><?php print Page::fmt_element("Search:",'search');?>&nbsp;</td>
   <td><input type='text'  name='search'  value="<?php print $search;?>" class='form-control'></td>
   <td>&nbsp;&nbsp;	</td>
   <td><INPUT TYPE="image" SRC="img/button1.jpg" HEIGHT="30" WIDTH="30" BORDER="0" ALT="Go" class="gobutton"></td>
   </tr>
   </table>
   </form>
<br/>
	<?php print Page::fmt_element('Contact',"contactttl");
	print '&nbsp;';
	print Page::fmt_element('<a href="MAILTO:edwardnotedward@yahoo.co.uk">edwardnotedward@yahoo.co.uk</a>','contact');?>
	<BR/>
<br/>
<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
<script>!function(d,s,id)
{var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
if(!d.getElementById(id))
    {js=d.createElement(s);
     js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
	 fjs.parentNode.insertBefore(js,fjs);
	 }
}(document, 'script', 'twitter-wjs');</script>
<br/>
<div class="g-plusone" data-annotation="inline" data-width="300" data-href="http://www.chorltonlittlegems.co.uk/ed">
</div>
<div class="fb-share-button" data-href="http://www.chorltonlittlegems.co.uk/ed/" data-layout="button_count">
</div>
</div>
</div>
</div>
</div>
<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'en-GB'}
</script>
</body>
</html>		