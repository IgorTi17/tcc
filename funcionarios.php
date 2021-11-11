<?php 
include ('includes/dashboard.php');
?>
<style>
        .perfis{
            margin: 1%;
            background-color: lightgrey;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 30%;
            border-radius: 10px;
        }
        .perfis p{
            text-transform: uppercase;
            font-weight: 700;
            margin: 0;
            padding: 0;
            text-align: center;
         }

        .perfis span:nth-child(1){
            font-size: 5rem;
        }

        .perfis a{
            margin: 1rem 0;
            text-decoration: none;
        }

        .span4{
            background-color: yellow;
            padding: 0.5rem;
            border-radius: 10px;
            font-size: 14px !important;
            color: #000000;
        }
       @media screen and (max-width: 600px){
	        .perfis{
	            width: 48%;
	        }
        }
</style>

<div style='padding: 10px 10%; display: flex;flex-wrap: wrap;'>
    <?php 
        $queryFunc = mysqli_query($conexao, "SELECT * FROM usuario WHERE id_usuario != '".$_SESSION['userid']."'");
        while ($resultFunc = mysqli_fetch_array($queryFunc)){
    ?>
	<div class='perfis'>
        <span><i class='fas fa-user-circle'></i></span>
        <p>Nome: <?= $resultFunc['usuario'] ?></p>
        <p>Cargo: <?= $resultFunc['acesso'] ?></p>
        <a href=''><span class='span4'><strong>EDITAR</strong> <i class='fas fa-user-edit'></i></span></a>
    </div>
<?php } ?>
</div>

<?php
include ('includes/footer.php');
?>
