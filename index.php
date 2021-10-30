<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
    
<head>
    <meta charset="utf-8">
    <title>Drogaria</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            background-image: url(images/fundoIndex.jpg) !important;
        }
        .user_card {
            height: 400px;
            width: 350px;
            margin-top: auto;
            margin-bottom: auto;
            background: #60a3bc;
            position: relative;
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 5px;

        }
        .brand_logo_container {
            position: absolute;
            height: 170px;
            width: 190px;
            top: -75px;
            border-radius: 50%;
            text-align: center;
        }
        
        .form_container {
            margin-top: 150px;
        }
        .login_btn {
            width: 100%;
            background: rgb(243, 0, 8) !important;
            color: white !important;
        }
        
        
        .input-group-text {
            background: rgb(243, 0, 8) !important;
            color: white !important;
            border: 0 !important;
            border-radius: 0.25rem 0 0 0.25rem !important;
        }
        .input_user,
        .input_pass:focus {
            box-shadow: none !important;
        }
    </style>
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="images/logo.png">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">

                    <form method="post" action="login.php">
                        <?php
                        if(isset($_SESSION['nao_autenticado'])):
                        ?>
                        <p style="background-color: rgb(243, 0, 8);padding: 20px;border-radius: 10px;color: #fff;font-weight: bold;">ERRO: Usuário ou senha inválidos.</p>
                        <?php
                        session_destroy();
                        endif;
                        unset($_SESSION['nao_autenticado']);
                        ?>
                        <div class="input-group mb-3">
                            <div class="input-group-append"  style="width: 16%;">
                                <span style="height: 100%;" class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="usuario" class="form-control input_user" value="" placeholder="Usuário">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append" style="width: 16%;">
                                <span style="height: 100%;" class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="senha" class="form-control input_pass" value="" placeholder="Senha">
                        </div>
                            <div class="d-flex justify-content-center mt-3 login_container">
                                <button type="submit" name="button" class="btn login_btn">Entrar</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/86de526b39.js" crossorigin="anonymous"></script>
</body>
</html>
