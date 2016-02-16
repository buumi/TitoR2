<?php
/**
 * Created by PhpStorm.
 * User: jkankaanpaa
 * Date: 2/11/16
 * Time: 3:19 PM
 */

$id = $_GET["id"];

$db = new mysqli("localhost", "np1172_r2", "R2tito5000", "np1172_r2");

if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}

$temp_array = array();

$query = "SELECT * FROM varaus WHERE opettaja_idopettaja = $id OR opiskelija_idopiskelija = $id";
$result = $db->query($query);

while ($value = $result->fetch_assoc()) {
    $entry = array("id"=>"$value[id]", "start"=>$value[start], "end"=>$value[stop], "title"=>$value[title]);
    array_push($temp_array, $entry);
}

$query = "SELECT * FROM vapaa WHERE opettaja_idopettaja = $id";
$result = $db->query($query);

while ($value = $result->fetch_assoc()) {
    $entry = array("id"=>$value[id], "start"=>$value[start], "end"=>$value[stop], "rendering"=>"background");
    array_push($temp_array, $entry);
}

echo json_encode($temp_array);
