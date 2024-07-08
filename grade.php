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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO grade (GradeCode, GradeName, InstructorCode, Capacity) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['GradeCode'], "text"),
                       GetSQLValueString($_POST['GradeName'], "text"),
                       GetSQLValueString($_POST['InstructorCode'], "text"),
                       GetSQLValueString($_POST['Capacity'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
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

mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT instructor.InstructorCode FROM instructor";
$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

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
    <fieldset>
      <legend align="center">Enter Grade details and click on SAVE </legend>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table align="center" bgcolor="e6e6fa">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Grade Code:</td>
            <td><input type="text" name="GradeCode" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Grade Name:</td>
            <td><input type="text" name="GradeName" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Instructor Code:</td>
            <td align="left">
            <select name="InstructorCode">
              <option value="">Select Instructor Code</option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset1['InstructorCode']?>"><?php echo $row_Recordset1['InstructorCode']?></option>
              <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
            </select>
            </td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Capacity:</td>
            <td><input type="text" name="Capacity" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="SAVE" />
              <input type="reset" name="button" id="button" value="Reset" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
    </form>
      <p>&nbsp;</p>
<legend align="center"><br />
      </legend>
    </fieldset> 
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

mysql_free_result($Recordset1);
?>