<?php
//funcoes internas
function hexTobin($data)
{
    return pack("H".strlen($data),$data);
}
function inverterhex($data)
	{
	$tamanho=strlen($data);
	if(($tamanho % 2)!=0)
		{
		$data="0".$data;
		}
	$data=wordwrap($data, 2, "/", true);
	$explode=explode("/", $data);
	$a=0;
	for($i=(count($explode)-1);$i>=0;$i--)
		{
		$join[$a]=$explode[$i];$a++;
	}
	$data=implode("", $join);return $data;
	}
function num($data){return hexdec(inverterhex($data));}	
function num2hex($data){return inverterhex(dechex($data));}
function abrirconta($login){
	$ini=substr($login,0,1);
	if(is_numeric($ini)){$ini="etc";}
	$path= "C:/Users/jucemar/Documents/NewNordicServer/DBSRV/run/account";
	$conta=$path."/".$ini."/".$login;
	if(file_exists($conta)){
	$open=@fopen($conta,"r");
	$leitura=@fread($open, filesize($conta));		  
   return trim(strtoupper(bin2hex($leitura)));
	}else{return 0;}
	}
function salvarconta($login, $data){
	$ini=substr($login,0,1);
	if(is_numeric($ini)){$ini="etc";}
	$path= "C:/Users/jucemar/Documents/NewNordicServer/DBSRV/run/account";
	$conta=$path."/".$ini."/".$login;
	if(strlen(hexTobin($data))==4292){
	$open=@fopen($conta,"w");
	fwrite($open, hexTobin($data));
	fclose($open);	
	return 1;
	}  else{
		return 0;
		echo "Erro de gravacao, contate a administracao. Falha ao gravar a conta.";}
	}
?>
