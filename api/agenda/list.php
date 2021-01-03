<?php
header("Content-Type: application/json");

include dirname(dirname(__FILE__)).'/db/Db.class.php';

$db = new Db();

$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 0;

$name = isset($_GET['name']) ? $_GET['name'] : '';

$sql_limit = '';
if (!empty($limit)) {
    $sql_limit = ' LIMIT 0,'.$limit;
}
$sql_name = "";
if (!empty($name)) {
    $sql_name = " WHERE agenda LIKE \"%" . $name . "%\" ";
}

$cat_list = $db->query("SELECT * FROM agenda " . $sql_name . " " . $sql_limit);

$arr = array();
$arr["info"] = 'success';
$arr['num'] = count($cat_list);
$arr['result'] = $cat_list;

echo json_encode($arr);
?>