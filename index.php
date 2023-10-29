<?php 
    //inclui o arquivo de conexao, como se fizesse parte dessa página
    include('conexao.php');

    //se existir(isset) um email ou uma senha
    if (isset($_POST['email']) || isset($_POST['senha'])){
        //se o email ou a senha não forem preenchidos
        if (strlen($_POST['email']) == 0){
            echo "Preencha seu email";
        }else if(strlen($_POST['senha']) == 0){
            echo "Preencha sua senha";
        }else{
            //limpando os campos email e senha para evitar sql injection
            $email = $mysqli->real_escape_string($_POST['email']);
            $senha = $mysqli->real_escape_string($_POST['senha']);

            //selecionando o usuario que possui email e senha iguais aos digitados
            $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";

            //query == consulta, sql_query inicia uma consulta ao banco de dados com o sql_code digitado
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " .$mysqli->error);

            //retorna a qtdd de linhas retornadas pela consulta
            $quantidade = $sql_query->num_rows;

            if($quantidade == 1){
                //colocando os dados retornados em uma variavel usuario 
                $usuario = $sql_query->fetch_assoc();

                //se nao exitir uma sessao, uma nova é criada
                if (!isset($_SESSION)){
                    session_start();
                }

                //a sessao recebe o id do usuario, para mante-lo conectado
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];

                //redireciona para uma página inicial
                header("Location: painel.php");
            } else {
                //se nenhuma linha foi retornada, os dados do banco nao batem com os que foram digitados
                echo "Falha ao logar ! Email ou senha incorretos";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <!--Criação dos campos de email e senha-->
    <form action="" method="post">
        <h1>Acesse sua conta</h1>
        <p>
            <label>Email</label>
            <input type="text" name="email">
        </p>
        <p>
            <label>Senha</label>
            <input type="password" name="senha">
        </p>
        <p>
            <button type="submit">Entrar</button>
        </p>
    </form>
</body>
</html>