<div class="container col-12 d-flex align-center justify-content-center">
    <div class="row">
        <div class="vw-100">
            <h1 class="text-center mb-1">Bienvenue dans votre interface !</h1>

            <div class="container col-12 d-flex align-center justify-content-center">    
    <?php 
    include 'displayStats.php'; 
    ?>
    </div>

    <div class="col-12 flex-wrap d-flex justify-content-between align-items-center">
        <button type="button" class="btn btn-primary col-3 m-3" onclick="window.location.href='/createProduct'">
        Créer un produit
        </button>
        <?php 
        include 'displayProductsUser.php'; 
        include 'displayProducts.php'; 
        include 'displayTransactionsUser.php'; 
        include 'paramsUser.php'; 
        ?>
    </div>
        </div>
        </div>
    </div>
</div>
