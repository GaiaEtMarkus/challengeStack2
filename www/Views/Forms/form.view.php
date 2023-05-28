<!DOCTYPE html>
<div class="container">

    <h2>Formulaire User</h2>

    <?php 
    var_dump($_POST);
    print_r($errors??null);
    ?>

    <?php $this->form("form", $form );?>