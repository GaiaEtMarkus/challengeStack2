<!DOCTYPE html>
<div class="container">

    <h2>Se login</h2>

    <?php 
    var_dump($_POST);
    print_r($errors??null);
?>

    <?php $this->form("userLogin", $form );?>