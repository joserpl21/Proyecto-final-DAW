<?php
function sacarTipoEjercicio($nid){
//$tid=db_query("SELECT field_tipo_de_ejercicio_tid FROM field_data_field_tipo_de_ejercicio where entity_id=:id", array(':id'=>$nid))->fetchField();
//		$term=db_query("SELECT name FROM `taxonomy_term_data` where tid=:tid", array(':tid'=>$tid))->fetchField();	
	//	return $term;

$term=db_query("SELECT name FROM taxonomy_term_data as m inner join field_data_field_tipo_de_ejercicio as c on m.tid=c.field_tipo_de_ejercicio_tid where entity_id=:id",array(':id'=>$nid))->fetchField();
return $term;
}

function sacarTipoComida($nid){
//$tid=db_query("SELECT field_tipo_de_comida_tid FROM field_data_field_tipo_de_comida where entity_id=:id", array(':id'=>$nid))->fetchField();
//$term=db_query("SELECT name FROM `taxonomy_term_data` where tid=:tid", array(':tid'=>$tid))->fetchField();	
	
	$term=db_query("SELECT name FROM taxonomy_term_data as m inner join field_data_field_tipo_de_comida as c on m.tid=c.field_tipo_de_comida_tid where entity_id=:id",array(':id'=>$nid))->fetchField();
return $term;

		//return $term;
}
