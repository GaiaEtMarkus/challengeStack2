<?php
namespace App\Controllers;

use App\Core\View;
use App\Forms\Initialisation;


class AdminController {

    public function adminInterface(): void 
    {
        $view = new View("Admin/adminInterface", "back");
    }

    public function configSite(): void 
    {
        $_SESSION['postData'] = json_decode(file_get_contents('php://input'), true);
        
        // Traiter les données et mettre à jour le fichier config.json
        $configFilePath = './config.json';
        file_put_contents($configFilePath, json_encode($_SESSION['postData']));
        
        // Envoyer une réponse JSON indiquant la mise à jour réussie
        $response = [
            'message' => 'Le fichier config.json a été mis à jour avec succès.',
            'data' => $_SESSION['postData']
        ];
            
        //implementer fontions

        header('Content-Type: application/json');

        echo json_encode($response);

    }

    public function createConfigFile(): void 
    {
        // Récupérer les données du tableau $_SESSION['postData']
        $configData = $_SESSION['postData'];
        var_dump($configData);
    
        // Vérifier si la clé 'initialized' est définie et a la valeur 'false' dans le fichier config.json existant
        $configFilePath = './config.json';
        // $existingConfigData = json_decode(file_get_contents($configFilePath), true);
        if (isset($configFilePath)) {
            // Générer le contenu du fichier config.json à partir des données
            $configContent = json_encode($configData, JSON_PRETTY_PRINT);
    
            // Créer le fichier config.json
            if (file_put_contents($configFilePath, $configContent) !== false) {
                // Le fichier config.json a été créé avec succès
                // Vous pouvez envoyer une réponse JSON appropriée si nécessaire
                echo json_encode(['message' => 'Le fichier config.json a été créé avec succès.']);
            } else {
                // Une erreur s'est produite lors de la création du fichier config.json
                // Vous pouvez envoyer une réponse JSON appropriée si nécessaire
                echo json_encode(['error' => 'Erreur lors de la création du fichier config.json.']);
            }
        } 
    }
}