const express = require('express');
const fs = require('fs');

const app = express();
app.use(express.json());

// Recevoir les données de la requête POST
app.post('/installer', (req, res) => {
  const data = req.body;

  // Écrire les données dans le fichier config.json
  const configData = JSON.stringify(data, null, 2); // Formater les données JSON avec une indentation de 2 espaces
  fs.writeFileSync('./config.json', configData);

  // Envoyer une réponse au client
  res.json({ message: 'Données enregistrées avec succès' });
});

// Démarrer le serveur
app.listen(3000, () => {
  console.log('Serveur démarré sur le port 3000');
});
