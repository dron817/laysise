<?php
include('inc/simple_html_dom.php');
header('Content-Type: text/html; charset=utf-8');
echo "<style>body{background-color: #212121;}h1{color: #66bb6a; text-align: center; text-transform: uppercase}img{margin-left: 30%; box-shadow: #1e7e34 0px 0px 10px}</style>";
echo "<meta http-equiv='Refresh'  content='5' />";
error_reporting(ALL);
$servername = "a237567.mysql.mchost.ru";
$username = "a237567_ls";
$password = "f4ed43a3";
$dbname= "a237567_laysise";
$mysqli = new mysqli($servername, $username, $password, $dbname);
$mysqli->query("SET NAMES 'utf8'");
$query="SELECT COUNT(*) FROM words";
$result_set = $mysqli->query($query);
if (!$result_set) return false;
$i = 0;
$data=null;
while ($row = $result_set->fetch_assoc()) {
    $data[$i] = $row;
    $i++;
}
$result_set->close();
$r = rand ( 1 , $data[0]['COUNT(*)']);
$query="SELECT * FROM words LIMIT $r, 1;";
$result_set = $mysqli->query($query);
$i = 0;
$data=null;
while ($row = $result_set->fetch_assoc()) {
    $data[$i] = $row;
    $i++;
}
$result_set->close();
$q=($data[0][column_0]);
$r = rand ( 1 , 20);
echo '<h1>'.$q.' ('.$r.')</h1>';
$base = 'https://www.google.com/search?q='.$q.'&sxsrf=ALeKk02yydJwN-sQoogK8NdS8IyMVjsygw:1604946146395&source=lnms&tbm=isch&sa=X&ved=2ahUKEwiUxsGnivbsAhVklosKHUE4CfIQ_AUoAXoECA8QAw#imgrc=3h1xrmoMjT5JgM';
$html = file_get_html( $base );
//echo $html;
$html->find('img', $r)->width = '40%';
echo $html->find('img', $r);

