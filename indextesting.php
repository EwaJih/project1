<?
include "config.php";
$query1="Select *,DATE_FORMAT(date_posted,'%W,%d %b %Y') as thedate FROM article INNER JOIN categories ON categoryID=catid WHERE DATE_SUB(CURDATE(),INTERVAL 30 DAY)AND artchild='0' ORDER BY date_posted DESC LIMIT 10 ";
$blogarticles = mysql_query($query1) or die(mysql_error());
$num = mysql_num_rows($blogarticles);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/BlogTpl.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Blog::</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="Templates/blogcss.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellspacing="1">
  <tr>
    <td colspan="2" class="temptitle">MyBlog</td>
  </tr>
  <tr>
    <td width="74%" valign="top"><!-- InstanceBeginEditable name="EditRegion3" -->
      <table width="100%" border="0" cellspacing="1">
	  <tr>
          <td>&nbsp;</td>
        </tr>
	  <tr>
          <td>&nbsp;</td>
        </tr>
	  <? 
	if($num > 0){
	while($row_articles = mysql_fetch_assoc($blogarticles)){
	?>
       
           <tr class="title">
          <td><?=$row_articles['title'];?> </td>
        </tr> 
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr class="tbody">
          <td><?=$row_articles['comments'];?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
		
        <tr class="links">
          <td>Date posted: <?=$row_articles['date_posted'];?> | <a href="comments.php?aid=<?=$row_articles['artid'];?>&cid=<?=$row_articles['categoryID'];?>">Comments(<? //echo $row_articles['artid'];		  
		
		//$thenum=row_articles['artid'];
		$getcomments = "SELECT * FROM article WHERE artchild='".$row_articles['artid']."'";
		if(!$theResult=mysql_query($getcomments)){
		echo mysql_error();
		}else{
		$num_comments=mysql_num_rows($theResult);
		echo $num_comments;
		}
		?>) </a></td>
        </tr>
        <tr class="links">
          <td>&nbsp;</td>
        </tr>
        <tr class="links">
          <td>&nbsp;</td>
        </tr>
		<?
		}
		}else{
		 ?>
		<tr><td><p>There are no articles available at present</p></td></tr>
		<?
		}
		?>
		<tr>		</tr>
      </table>
    <!-- InstanceEndEditable --></td>
    <td width="26%" valign="top"><!-- InstanceBeginEditable name="EditRegion4" -->
	<br />
      <table width="100%" border="0" cellspacing="1">
        <tr class="navbot">
          <td bgcolor="#CCCCFF" class="navbot">Recent Topics </td>
        </tr>
		<tr>
          <td>&nbsp;</td>
        </tr>
		<?
		$query="Select *,COUNT(*) FROM article INNER JOIN categories ON categoryID=catid WHERE DATE_SUB(CURDATE(),INTERVAL 30 DAY) GROUP BY title DESC LIMIT 10 ";
$blog = mysql_query($query) or die(mysql_error());
$num_blog = mysql_num_rows($blog);
if($num_blog > 0){
while($row_blog = mysql_fetch_assoc($blog)){
		?>
       
        <tr>
          <td class="listtopics"><b><?=$row_blog['title'];?></b> posted in <b><?=$row_blog['category']?></b> </td>
        </tr>
		<? 
		}
		}else{ ?>
		<tr>
		<td><p>No topics to list</p></td>
		</tr>
		<? } ?>
      </table>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2" class="copyright">Copyright&copy;2006</td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
