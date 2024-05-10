<?php
session_start();

if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['usuario_nome'])) {
    header("Location: Login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sair'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: Login.php"); 
    exit();
}
?>

<?php include("Cabecalho.php");?>

<div class="container">
    <h2>Você deseja sair?</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="col-12">
            <input class="btn btn-primary" type="submit" value="Sair" name="sair"/>
        </div>
    </form>
</div>

<?php include("Rodape.php");?>