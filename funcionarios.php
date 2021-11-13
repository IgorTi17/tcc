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
        .btn-warning{
            background-color: yellow !important;
            border: 1px solid #000000;
            font-weight: bold;
            border-radius: 10px;
        }
        .btn-danger{
            background-color: red !important;
            border: 1px solid #000000;
            font-weight: bold;
            border-radius: 10px;
        }
        .btn-success{
            border: 1px solid #000000;
            font-weight: bold;
            border-radius: 10px;
        }

        .btn-danger:hover, .btn-warning:hover, .btn-success:hover{
            border: 1px solid #fff;
        }
        .status-ativo i{
            background-color: #198754;
            color: lightgrey;;
            border-radius: 50%;
            padding: 1rem;
        }
        .status-inativo i{
            background-color: red;
            color: lightgrey;;
            border-radius: 50%;
            padding: 1rem;
        }

       @media screen and (max-width: 600px){
	        .perfis{
	            width: 48%;
	        }
        }
</style>


<div style='padding: 10px 10%; display: flex;flex-wrap: wrap;'>
    <?php 
        $queryFunc = mysqli_query($conexao, "SELECT * FROM usuario WHERE status = 'ativo' AND id_usuario != '".$_SESSION['userid']."'");
        while ($resultFunc = mysqli_fetch_array($queryFunc)){
    ?>
	<div class='perfis'>
        <span class="status-<?= $resultFunc['status'] ?>"><i class='fas fa-user-circle'></i></span>
        <p>Nome: <?= $resultFunc['usuario'] ?></p>
        <p>Cargo: <?= $resultFunc['acesso'] ?></p>
        <div style="display: flex; flex-direction: column; align-items: center;">
            <a style="margin: 0.5rem 0; margin-bottom: 0;" href='editarFuncionario.php?ef=<?= $resultFunc['id_usuario'] ?>'><button class="btn btn-warning">EDITAR</strong> <i class='fas fa-user-edit'></i></button></a> 
            <button style="margin: 0.5rem 0;" onclick="inativar(<?= $resultFunc['id_usuario'] ?>)" class="btn btn-danger">INATIVAR</strong> <i class="fas fa-ban"></i></button>
        </div>   
    </div>
<?php } ?>
</div>

<div style='padding: 10px 10%; display: flex;flex-wrap: wrap;'>
    <?php 
        $queryFunc = mysqli_query($conexao, "SELECT * FROM usuario WHERE status = 'inativo' AND id_usuario != '".$_SESSION['userid']."'");
        while ($resultFunc = mysqli_fetch_array($queryFunc)){
    ?>
    <div class='perfis'>
        <span class="status-<?= $resultFunc['status'] ?>"><i class='fas fa-user-circle'></i></span>
        <p>Nome: <?= $resultFunc['usuario'] ?></p>
        <p>Cargo: <?= $resultFunc['acesso'] ?></p>
        <div style="display: flex; flex-direction: column; align-items: center;">
            <a style="margin: 0.5rem 0; margin-bottom: 0;" href='editarFuncionario.php?ef=<?= $resultFunc['id_usuario'] ?>'><button class="btn btn-warning">EDITAR</strong> <i class='fas fa-user-edit'></i></button></a> 
            <button style="margin: 0.5rem 0;" onclick="ativar(<?= $resultFunc['id_usuario'] ?>)" class="btn btn-success">ATIVAR</strong> <i class="far fa-check-circle"></i></button>
        </div>   
    </div>
<?php } ?>
</div>

<?php
include ('includes/footer.php');
?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
<script src="js/bootstrap.min.js"></script>

<script>
    function inativar(id) {
        $.ajax({
            url: 'includes/ajax/userStatus.php',
            data: {
                'inativar': id
            },
            type: 'POST',
            success: function(data) {
                if(data == 1){
                    $(location).attr('href', 'funcionarios.php?msg=inativado');
                }
            }
        });
    }

    function ativar(id) {
        $.ajax({
            url: 'includes/ajax/userStatus.php',
            data: {
                'ativar': id
            },
            type: 'POST',
            success: function(data) {
                if(data == 1){
                    $(location).attr('href', 'funcionarios.php?msg=ativado');
                }
            }
        });
    }

    <?php
    if (isset($_REQUEST['msg']) && $_REQUEST['msg'] == 'inativado') { ?>
        jQuery(document).ready(function() {
            Snackbar.show({
                text: 'Inativado com sucesso!',
                actionTextColor: '#fff',
                backgroundColor: '#163d54',
                pos: 'top-right',
                duration: 2000
            });
        });
    <?php } ?>

    <?php
    if (isset($_REQUEST['msg']) && $_REQUEST['msg'] == 'ativado') { ?>
        jQuery(document).ready(function() {
            Snackbar.show({
                text: 'Ativado com sucesso!',
                actionTextColor: '#fff',
                backgroundColor: '#163d54',
                pos: 'top-right',
                duration: 2000
            });
        });
    <?php } ?>
</script>