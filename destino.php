<?php
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );

    include "conexao.php"; 
	
	$origem = $_REQUEST['origem'];

	$destino = array();
	
	$sql = mysqli_query($connect,"SELECT id, origem, destino FROM tabela WHERE origem = $origem ORDER BY destino ASC");
	while($ln = mysqli_fetch_object($sql)):
      	$destino[] = array(
			'id'	    => $ln->destino,
			'destino'   => $ln->destino,
		);
	   endwhile;
	   
	echo( json_encode( $destino ) );