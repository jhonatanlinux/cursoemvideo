<?php

class usuario{
    private $pdo;
    public $msgErro = "";
    public function conectar($nome, $host, $usuario, $senha)
{
    global $pdo;
    global $msgErro;
    try {
        $pdo = new PDO("mysql:dbane=".$name.";host=".$host,$usuario,$senha);
    } catch (PDOException $e) {
        $msgErro = $e->getMessage();
    }
    
}
    public function cadastrar($nome, $telefone, $email, $senha)
{
    global $pdo;
    global $msgErro;
    //Verificar se ja existe email cadastrado
    $sql = $pdo->prepare("SELECT id FROM public.cadastros WHERE email= :e");
    $sql->bindValue(":e",$email);
    $sql->execute();
    if($sql->rowCount() > 0)
    {
        return false; //ja cadastrado
    }
    else{
        //caso nao, cadastrar.
        $sql = $pdo->prepare("INSERT INTO public.cadastros(nome,usuario,senha,email) VALUES(:n,:u,:s,:e)");
        $sql->bindValue(":n",$nome);
        $sql->bindValue(":u",$usuario);
        $sql->bindValue(":s",md5$senha);
        $sql->bindValue(":e",$email);
        $sql->execute();
        return true; //tudo ok
    }
}
    public function logar($email, $senha)
{
    global $pdo;
    //verificar se o email e senha estao cadastrados, se sim
    $sql = $pdo->prepare("SELECT id FROM public.cadastros WHERE email = :e AND senha = :s");
    $sql->bindValue(":e",$email);
    $sql->bindValue(":s",md5$senha);
    $sql->execute();
    if($sql->rowCount() > 0){
        //entrar no sistema (sessao)
        $dado = $sql->fetch();
        session_start();
        $_SESSION['id'] = $dado['id']
        return true; //logado com sucesso
    }
    else{
        return false; //nao foi possivel logar
    }

    global $msgErro;
}
}
?>