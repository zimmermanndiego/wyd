<?php
/*
Logica Guild Marck:

b030(00000+$guildid).bmp
b030(00000+$guildid).bmp
*/
        $guildid = $_POST['guildid'];

        $img = ".guilds/img_guilds/b0".(3000000+$guildid).".bmp";

        if (isset($_FILES['arquivo']['name']))
        {
                $uploaddir = '.\\guilds\\img_guilds\\';

                $arquivo = $uploaddir."b0".(3000000+$guildid).".bmp";

                $dimensao = getimagesize($_FILES['arquivo']['tmp_name']);
                if($_FILES['arquivo']["type"] == "image/bmp")
                {
                        if(($dimensao[0] <= 16) && ($dimensao[1] <= 12))
                        {
                                if($_FILES['arquivo']["size"] <= 2000)
                                {
                                        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $arquivo))
                                        {
                                                copy($arquivo,$uploaddir."b0".(2000000+$guildid).".bmp");
                                                copy($arquivo,$uploaddir."b0".(1000000+$guildid).".bmp");
                                                echo "<script>alert('O arquivo foi enviado com sucesso!');top.location.href='EnviarGuildMark.php'; </script>";
                                                $img = "img_guilds/b0".(3000000+$guildid).".bmp";
                                        }
                                        else
                                        {
                                                echo "<script>alert('Error: O arquivo não foi enviado.');top.location.href='EnviarGuildMark.php'; </script>";
                                        }
                                }
                                else
                                {
                                        echo "<script>alert('Error: Imagem muito pesada.');top.location.href='EnviarGuildMark.php'; </script>";
                                }
                        }
                        else
                        {
                                echo "<script>alert('Error: Imagem muito grande.');top.location.href='EnviarGuildMark.php'; </script>";
                        }
                }
                else
                {
                        echo "<script>alert('Error: Formato de imagem inválido.');top.location.href='EnviarGuildMark.php'; </script>";
                }
        }
?>
