<?php
require('iniSis.php');

	$conn = mysql_connect(HOST, USER, PASS) or die ('Erro ao conectar: '.mysql_error());
	$dbsa = mysql_select_db(DBSA) or die ('Erro ao selecionar banco: '.mysql_error());
	
/*****************************
FUNÇÃO DE CADASTRO NO BANCO
*****************************/

	function create($tabela, array $datas){
		$fields = implode(", ",array_keys($datas));
		$values = "'".implode("', '",array_values($datas))."'";			
		$qrCreate = "INSERT INTO {$tabela} ($fields) VALUES ($values)";
		$stCreate = mysql_query($qrCreate) or die ('Erro ao cadastrar em '.$tabela.' '.mysql_error());
		
		if($stCreate){
			return true;
		}
	}
	
/*****************************
FUNÇÃO DE CADASTRO NO BANCO
*****************************/

	function read($tabela, $cond = NULL){		
		$qrRead = "SELECT * FROM {$tabela} {$cond}";
		$stRead = mysql_query($qrRead) or die ('Erro ao ler em '.$tabela.' '.mysql_error());
		$cField = mysql_num_fields($stRead);
		global $resultado;
		for($y = 0; $y < $cField; $y++){
			$names[$y] = mysql_field_name($stRead,$y);
		}
		for($x = 0; $res = mysql_fetch_assoc($stRead); $x++){
			for($i = 0; $i < $cField; $i++){
				$resultado[$x][$names[$i]] = $res[$names[$i]];
			}
		}
		
		return $resultado;
	}
	
/*****************************
FUNÇÃO DE EDIÇÃO NO BANCO
*****************************/	
	
	function update($tabela, array $datas, $where){
		foreach($datas as $fields => $values){
			$campos[] = "$fields = '$values'";
		}
		
		$campos = implode(", ",$campos);
		$qrUpdate = "UPDATE {$tabela} SET $campos WHERE {$where}";
		$stUpdate = mysql_query($qrUpdate) or die ('Erro ao atualizar em '.$tabela.' '.mysql_error());

		if($stUpdate){
			return true;	
		}
		
	}
	
/*****************************
FUNÇÃO DE DELETAR NO BANCO
*****************************/

	function delete($tabela, $where){
		$qrDelete = "DELETE FROM {$tabela} WHERE {$where}";
		$stDelete = mysql_query($qrDelete) or die ('Erro ao deletar em '.$tabela.' '.mysql_error());
	}
?>
