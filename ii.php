<?php require_once('Connections/conn.php'); ?><?php
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

$maxRows_DetailRS1 = 10;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;

$colname_DetailRS1 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS1 = $_GET['recordID'];
}
mysql_select_db($database_conn, $conn);
$query_DetailRS1 = sprintf("SELECT grade.GradeName, stream.streamName, assessment.Term, assessment.AcYear, learner.Surname, learner.FName, `result`.S1, `result`.S2, `result`.S3, `result`.S4, `result`.S5, `result`.S6, `result`.S7, `result`.S8, `result`.S9, `result`.TotalScore, `result`.AverageScore, `result`.OverallRemark FROM grade, stream, assessment, learner, `result` WHERE GradeName = %s", GetSQLValueString($colname_DetailRS1, "text"));
$query_limit_DetailRS1 = sprintf("%s LIMIT %d, %d", $query_DetailRS1, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS1 = mysql_query($query_limit_DetailRS1, $conn) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);

if (isset($_GET['totalRows_DetailRS1'])) {
  $totalRows_DetailRS1 = $_GET['totalRows_DetailRS1'];
} else {
  $all_DetailRS1 = mysql_query($query_DetailRS1);
  $totalRows_DetailRS1 = mysql_num_rows($all_DetailRS1);
}
$totalPages_DetailRS1 = ceil($totalRows_DetailRS1/$maxRows_DetailRS1)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<table border="1" align="center">
  <tr>
    <td>GradeName</td>
    <td><?php echo $row_DetailRS1['GradeName']; ?></td>
  </tr>
  <tr>
    <td>streamName</td>
    <td><?php echo $row_DetailRS1['streamName']; ?></td>
  </tr>
  <tr>
    <td>Term</td>
    <td><?php echo $row_DetailRS1['Term']; ?></td>
  </tr>
  <tr>
    <td>AcYear</td>
    <td><?php echo $row_DetailRS1['AcYear']; ?></td>
  </tr>
  <tr>
    <td>Surname</td>
    <td><?php echo $row_DetailRS1['Surname']; ?></td>
  </tr>
  <tr>
    <td>FName</td>
    <td><?php echo $row_DetailRS1['FName']; ?></td>
  </tr>
  <tr>
    <td>S1</td>
    <td><?php echo $row_DetailRS1['S1']; ?></td>
  </tr>
  <tr>
    <td>S2</td>
    <td><?php echo $row_DetailRS1['S2']; ?></td>
  </tr>
  <tr>
    <td>S3</td>
    <td><?php echo $row_DetailRS1['S3']; ?></td>
  </tr>
  <tr>
    <td>S4</td>
    <td><?php echo $row_DetailRS1['S4']; ?></td>
  </tr>
  <tr>
    <td>S5</td>
    <td><?php echo $row_DetailRS1['S5']; ?></td>
  </tr>
  <tr>
    <td>S6</td>
    <td><?php echo $row_DetailRS1['S6']; ?></td>
  </tr>
  <tr>
    <td>S7</td>
    <td><?php echo $row_DetailRS1['S7']; ?></td>
  </tr>
  <tr>
    <td>S8</td>
    <td><?php echo $row_DetailRS1['S8']; ?></td>
  </tr>
  <tr>
    <td>S9</td>
    <td><?php echo $row_DetailRS1['S9']; ?></td>
  </tr>
  <tr>
    <td>TotalScore</td>
    <td><?php echo $row_DetailRS1['TotalScore']; ?></td>
  </tr>
  <tr>
    <td>AverageScore</td>
    <td><?php echo $row_DetailRS1['AverageScore']; ?></td>
  </tr>
  <tr>
    <td>OverallRemark</td>
    <td><?php echo $row_DetailRS1['OverallRemark']; ?></td>
  </tr>
</table>
</body>
</html><?php
mysql_free_result($DetailRS1);
?>