import { BrowserLink } from "../components/BrowserRouter.js";
import { BrowserEvent } from "../components/BrowserRouter.js";
import BrowserRouter from "../components/BrowserRouter.js";
import { handleSubmit } from "../Pages.js";

export default function Page2() {
  const DATA_KEY = "data";
  let data = localStorage.getItem(DATA_KEY);
  if (!data) {
    data = {};
  } else {
    data = JSON.parse(data);
  }

  const labels = {
    siteName: 'Nom du site',
    firstname: 'Prénom du modérateur',
    lastname: 'Nom de l\'admin',
    pseudo: 'Pseudo de l\'admin',
    birthDate: 'Date de naissance de l\'admin',
    email: 'Email de l\'admin',
    phone: 'Téléphone de l\'admin',
    country: 'Pays de l\'admin',
    zipCode: 'Code postal de l\'admin',
    address: 'Adresse de l\'admin',
  };

  const displayData = Object.entries(data).map(([key, value]) => ({
    type: "p",
    children: [
      `${labels[key]} (${key}) : ${value}`
    ]
  }));

  return {
    type: "div",
    children: [
      {
        type: "h2",
        children: ['Merci ! Vos données ont bien étés enregistrer. Veuillez bien les vérifier et les valider.'],
      },
      ...displayData,
      {
        type: "button",
        children: ['Resaissir mes données'],
        events: {
          click: function () {
            BrowserEvent('/page1'); 
          }
        },
      },
      {
        type: "button",
        children: ['Confirmer'],
        events: {
          click: function (event, displayData) {
            handleSubmit(event, displayData);
          }
          
        },
      },
      
    ],
    
  };
  
}
