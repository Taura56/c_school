<?php require_once('Connections/conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset2 = 10;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_conn, $conn);
$query_Recordset2 = "SELECT school.schoolName, school.address, school.town FROM school";
$query_limit_Recordset2 = sprintf("%s LIMIT %d, %d", $query_Recordset2, $startRow_Recordset2, $maxRows_Recordset2);
$Recordset2 = mysql_query($query_limit_Recordset2, $conn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);

if (isset($_GET['totalRows_Recordset2'])) {
  $totalRows_Recordset2 = $_GET['totalRows_Recordset2'];
} else {
  $all_Recordset2 = mysql_query($query_Recordset2);
  $totalRows_Recordset2 = mysql_num_rows($all_Recordset2);
}
$totalPages_Recordset2 = ceil($totalRows_Recordset2/$maxRows_Recordset2)-1;

$queryString_Recordset2 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset2") == false && 
        stristr($param, "totalRows_Recordset2") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset2 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset2 = sprintf("&totalRows_Recordset2=%d%s", $totalRows_Recordset2, $queryString_Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>comprehensive school</title>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="skyblue">
<table width="100%" border="0">
<tr>
    <td height="100"><center>
    <img src="images/logo.PNG" width="100" height="100" /><br />
    
    <br />

<table border="1" align="center">
  
  <?php do { ?>
    <?php echo $row_Recordset2['schoolName']; ?>&nbsp; <br/>
      <?php echo $row_Recordset2['address']; ?>&nbsp; <br />
      <?php echo $row_Recordset2['town']; ?>&nbsp; 
    
    <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
<hr size="5" color="black" width="100%" />
<table width="100%" border="0">
  <tr>
    <td><ul id="MenuBar1" class="MenuBarHorizontal">
      <li><a href="home.php">Home</a>        </li>
      <li><a href="instructor.php">Instructor</a></li>
      <li><a href="grade.php">Grade</a></li>
<li><a href="assesment.php">Assesment</a>        </li>
<li><a href="stream.php">Stream</a></li>
<li><a href="grading.php">Subject Grading</a></li>
<li><a href="learner.php">Learner</a></li>
<li><a href="allocation.php">Subject Allocation</a></li>
<li><a href="#" class="MenuBarItemSubmenu">Results</a>
  <ul>
    <li><a href="formative.php">Formative</a></li>
    <li><a href="summative.php">Summative</a></li>
  </ul>
</li>
    </ul></td>
  </tr>
</table>

<table width="100%" border="0" bgcolor="white">
  <tr>
    <td height="250"><center>
    <fieldset><legend align="center">Assesment Solution for CBC<br />content
    </legend></fieldset> 
    </center></td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td><center>&copy;INDUSTRIAL TRAINING 2024 All Rights Reseved</center></td>
  </tr>
</table>

  <script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
  </script>
</body>
</html>
<?php
mysql_free_result($Recordset2);
?>
