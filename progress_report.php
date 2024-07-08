<?php require_once('Connections/conn.php'); ?>
<?php

//get PL
function getPerformanceLevel($score) {
    if ($score <=100 && $score >=70 ) {
        echo "E.E";
    } elseif ($score <70 && $score >=50 ) {
        echo "M.E";
    } elseif ($score <50 && $score >=20 ) {
        echo "A.E";
    } else {
        echo "B.E";
    }
}


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

mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT learner.Surname, learner.FName, grade.GradeName, stream.streamName, `year`.`year`, learner.Term FROM learner, grade, stream, `year`";
$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$maxRows_Recordset3 = 10;
$pageNum_Recordset3 = 0;
if (isset($_GET['pageNum_Recordset3'])) {
  $pageNum_Recordset3 = $_GET['pageNum_Recordset3'];
}
$startRow_Recordset3 = $pageNum_Recordset3 * $maxRows_Recordset3;
mysql_select_db($database_conn, $conn);
$query_Recordset3 = "SELECT `result`.S1, `result`.S2, `result`.S3, `result`.S4, `result`.S5, `result`.S6, `result`.S7, `result`.S8, `result`.S9 FROM `result` WHERE `result`.AssessmentCode= 101";
$query_limit_Recordset3 = sprintf("%s LIMIT %d, %d", $query_Recordset3, $startRow_Recordset3, $maxRows_Recordset3);
$Recordset3 = mysql_query($query_limit_Recordset3, $conn) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);

if (isset($_GET['totalRows_Recordset3'])) {
  $totalRows_Recordset3 = $_GET['totalRows_Recordset3'];
} else {
  $all_Recordset3 = mysql_query($query_Recordset3);
  $totalRows_Recordset3 = mysql_num_rows($all_Recordset3);
}
$totalPages_Recordset3 = ceil($totalRows_Recordset3/$maxRows_Recordset3)-1;

$maxRows_Recordset4 = 10;
$pageNum_Recordset4 = 0;
if (isset($_GET['pageNum_Recordset4'])) {
  $pageNum_Recordset4 = $_GET['pageNum_Recordset4'];
}
$startRow_Recordset4 = $pageNum_Recordset4 * $maxRows_Recordset4;

mysql_select_db($database_conn, $conn);
$query_Recordset4 = "SELECT `result`.S1, `result`.S2, `result`.S3, `result`.S4, `result`.S5, `result`.S6, `result`.S7, `result`.S8, `result`.S9 FROM `result` WHERE `result`.AssessmentCode=102";
$query_limit_Recordset4 = sprintf("%s LIMIT %d, %d", $query_Recordset4, $startRow_Recordset4, $maxRows_Recordset4);
$Recordset4 = mysql_query($query_limit_Recordset4, $conn) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);

if (isset($_GET['totalRows_Recordset4'])) {
  $totalRows_Recordset4 = $_GET['totalRows_Recordset4'];
} else {
  $all_Recordset4 = mysql_query($query_Recordset4);
  $totalRows_Recordset4 = mysql_num_rows($all_Recordset4);
}
$totalPages_Recordset4 = ceil($totalRows_Recordset4/$maxRows_Recordset4)-1;

