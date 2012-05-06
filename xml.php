<?php
header("Content-type: text/xml");


include 'includes/MDB.php';
include 'includes/Util.php';
include 'includes/session.php';
include 'includes/controlAcceso.php';
include 'includes/listados.php';


$db=new MDB();
$data=listadoEmpleadosBaja($db);

$db->close();


echo '<?xml version="1.0" encoding="utf-8"?>';
echo '<empleados>';
foreach ($data as $empleado) {
    echo '<empleado>';
    foreach ($empleado as $key => $value) {
        $mark=str_replace(" ", "", trim($key));
        echo "<$mark>$value</$mark>";
    }
    echo '</empleado>';
}
echo '</empleados>';
?>