<?php
session_start();

$_SESSION['postData'] = json_decode(file_get_contents('php://input'), true);

$configFilePath = './config.json';

if (isset($configFilePath)) {

// Traiter les données et mettre à jour le fichier config.json
$configFilePath = './config.json';
file_put_contents($configFilePath, json_encode($_SESSION['postData']));

// Envoyer une réponse JSON indiquant la mise à jour réussie
$response = [
    'message' => 'Le fichier config.json a été mis à jour avec succès.',
];

header('Content-Type: application/json');
// echo json_encode($response);
} else {
    echo json_encode(['error' => 'Erreur lors de la création du fichier config.json.']);
}
?>