mysql_select_db($database_conn, $conn);
$query_Recordset5 = "SELECT `result`.S1, `result`.S2, `result`.S3, `result`.S4, `result`.S5, `result`.S6, `result`.S7, `result`.S8, `result`.S9 FROM `result` WHERE `result`.AssessmentCode=103";
$Recordset5 = mysql_query($query_Recordset5, $conn) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

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
<?php do { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>comprehensive school</title>
</head>

<body >
<table border="2" width="100%"><tr><td>
<table width="100%" border="0">
<tr>
    <td height="100"><center>
      <p><img src="images/logo.PNG" width="100" height="100" /><br />
        
        <br />
        
  <table border="1" align="center">
        
        <p>
          <?php do { ?>
            <?php echo $row_Recordset2['schoolName']; ?>&nbsp; <br/>
            <?php echo $row_Recordset2['address']; ?>&nbsp; <?php echo $row_Recordset2['town']; ?>&nbsp; <br />
            <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
        </p>THE SCHOOL PROGRESSIVE REPORT</p>
        <p>LEARNERS NAME: <u><font color="blue"><?php echo $row_Recordset1['Surname']; ?> <?php echo $row_Recordset1['FName']; ?> </font></u> &nbsp;&nbsp;SIGN:________&nbsp;&nbsp;
      GRADE: <u><font color="blue"><?php echo $row_Recordset1['GradeName']; ?></font></u>&nbsp;&nbsp; STREAM: <u><font color="blue"><?php echo $row_Recordset1['streamName']; ?> </font></u>&nbsp;&nbsp; TERM: <u><font color="blue"><?php echo $row_Recordset1['Term']; ?> </font></u>&nbsp;&nbsp; YEAR: <u><font color="blue"><?php echo $row_Recordset1['year']; ?> </font></u> DATE: <u><font color="blue">
      <!-- #BeginDate format:En2 -->08-Jul-2024<!-- #EndDate -->
      </font></u></p>
      <hr size="5" color="black" width="100%" />
      
      
      
      <table width="100%" border="1">
        <tr>
          <td>S/NO</td>
          <td>LEARNER AREA</td>
          <td>CAT 1</td>
          <td>P.L</td>
          <td>CAT 2</td>
          <td>P.L</td>
          <td>END TERM</td>
          <td>P.L</td>
          <td>FACILITATORS SIGN</td>
        </tr>
        
        <tr>
          <td>1</td>
          <td>MATHEMATICS</td>
          <td><?php echo $row_Recordset4['S1']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset4['S1']); ?></td>
         <td><?php echo $row_Recordset5['S1']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset5['S1']); ?></td>
          <td><?php echo $row_Recordset3['S1']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset3['S1']); ?></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>2</td>
          <td>ENGLISH</td>
          <td><?php echo $row_Recordset4['S2']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset4['S2']); ?></td>
          <td><?php echo $row_Recordset5['S2']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset5['S2']); ?></td>
          <td><?php echo $row_Recordset3['S2']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset3['S2']); ?></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>3</td>
          <td>KISWAHILI</td>
          <td><?php echo $row_Recordset4['S3']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset4['S3']); ?></td>
          <td><?php echo $row_Recordset5['S3']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset5['S3']); ?></td>
          <td><?php echo $row_Recordset3['S3']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset3['S3']); ?></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>4</td>
          <td>INTERGRATED SCIENCE</td>
         <td><?php echo $row_Recordset4['S4']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset3['S4']); ?></td>
         <td><?php echo $row_Recordset5['S4']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset5['S4']); ?></td>
          <td><?php echo $row_Recordset3['S4']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset3['S4']); ?></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>5</td>
          <td>PRE-TECHNICAL STUDIES</td>
          <td><?php echo $row_Recordset4['S5']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset4['S5']); ?></td>
          <td><?php echo $row_Recordset5['S5']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset5['S5']); ?></td>
          <td><?php echo $row_Recordset3['S5']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset3['S5']); ?></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>6</td>
          <td>CRE</td>
          <td><?php echo $row_Recordset4['S6']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset4['S6']); ?></td>
          <td><?php echo $row_Recordset5['S2']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset5['S6']); ?></td>
          <td><?php echo $row_Recordset3['S6']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset3['S6']); ?></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>7</td>
          <td>SOCIAL STUDIES</td>
          <td><?php echo $row_Recordset4['S7']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset4['S7']); ?></td>
          <td><?php echo $row_Recordset5['S7']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset5['S7']); ?></td>
          <td><?php echo $row_Recordset3['S7']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset3['S7']); ?></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>8</td>
          <td>AGRI/NUTRITION</td>
          <td><?php echo $row_Recordset4['S8']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset4['S8']); ?></td>
          <td><?php echo $row_Recordset5['S8']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset5['S8']); ?></td>
          <td><?php echo $row_Recordset3['S8']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset3['S8']); ?></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>9</td>
          <td>CREATIVE ARTS &amp;SPORTS</td>
          <td><?php echo $row_Recordset4['S9']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset4['S9']); ?></td>
          <td><?php echo $row_Recordset5['S9']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset5['S9']); ?></td>
          <td><?php echo $row_Recordset3['S9']; ?></td>
          <td><?php getPerformanceLevel($row_Recordset3['S9']); ?></td>
          <td>&nbsp;</td>
        </tr>
       
      </table>
      <p>CLASS TEACHERS COMMENT ........................................................................................................................................................................................................................................................</p>
      <p>PARENT/GUARDIANS COMMENT...................................................................................................................................................................................................................................................</p>
      <p>NAME................................................................. PHONE NUMBER.................................................................................................. SIGN................................................................................</p>
      <p>KEY</p>
      <table width="100%" border="1">
        <tr>
          <td width="35%">MATH, INTERGRATED SCIENCE, PRE-TECH, CREATIVE ARTS&amp;SPORTS</td>
          <td width="30%">ENG, KIS, SST, CRE, AGRI/NUT</td>
          <td width="35%">PL: PERFOMING LEVELS</td>
        </tr>
        <tr>
          <td><p>0-19 B.E</p>
          <p>20-49 A.E</p>
          <p>50-69 M.E</p>
          <p>70-100 E.E</p></td>
          <td><p>0-29 B.E</p>
            <p>30-59 A.E</p>
            <p>60-79 M.E</p>
          <p>80-100 E.E</p></td>
          <td><p>B.E BELOW EXPECTATION</p>
          <p>A.E APPROACHING EXPECTATION</p>
          <p>M.E MEETING EXPECTATION</p>
          <p>E.E EXCEEDING EXPECTATION</p></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <p>Generated by:__________________________________________________ Signature:_____________________________________ Date: <u><font color="blue">
        <!-- #BeginDate format:En2 -->08-Jul-2024<!-- #EndDate -->
      </font></u></p>
<p>&nbsp; </p>
</table>
  </body>
</html>
<?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
<?php
mysql_free_result($Recordset2);

mysql_free_result($Recordset1);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);

mysql_free_result($Recordset5);
?>
 
