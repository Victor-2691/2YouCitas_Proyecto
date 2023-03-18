<?php

function datos_usuario($id_cliente,$value) {

	require "db.php";

	$id_cliente = $db->real_escape_string($id_cliente);
	$value = $db->real_escape_string($value);

	$datosZ = $db->query("SELECT * FROM Clientes_Externos WHERE id_cliente = $id_cliente");
	$rowZ = $datosZ->fetch_array();

	echo $rowZ[$value];

}

?>