<?php

header('Content-Type: text/html; charset=utf-8');



?>

<!DOCTYPE html>
<html>

    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="description" content="Tela de login">
        <meta name="keywords" content="">
        <meta name="author" content="SAD Soluções Web">
        <link rel="stylesheet" type="text/css" href="estilos.css">
    </head>

    <body>
         <h1> Login </h1>
        <form method="POST" action="..\controller\login_control.php">
            <table id="tarefas" cellspacing="10">
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="email" Placeholder="seu email">
                    </td>
                    <tr>
                        <td>Senha:</td>
                        <td>
                            <input type="password" name="senha" Placeholder="sua senha">
                        </td>
                    </tr>
                    <tr>
                    <td>
                        <input type="submit" name="Enviar" value="Entrar">
                    </td>

                    <td>
                        <input type="reset" name="limpar" value="Cancelar">
                    </td>

                </tr>

            </table>
        </form>
        <br />
        <div> <a href="cadastra_usuario.php">Cadastre-se</a></div>
    </body>

</html>