<?php include('header.php'); ?>


<div class="container h-100 below-nav">
    <div class="row justify-content-center align-items-center vertical-center">
        <div class="col-sm-12">
            <div class="alert alert-danger text-center">
                <h2>
                    <strong>
                    <?php
                        if ($_GET["error"]) {
                            echo $_GET["error"];
                        } else {
                            echo "Erro desconhecido. Contacte o Administrador do site!";
                        }
                        ?>
                    </strong>
                </h2>
            </div>
        </div>
    </div>
</div>


<?php include('footer.php'); ?>