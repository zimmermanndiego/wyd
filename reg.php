<?php

       require('dbaSis.php');

    if(isset($_POST['Submit2'])){
    $datas = array(
     "login" => $_POST['userid'], //NOME DA COLUNA e VALOR
     "senha" => $_POST['password'],
     "email" => $_POST['email'],
     "pergunta" => $_POST['pergunta'],
     "resposta" => $_POST['resposta'],
    );
    $Criar = create("contas",$datas);
    if($Criar){
     echo "<script>alert('Conta $userid foi criada com sucesso!');top.location.href='http://www.projetowyd.com.br/Cadastro.html'; </script>";
    }else{
     echo "<script>alert('Erro!');top.location.href='http://www.projetowyd.com.br/Cadastro.html'; </script>";
    }
   }



	$userid=trim($_POST['userid']);
  	$password=trim($_POST['password']);
 	$initial=substr($userid,0,1);
  	$userlenght=strlen($userid);
 	$passlenght=strlen($password);
 	$loc = "C:\\WYDServer\\DBSRV\\run\\account"; //Localização da Pasta Das Contas.

  if(!ereg("^[0-9a-zA-Z]{4,12}$",$userid))
  {echo "<script>alert('Seu login só pode ter caracteres: a-z,A-Z e no mínimo 4 letras.');top.location.href='http://www.projetowyd.com.br/Cadastro.html'; </script>";exit();}
  if(!ereg("^[0-9a-zA-Z]{4,12}$",$password))
  {echo "<script>alert('Sua senha só pode ter caracteres: a-z,A-Z');top.location.href='http://www.projetowyd.com.br/Cadastro.html'; </script>";exit();}
  if (ereg("^[a-zA-Z]$",$initial))
  {$initial=strtoupper($initial);}
  else
  {$initial="etc";}
  if(file_exists($loc ."/". $initial ."/". $userid))
  {
      echo "<script>alert('Conta já existente!');top.location.href='http://www.projetowyd.com.br/Cadastro.html'; </script>";
  }
  else
  {
      $f=@fopen("5900xt",r) or die("<script>alert('Nao foi possível criar a conta $userid.');top.location.href='http://www.projetowyd.com.br/Cadastro.html'; </script>");
      $acc=@fread($f,9999);
      $demoid=substr($acc,0,$userlenght);
      $demopass=substr($acc,16,$passlenght);
      $acc=str_replace($demoid,$userid,$acc);
      $acc=str_replace($demopass,$password,$acc); 
      $faf=@fopen($loc ."/". $initial ."/". $userid,'w');  
	  
      fwrite($faf,$acc) or die("<script>alert('Erro ao criar a conta $userid.');top.location.href='http://www.projetowyd.com.br/Cadastro.html'; </script>");
      @fclose($f);
      echo "<script>alert('Conta $userid foi criada com sucesso!');top.location.href='http://www.projetowyd.com.br/Cadastro.html'; </script>";
  }
?>
