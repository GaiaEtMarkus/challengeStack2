<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">tournamount</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <?php if (!isset($_SESSION['userData'])):?>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/userCreateProfile">Créer un profil</a>
                </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['userData'])):
                    if ($_SESSION['userData']['id_role'] == 3): ?>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/userInterface">Interface user</a>
                </li>
                <?php endif; ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['userData'])):?>
                <?php if($_SESSION['userData']['id_role'] !== 1):?>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/contact">Contact</a>
                </li>
                <?php endif; ?>
                <?php endif; ?>
                <?php if (!isset($_SESSION['userData'])):?>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/forgotpassword">Mot de passe oublié</a>
                </li>
                <?php endif; ?>
                <?php if (!isset($_SESSION['userData'])): ?>
                <li class="nav-item">
                <a class="nav-link text-danger" href="/login">Se connecter</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                <a class="nav-link text-danger" href="/deconnexion">Se deconnecter</a>
                </li>
                <?php endif; ?>              
                <?php if (isset($_SESSION['userData'])):
                        if ($_SESSION['userData']['id_role'] == 2): ?>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/moderatorInterface">Interface moderator</a>
                </li>
                <?php endif; ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['userData'])):
                        if ($_SESSION['userData']['id_role'] == 1): ?>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/adminInterface">Interface admin</a>
                </li>
                <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
