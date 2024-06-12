<?php
$host = "localhost";
$user = "root";
$pass = "";
$banco = "wydserv";or die(mysql_error());
mysql_select_db($banco) or die(mysql_error());
$conexao = mysql_connect($host, $user, $pass)
?>

<?php

if(isset($_POST["userid"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["pergunta"]) && isset($_POST["resposta"]) && isset($_POST["data"]))
{
	$login = trim($_POST["userid"]);
    $senha = trim($_POST["password"]);
    $email = trim($_POST["email"]);
    $pergunta = trim($_POST["pergunta"]);
    $resposta = trim($_POST["resposta"]);
    $data = trim($_POST["data"]);
	
    $sql = mysql_query("INSERT INTO contas( login, senha, email, pergunta, resposta, data) VALUES ('$login', '$senha', '$email', '$pergunta', '$resposta', '$data')");
	

    if(!$sql)
	{
		echo ("ocorreu um erro ao salvar seus dados" . mysql_error());
    }
    else
	{
		echo ("Dados Salvos com Sucesso");
    }
}

?>
