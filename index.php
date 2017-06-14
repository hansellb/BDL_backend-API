<?php
header('Content-Type: application/json; charset=utf-8');

$databasehost = "localhost";
$databasename = "bdl";
$databaseusername ="bdl";
$databasepassword = "bdl";

$con = mysqli_connect($databasehost,$databaseusername,$databasepassword, $databasename) or die(mysqli_error($con));
mysqli_set_charset ($con , "utf8");
//$query = file_get_contents("php://input");
$query = "SELECT businesses.*, contact_info.*, coordinates.* FROM businesses LEFT JOIN contact_info ON businesses.id=contact_info.id LEFT JOIN coordinates ON businesses.id=coordinates.id";
$sth = mysqli_query($con, $query);

if (mysqli_errno($con)) {
   header("HTTP/1.1 500 Internal Server Error");
   echo $query.'\n';
   echo mysqli_error($con);
}
else
{
   $rows = array();
   while($r = mysqli_fetch_assoc($sth)) {
     $rows[] = $r;
   }
   $res = json_encode($rows, JSON_UNESCAPED_UNICODE);
    echo($res);
    mysqli_free_result($sth);
}
mysqli_close($con);
?>