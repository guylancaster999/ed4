<?php
require "classes/classes.php";
Page::hdr("U");
?>
<body>
<?php 
DbAdmin::open_db();
$qry			="select ttl1color,ttl1fontweight,ttl1fontsize ,ttl2color,ttl2fontweight,ttl2fontsize, ";
$qry			.="txtcolor,txtfontweight,txtfontsize ,hdgcolor,hdgfontweight,hdgfontsize,";
$qry			.="datecolor,datefontsize,datefontweight, linkcolor, linkfontsize,linkfontweight ";
$qry			.=" from edsys where indx=1;";
$result			= mysql_query($qry) or die('Query '.$qry.' failed: ' . mysql_error());
$row 			= mysql_fetch_array($result, MYSQL_ASSOC);
$ttl1color		=$row["ttl1color"];
$ttl1fontweight	=$row["ttl1fontweight"];
$ttl1fontsize	=$row["ttl1fontsize"];
$ttl2color		=$row["ttl2color"];
$ttl2fontweight	=$row["ttl2fontweight"];
$ttl2fontsize	=$row["ttl2fontsize"];
$txtcolor		=$row["txtcolor"];
$txtfontweight	=$row["txtfontweight"];
$txtfontsize	=$row["txtfontsize"];
$hdgcolor		=$row["hdgcolor"];
$hdgfontweight	=$row["hdgfontweight"];
$hdgfontsize	=$row["hdgfontsize"];
$datecolor		=$row["datecolor"];
$datefontweight	=$row["datefontweight"];
$datefontsize	=$row["datefontsize"];
$linkcolor		=$row["datecolor"];
$linkfontweight	=$row["linkfontweight"];
$linkfontsize	=$row["linkfontsize"];
$cat			=$_REQUEST["cat"];
?>
<div class="container">
 
  <div class="row">
    <div class="col-sm-8">
		<?php
		print Page::fmt("Art Works",$ttl1color,$ttl1fontsize,$ttl1fontweight)."<br/>";
		$qry="select hdg,txt,video,sound,artdate,category,code as artid from edart ";
		if (Page::count_digits($cat)>0)
		{
			$qry.=" where category=".$cat;
		}
		$qry.="  order by category,artdate";     
		$result = mysql_query($qry) or die('Query '.$qry.' failed: ' . mysql_error());
		$prevcat="*";
		
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$artdate	=$row["artdate"];
			$hdg		=$row["hdg"];
			$txt		=$row["txt"];
			$category	=$row["category"];
			$artid		=$row["artid"];
			 
			if ($prevcat !=$category)
			{
				$qryCat			="select descr,colr,fontweight,fontsize from edcategory where code=".$category;
				$resultCat		= mysql_query($qryCat) or die('Query '.$qryCat.' failed: ' . mysql_error());
				$rowCat 		= mysql_fetch_array($resultCat, MYSQL_ASSOC);
				$catDescr		= $rowCat["descr"];
				$catcolr		= $rowCat["colr"];
				$catfontweight	= $rowCat["fontweight"];
				$catfontsize	= $rowCat["fontsize"];
				print Page::fmt($catDescr,$catcolr,$catfontsize,$catfontweight)."<br/>";
				$prevcat 		=$category;
			}
			print Page::fmt($hdg,$hdgcolor,$hdgfontsize,$hdgfontweight)."<br/>";
			$dt=Page::date_to_s1($artdate);
			print Page::fmt($dt,$datecolor,$datefontsize,$datefontweight)."<br/>";
			$txt=Page::processLink($txt,$linkcolor,$linkfontsize,$linkfontweight);
			print Page::fmt($txt,$txtcolor,$txtfontsize,$txtfontweight)."<br/><br/>";
			$qryComments="select code,descr from edartcomment where artid=".$artid;
			$resultComments		= mysql_query($qryComments) or die('Query '.$qryComments.' failed: ' . mysql_error());
			while($rowComments = mysql_fetch_array($resultComments, MYSQL_ASSOC))
			{
				$commentId		=$rowComments['code'];
				$commentDescr	=$rowComments['descr'];
				print $comentId.". ".$commentDescr."<br/>";
			}
		}
		?>
	 </div>
   
    <div class="col-sm-4">
	<?php		
	print Page::fmt("Ed Barton",$ttl2color,$ttl2fontsize,$ttl2fontweight);
	?>
     <br/>
    <img src="img/ed.png" alt="Ed Barton" class="img-responsive"/>      
    <?php
	$qry="select soundcolor,videocolor,allcatcolor,ttl1color,ttl2color,commentcolor,txtcolor,linkcolor ";
	$qry.="	from edsys ";
	$qry.=" where indx=1;";
	$result = mysql_query($qry) or die('Query '.$qry.' failed: ' . mysql_error());
    $row = mysql_fetch_array($result, MYSQL_ASSOC);
	$allcatcolor=$row["allcatcolor"];
	print '<a href="index.php?cat=All"
           style="font-size:14pt;font-weight:bolder;color:#'.$allcatcolor.'">';
	print "All Categories";
	print "</a>";
	print "<br/>";
	$qry="select code,descr,colr from edcategory";
	$qry.=" order by ordr;";
	$result = mysql_query($qry) or die('Query '.$qry.' failed: ' . mysql_error());
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
	    $code	=$row["code"];
		$colr	=$row["colr"];
		$descr	=$row["descr"];
		print Page::fmt_link($descr,$colr,14,600,"index.php?cat=".$code)."<br/>";
	}
    ?>	 
    </div>
  </div>
</div>
</body>
</html>