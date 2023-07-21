<?php
namespace App\Controllers;
use App\Models\Comment;
use App\Core\Security;

class CommentController{

    public function createComment(){

        if ($_SESSION['userData']['id_role'] == 3) {

        $userId = ['id'];
        $userPseudo = ['pseudo'];
        $userComment = Security::securiser($_POST['commentContent']);
        $comment = new Comment();
        $targetUserId = Security::securiser(intval($_POST['userId']));
        $is_signaled = false;

        if(isset($_POST['productId'])){
            $productId = Security::securiser(intval($_POST['productId']));
            $comment->hydrate(null, $userPseudo, $userComment, $userId, 0, $productId, $is_signaled);
        }
        else {
            $comment->hydrate(null, $userPseudo, $userComment, $userId, $targetUserId, 0 , $is_signaled);
        }
        $comment->save();
        $message = "Votre commentaire a bien été ajouté !";
        header('Location: /userinterface?message=' . urlencode($message)); 
        } else {
            header('Location: /error404');
        } 
    }

    public function deleteComment(): void
    {
        if (isset($_SESSION['userData'])) {
            $idComment = Security::securiser($_POST['idComment']);
            $comment = new Comment();

            if($_SESSION['userData']['id_role'] == 2){

                $comment->delete($idComment);
                $message = "Le commentaire a été supprimé avec succès.";
                header('Location: /moderatorInterface?message=' . urlencode($message));
            }

        } else {
            header('Location: /error404');
        }
    }
}