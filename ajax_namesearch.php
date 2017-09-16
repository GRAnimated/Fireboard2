<?php
$a[] = $rUsers;

$rUsers = Query("select * from {users} where ".$where." name asc limit {0u},{1u}" "%{$query}%");
$q = $_REQUEST["q"];

switch($sort) {
		case "name": $order = "name ".(isset($dir) ? $dir : "asc"); break;
}
$where.= " and (name like {3} or displayname like {3})";
$order = "";

$hint = "";

if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

echo $hint === "" ? "No users found." : $hint;
?>