<!DOCTYPE html>
<div class="container">

    <h2>Formulaire User</h2>

    <?php 
    print_r($errors??null);
    ?>

    <?php $this->form("form", $form, $isModifyForm);?>