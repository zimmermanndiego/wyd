<?php
//C:\\Wyd-Guns\\dbsrv\\run\\account//
  $accdir="C:\\WYDServer\\DBSRV\\run\\account";
  $userid=trim($_POST['userid']);
  $password=trim($_POST['password']);
  $newpass=trim($_POST['newpass']);
  $initial=substr($userid,0,1);
  $userlenght=strlen($userid);
  $passlenght=strlen($password);
  $newpasslenght=strlen($newpass);
  
  if(!ereg("^[0-9a-zA-Z]{4,12}$",$userid))
  {echo "<script>alert('O seu ID de Usuário deve conter caractéres de a-z, A-Z, 0-9 e de 4 a 10 dígitos.');top.location.href='http://www.projetowyd.com.br/TrocarSenha.html'; </script>";exit();}
  if(!ereg("^[0-9a-zA-Z]{4,12}$",$password))
  {echo "<script>alert('A sua SENHA ATUAL deve conter caractéres de a-z, A-Z, 0-9 e de 4 a 10 dígitos.');top.location.href='http://www.projetowyd.com.br/TrocarSenha.html'; </script>";exit();}
  if(!ereg("^[0-9a-zA-Z]{4,12}$",$newpass))
  {echo "<script>alert('A sua NOVA SENHA deve conter caractéres de a-z, A-Z, 0-9 e de 4 a 10 dígitos.');top.location.href='http://www.projetowyd.com.br/TrocarSenha.html'; </script>";exit();}
  if (ereg("^[a-zA-Z]$",$initial))
  {$initial=strtoupper($initial);}
  else
  {$initial="etc";}
  if(!file_exists($accdir."\\".$initial."\\".$userid))
  {
      echo "<script>alert('Ocorreu um ERRO na alteração da senha.');top.location.href='TrocarSenha.html'; </script>";
  }
  else
  {
      $f=@fopen($accdir."\\".$initial."\\".$userid,r) or die("<script>alert('Falha ao alterar!');top.location.href='http://www.projetowyd.com.br/TrocarSenha.html'; </script>");
      $acc = @fread($f,9999);
      $oldpass=substr($acc,16,16);
	  $empty=substr($acc,32,15-$newpasslenght);
	  if(strcmp(trim($oldpass), $password)==0)
	  { 
      $acc = substr_replace($acc,$newpass,16, $newpasslenght); 
	  $acc = substr_replace($acc, $empty, 16+$newpasslenght, 15-$newpasslenght);
      $f2=@fopen($accdir."\\".$initial."\\".$userid,w);
      @fwrite($f2,$acc) or die("Fails when modifying!");
      @fclose($f);
      echo "<script>alert('Sua senha foi alterada com sucesso.');top.location.href='http://www.projetowyd.com.br/TrocarSenha.html'; </script>";
      exit();
	  }
	  else
	  {echo "<script>alert('A senha que você colocou não confere à sua senha atual.');top.location.href='http://www.projetowyd.com.br/TrocarSenha.html'; </script>";exit();}
  }

?>
