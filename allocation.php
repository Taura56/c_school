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
  $insertSQL = sprintf("INSERT INTO subjectallocation (AllocationCode, S1, S2, S3, S4, S5, S6, S7, S8, S9, S10, S11, S12, S13, S14, S15, S16, S17, S18, S19, S20, GradeCode, Term, AcYear) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['AllocationCode'], "text"),
                       GetSQLValueString($_POST['S1'], "text"),
                       GetSQLValueString($_POST['S2'], "text"),
                       GetSQLValueString($_POST['S3'], "text"),
                       GetSQLValueString($_POST['S4'], "text"),
                       GetSQLValueString($_POST['S5'], "text"),
                       GetSQLValueString($_POST['S6'], "text"),
                       GetSQLValueString($_POST['S7'], "text"),
                       GetSQLValueString($_POST['S8'], "text"),
                       GetSQLValueString($_POST['S9'], "text"),
                       GetSQLValueString($_POST['S10'], "text"),
                       GetSQLValueString($_POST['S11'], "text"),
                       GetSQLValueString($_POST['S12'], "text"),
                       GetSQLValueString($_POST['S13'], "text"),
                       GetSQLValueString($_POST['S14'], "text"),
                       GetSQLValueString($_POST['S15'], "text"),
                       GetSQLValueString($_POST['S16'], "text"),
                       GetSQLValueString($_POST['S17'], "text"),
                       GetSQLValueString($_POST['S18'], "text"),
                       GetSQLValueString($_POST['S19'], "text"),
                       GetSQLValueString($_POST['S20'], "text"),
                       GetSQLValueString($_POST['GradeCode'], "text"),
                       GetSQLValueString($_POST['Term'], "int"),
                       GetSQLValueString($_POST['AcYear'], "int"));

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
$query_Recordset1 = "SELECT grade.GradeCode FROM grade";
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
      <legend align="center">Enter Subjects Allocation Details and click SAVE</legend>
      <legend align="center">
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table align="center" bgcolor="e6e6fa">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Allocation Code:</td>
            <td><input type="text" name="AllocationCode" value="" size="32" required/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 1:</td>
            <td><input type="text" name="S1" value="" size="32" required/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 2:</td>
            <td><input type="text" name="S2" value="" size="32" required/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 3:</td>
            <td><input type="text" name="S3" value="" size="32" required/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 4:</td>
            <td><input type="text" name="S4" value="" size="32" required/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 5:</td>
            <td><input type="text" name="S5" value="" size="32" required/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 6:</td>
            <td><input type="text" name="S6" value="" size="32" required/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 7:</td>
            <td><input type="text" name="S7" value="" size="32" required/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 8:</td>
            <td><input type="text" name="S8" value="" size="32" required/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 9:</td>
            <td><input type="text" name="S9" value="" size="32" required/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 10:</td>
            <td><input type="text" name="S10" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 11:</td>
            <td><input type="text" name="S11" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 12:</td>
            <td><input type="text" name="S12" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 13:</td>
            <td><input type="text" name="S13" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 14:</td>
            <td><input type="text" name="S14" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 15:</td>
            <td><input type="text" name="S15" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 16:</td>
            <td><input type="text" name="S16" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 17:</td>
            <td><input type="text" name="S17" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 18:</td>
            <td><input type="text" name="S18" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 19:</td>
            <td><input type="text" name="S19" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Subject 20:</td>
            <td><input type="text" name="S20" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Grade Code:</td>
            <td align="left">
            <select name="GradeCode">
              <option value="">Select Grade Code</option>
              <?php
do {  
?>
              <option value="<?php echo $row_Recordset1['GradeCode']?>"><?php echo $row_Recordset1['GradeCode']?></option>
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
            <td nowrap="nowrap" align="right">Term:</td>
            <td align="left"><select name="Term">
            <option>Term 1</option>
            <option>Term 2</option>
            <option>Term 3</option>
            </select></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Accademic Year:</td>
            <td align="left"><select name="AcYear">
            <option>Select Accademic Year</option>
            <option>2023</option>
            <option>2024</option>
            <option>2025</option>
            <option>2026</option>
            <option>2027</option>
            <option>2028</option>
            <option>2029</option>
            <option>2030</option>
            <option>2031</option>
            <option>2032</option>
            <option>2033</option>
            <option>2034</option>
            <option>2035</option>
            <option>2036</option>
            </select></td>
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
      <br />
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
