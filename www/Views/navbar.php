<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">tournamount</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/userCreateProfile">Créer un profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/userProfile">Profil user</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/userInterface">Interface user</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/contact">Contact</a>
                </li>
                <?php if (!isset($_SESSION['userData'])): ?>
                <li class="nav-item">
                <a class="nav-link text-danger" href="/login">Se connecter</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                <a class="nav-link text-danger" href="/deconnexion">Se deconnecter</a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/usermodifyprofile">Modifier ses infos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/userdeleteprofile">Supprimer son profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/createproduct">Créer un produit</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
