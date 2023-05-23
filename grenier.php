<?php

// Methods
    // public function createUser(User $user) {
    // {
    //     try {
    //         $requete = Sql::getInstance()->prepare("insert into user(firstname, lastname, country, email, phone, birth_date, thumbnail, password) 
    //         values(:firstname, :lastname, :country, :email, :phone, :birth_date, :thumbnail, :password);");

    //         $requete->bindValue(":firstname", $user->getFirstName());
    //         $requete->bindValue(":lastname", $user->getLastname());
    //         $requete->bindValue(":country", $user->getCountry());
    //         $requete->bindValue(":email", $user->getEmail());
    //         $requete->bindValue(":phone", $user->getPhone());
    //         $requete->bindValue(":birth_date", $user->getBirthDate());
    //         $requete->bindValue(":thumbnail", $user->getThumbnail());
    //         $requete->bindValue(":password", $user->getPassword());
    //         $nb = $requete->execute();

    //         return $nb;
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //     }
    // }
    // }



    // public function userValidProfile(){

    //     $newUser = new User();
    //     $name = filter_var(Verificator::securiser($_POST["firstname"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     $surname = filter_var(Verificator::securiser($_POST["surname"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     $email = filter_var(Verificator::securiser($_POST["email"]), FILTER_SANITIZE_EMAIL);
    //     $phone = filter_var(Verificator::securiser($_POST["phone"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     $country = filter_var(Verificator::securiser($_POST["country"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     $birth_date = filter_var(Verificator::securiser($_POST["birth_date"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     $thumbnail = filter_var(Verificator::securiser($_POST["thumbnail"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     $pwd = filter_var(Verificator::securiser($_POST["pwd"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     $confirmPwd = filter_var(Verificator::securiser($_POST["confirmPwd"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     $vip = false;


    //     if ( $pwd == $confirmPwd)  {

    //         $newUser->hydrate($name, $surname, $email, $phone, $birth_date, $thumbnail, $pwd, $country, $vip);
    //         $newUser->createUser($newUser);
    //         echo "Votre compte a bien été créé";

    //     } else {

    //         echo "Les mots de passe ne correspondent pas";
    //     }

    //     $view = new View("User/userInterface", "front");
    // }