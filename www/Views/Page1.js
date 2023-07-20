import { BrowserLink } from "../components/BrowserRouter.js";
import { handleConfirmPage } from "../Pages.js";
import { BrowserEvent } from "../components/BrowserRouter.js";


export default function Page1() {

  const DATA_KEY = "data";
  let data = localStorage.getItem(DATA_KEY);
  if (!data) {
    data = {};
  } else {
    data = JSON.parse(data);
  }

  const formFields = [
    { type: 'text', name: 'siteName', label: 'Nom du site', defaultValue: 'siteName' },
    { type: 'text', name: 'firstname', label: 'Prénom du modérateur', defaultValue: 'John' },
    { type: 'text', name: 'lastname', label: 'Nom de l\'admin', defaultValue: 'Doe' },
    { type: 'text', name: 'pseudo', label: 'Pseudo de l\'admin', defaultValue: 'john_doe' },
    { type: 'text', name: 'birthDate', label: 'Date de naissance de l\'admin', defaultValue: '01/01/1990' },
    { type: 'email', name: 'email', label: 'Email de l\'admin', defaultValue: 'example@example.com' },
    { type: 'number', name: 'phone', label: 'Téléphone de l\'admin', defaultValue: '0123456789' },
    { type: 'text', name: 'country', label: 'Pays de l\'admin', defaultValue: 'FR', readonly: true },
    { type: 'number', name: 'zipCode', label: 'Code postal de l\'admin', defaultValue: '12345' },
    { type: 'text', name: 'address', label: 'Adresse de l\'admin', defaultValue: '123 Rue Principale' },
  ];

  return {
    type: "form",
    children: [
      {
        type: "h2",
        children: ['Bienvenue sur le formulaire de création de site !'],
      },
      {
        type: "div",
        children: formFields.map(field => ({
          type: "label",
          children: [
            {
              type: "input",
              attributes: {
                type: field.type,
                name: field.name,
                value: data[field.name] ?? field.defaultValue,
              },
            },
          ],
        })),
      },
      {
        type: "button",
        attributes: {
          type: 'submit',
        },
        children: ['Envoyer'],
      },
    ],
    events: {
      submit: function (event) {
        event.preventDefault();
        
        formFields.forEach(field => {
          data[field.name] = event.target.elements[field.name].value;
        });
        
        localStorage.setItem(DATA_KEY, JSON.stringify(data));
        BrowserEvent('/page2');          
      },
    },
  };
}
