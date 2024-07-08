<?php require_once('Connections/conn.php'); ?>
<?php
//function to return PL
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
//function to return total score
function getTotal($scores) {
    return array_sum($scores);
}
//function to calculate average
function calculateAverageScore($scores) {
    $total = array_sum($scores);
    $count = count($scores);
    return $count > 0 ? round($total / $count, 2) : 0;
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
$query_Recordset3 = "SELECT assessment.AssessmentCode, assessment.AssessmentDescription FROM assessment WHERE assessment.AssessmentCode=101";
$Recordset3 = mysql_query($query_Recordset3, $conn) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT grade.GradeName, stream.streamName, learner.Term, learner.AcYear, learner.Surname, learner.FName, `result`.S1, `result`.S2, `result`.S3, `result`.S4, `result`.S5, `result`.S6, `result`.S7, `result`.S8, `result`.S9, assessment.AssessmentDescription FROM grade, stream, learner, `result`, assessment WHERE assessment.AssessmentCode=101";
$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);

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
</head>

<body>

<table width="100%" border="0">
<tr>
    <td height="100"><center>
      <p><img src="images/logo.PNG" width="100" height="100" /><br />
        
        <br />
        
  <table border="1" align="center">
        
        <?php do { ?>
        <?php echo $row_Recordset2['schoolName']; ?>&nbsp; <br/>
        <?php echo $row_Recordset2['address']; ?>&nbsp; 
        <?php echo $row_Recordset2['town']; ?>&nbsp; 
          
        <br />
        <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
      </p>
      <p>GRADE: <u><font color="blue"><?php echo $row_Recordset1['GradeName']; ?></font></u>&nbsp;&nbsp; STREAM: <u><font color="blue"><?php echo $row_Recordset1['streamName']; ?></font></u>&nbsp;&nbsp;ASSESMENT TYPE: <u><font color="blue"><?php echo $row_Recordset3['AssessmentDescription']; ?></font></u>&nbsp;&nbsp; TERM: <u><font color="blue"><?php echo $row_Recordset1['Term']; ?></font></u>&nbsp;&nbsp; YEAR: <u><font color="blue"><?php echo $row_Recordset1['AcYear']; ?></font></u>&nbsp;</p>
      <hr size="5" color="black" width="100%" />
<table width="100%" border="1">
  <tr>
    <td width="4%">SN</td>
    <td width="12%">STUDENT NAME</td>
    <td width="4%">ENG</td>
    <td width="4%">PL</td>
    <td width="4%">KIS</td>
    <td width="4%">PL</td>
    <td width="4%">MATH</td>
    <td width="4%">PL</td>
    <td width="4%">INT SCI</td>
    <td width="4%">PL</td>
    <td width="4%">PRE TECH</td>
    <td width="4%">PL</td>
    <td width="4%">CRE</td>
    <td width="4%">PL</td>
    <td width="4%">AGR/NUT</td>
    <td width="4%">PL</td>
    <td width="4%">CA/PA</td>
    <td width="4%">PL</td>
    <td width="4%">SST</td>
    <td width="4%">PL</td>
    <td width="4%">TOTAL</td>
    <td width="4%">AVG</td>
    <td width="4%">REMA</td>
  </tr>
  
  <?php do { 
  $scores = array(
        $row_Recordset1['S1'],
        $row_Recordset1['S2'],
        $row_Recordset1['S3'],
        $row_Recordset1['S4'],
        $row_Recordset1['S5'],
        $row_Recordset1['S6'],
        $row_Recordset1['S7'],
        $row_Recordset1['S8'],
        $row_Recordset1['S9']
    );
    $totalScore = getTotal($scores);
    $averageScore = calculateAverageScore($scores);
  ?>
    <tr>
      <td><a href="ii.php?recordID="></a></td>
      <td><?php echo $row_Recordset1['Surname']; ?>&nbsp;<?php echo $row_Recordset1['FName']; ?>&nbsp; </td>
      <td><?php echo $row_Recordset1['S1']; ?>&nbsp; </td>
      <td><?php getPerformanceLevel($row_Recordset1['S1']); ?></td>
      <td><?php echo $row_Recordset1['S2']; ?>&nbsp; </td>
      <td><?php getPerformanceLevel($row_Recordset1['S2']); ?></td>
      <td><?php echo $row_Recordset1['S3']; ?>&nbsp; </td>
      <td><?php getPerformanceLevel($row_Recordset1['S3']); ?></td>
      <td><?php echo $row_Recordset1['S4']; ?>&nbsp; </td>
      <td><?php getPerformanceLevel($row_Recordset1['S4']); ?></td>
      <td><?php echo $row_Recordset1['S5']; ?>&nbsp; </td>
      <td><?php getPerformanceLevel($row_Recordset1['S5']); ?></td>
      <td><?php echo $row_Recordset1['S6']; ?>&nbsp; </td>
      <td><?php getPerformanceLevel($row_Recordset1['S6']); ?></td>
      <td><?php echo $row_Recordset1['S7']; ?>&nbsp; </td>
      <td><?php getPerformanceLevel($row_Recordset1['S7']); ?></td>
      <td><?php echo $row_Recordset1['S8']; ?>&nbsp; </td>
      <td><?php getPerformanceLevel($row_Recordset1['S8']); ?></td>
      <td><?php echo $row_Recordset1['S9']; ?>&nbsp; </td>
      <td><?php getPerformanceLevel($row_Recordset1['S9']); ?></td>
      <td><?php echo $totalScore; ?>&nbsp; </td>
      <td><?php echo $averageScore; ?>&nbsp; </td>
      <td><?php getPerformanceLevel($averageScore); ?>&nbsp; </td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?> <br />
    <tr>
    <td height="50" colspan="22"></td>
    </tr>
   <tr>
    <td rowspan="4"></td>
    <td width="12%">SUBJECT TOTAL</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
  </tr>
  <tr>
  <td>NO OF LEARNERS</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  <td>MEAN SCORE</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  <td>SUBJECT POSITION</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br/>

<p>Generated by:__________________________________________________ Signature:_____________________________________ Date: <u><font color="blue">
  <!-- #BeginDate format:En2 -->08-Jul-2024<!-- #EndDate -->
</font></u></p>
<p>&nbsp; </p>
  </body>
</html>
<?php
mysql_free_result($Recordset2);

mysql_free_result($Recordset1);

mysql_free_result($Recordset3);
?>
