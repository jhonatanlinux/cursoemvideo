<?php
    require_once 'classes/usuarios.php';
    $u = new usuario;
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Documentação Querys</title>
        <link rel="stylesheet" href="estilos.css">
    </head>

    <body>
        <div id="corpo_form">
            <h1>Cadastrar</h1>
                <form method="POST">
                    <input type="text" name="nome" placeholder="Nome Completo" maxlenght="100">
                    <input type="email" name="email" placeholder="Email" maxlenght="30">
                    <input type="usuario" name="usuario" placeholder="Usuário" maxlenght="30">
                    <input type="passwd" name="senha" placeholder="Senha" maxlenght="30">
                    <input type="passwd" name="confsenha" placeholder="Confirmar Senha" maxlenght="30">
                    <input type="submit" value="SALVAR">
            </form>
        </div>
        <?php
        //verificar se clicou no botao
        if(isset($_POST['nome'])){
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $usuario = addslashes($_POST['usuario']);
            $senha = addslashes($_POST['senha']);
            $confsenha = addslashes($_POST['confsenha']);
            //verificar se esta preenchido
                if(!empty($nome) && !empty($email) && !empty($usuario) && !empty($senha) && !empty($confsenha));
                {
                    $u->conectar("projeto","localhost","root","");
                    if($u->msgErro == "") //se esta tudo certo
                    {
                        if($senha == $confsenha){
                            if($u->cadastrar($nome,$email,$usuario,$senha)){
                                echo "Cadastrado com sucesso!";
                            }else{
                                echo "Email já cadastrado.";
                            }
                        }else {
                            echo "Senhas não correspondem!";
                        }
                    //else {
                    //    echo "Erro: ".$u->msgErro;
                    //}
                    else {
                        echo "Preencha todos os campos!";
                }
            }
        }
        ?>
    </body>
</html>