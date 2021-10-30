<?php 
include ('conexao.php');
session_start();
if ($_SESSION['cargo'] == "") {
    $_SESSION['nao_autenticado'] = true;
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">   
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <title>IG Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css" href="snackbar/snackbar.min.css">
    <script src="snackbar/snackbar.min.js"></script>
</head>

<body>
    <div class="app">
        <div class="menu-canto">
            <div class="profile">
                <span><i class="fas fa-user-circle"></i></span>
                <i style="text-transform: uppercase;"><?php echo $_SESSION['usuario'];?></i>
            </div>
            <?php
                // MENU DASHBOARD
                echo "<a href='home.php'><p><i class='fas fa-address-card'></i>Início</p></a>"; 
                if ($_SESSION['cargo'] == "atendente" || $_SESSION['cargo'] == "adm") {
                   echo "<a href='busca.php'><p><i class='fas fa-address-card'></i>Novo pedido</p></a>";
                }
                if ($_SESSION['cargo'] == "atendente" || $_SESSION['cargo'] == "adm" || $_SESSION['cargo'] == "estoquista") {
                   echo "<a href='medicamentos.php'><p><i class='fas fa-address-card'></i>Medicamentos</p></a>"; 
                }
                
                if ($_SESSION['cargo'] == "atendente" || $_SESSION['cargo'] == "adm"){
                    echo "<a href='clientes.php'><p><i class='fas fa-address-card'></i>Clientes</p></a>";
                }
                if ($_SESSION['cargo'] == "adm" || $_SESSION['cargo'] == "estoquista") { 
                    echo "<a href='fornecedores.php'><p><i class='fas fa-address-card'></i>Fornecedores</p></a>";
                }
            ?>
        </div>

        <div class="inferior">
            <div class="header">
                <div>
                    <p class="hamburguer"><i class="fas fa-bars"></i></p>
                    <p class="hamburguer hamburguerCel"><i class="fas fa-bars"></i></p>
                </div>
                <img src="images/logo.png" style="max-width: 3rem;">
                <a href="logout.php"><p><i class="fas fa-sign-out-alt"></i></i> SAIR</p></a>
            </div>

            <div class="conteudo">
                <div class="menu-cel">
                    <?php
                        // MENU DASHBOARD
                        echo "<a href='home.php'><p><i class='fas fa-address-card'></i>Início</p></a>"; 
                        if ($_SESSION['cargo'] == "atendente" || $_SESSION['cargo'] == "adm") {
                           echo "<a href='busca.php'><p><i class='fas fa-address-card'></i>Novo pedido</p></a>";
                        }
                        if ($_SESSION['cargo'] == "atendente" || $_SESSION['cargo'] == "adm" || $_SESSION['cargo'] == "estoquista") {
                           echo "<a href='medicamentos.php'><p><i class='fas fa-address-card'></i>Medicamentos</p></a>"; 
                        }
                        
                        if ($_SESSION['cargo'] == "atendente" || $_SESSION['cargo'] == "adm"){
                            echo "<a href='clientes.php'><p><i class='fas fa-address-card'></i>Clientes</p></a>";
                        }
                        if ($_SESSION['cargo'] == "adm" || $_SESSION['cargo'] == "estoquista") { 
                            echo "<a href='fornecedores.php'><p><i class='fas fa-address-card'></i>Fornecedores</p></a>";
                        }
                    ?>
                </div>
                    
                
            
