import {FormValidator} from './module.js';
//  ######################################################################
//  ######################################################################
//  ######################################################################

const formFields = [
  { type: 'text', name: 'siteName', label: 'Nom du site', defaultValue: 'siteName' },
  { type: 'text', name: 'firstname', label: 'Prénom du modérateur', defaultValue: 'John' },
  { type: 'text', name: 'lastname', label: 'Nom de l\'admin', defaultValue: 'Doe' },
  { type: 'text', name: 'pseudo', label: 'Pseudo de l\'admin', defaultValue: 'john_doe' },
  { type: 'text', name: 'birthDate', label: 'Date de naissance de l\'admin', defaultValue: '01/01/1990' },
  { type: 'email', name: 'email', label: 'Email de l\'admin', defaultValue: 'example@example.com' },
  { type: 'number', name: 'phone', label: 'Téléphone de l\'admin', defaultValue: '0123456789' },
  { type: 'text', name: 'country', label: 'Pays de l\'admin', defaultValue: 'France' },
  { type: 'number', name: 'zipCode', label: 'Code postal de l\'admin', defaultValue: '12345' },
  { type: 'text', name: 'address', label: 'Adresse de l\'admin', defaultValue: '123 Rue Principale' },
  { type: 'password', name: 'password', label: 'Mot de passe de l\'admin', defaultValue: '' },
  { type: 'password', name: 'confirmPassword', label: 'Confirmez le mot de passe de l\'admin', defaultValue: '' },
];

const form = document.createElement('form');

formFields.forEach(field => {
  const input = FormValidator.createInput(field.type, field.name, field.label, field.defaultValue);
  form.appendChild(input);
});

const submitButton = document.createElement('button');
submitButton.type = 'submit';
submitButton.innerText = 'Envoyer';
form.appendChild(submitButton);

form.addEventListener('submit', handleSubmit);

document.body.appendChild(form);


function handleSubmit(event) {
  event.preventDefault();

  const formData = new FormData(form);

  const siteName = formData.get('siteName');
  if(!FormValidator.type_check( {prop1: siteName}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
    alert('Nom invalide. Veuillez entrer un nom valide.');
    return;
  }

  const firstname = formData.get('firstname');
  if(!FormValidator.type_check( {prop1: firstname}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
    alert('Prénom invalide. Veuillez entrer un prénom valide.');
    return;
  }

  const lastname = formData.get('lastname');
  if(!FormValidator.type_check( {prop1: lastname}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
    alert('Nom invalide. Veuillez entrer un nom valide.');
    return;
  }

  const pseudo = formData.get('pseudo');
    if(!FormValidator.type_check( {prop1: pseudo}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
      alert('Pseudo invalide. Veuillez entrer un pseudo valide.');
      return;
    }
  

  const birthDate = formData.get('birthDate');
  if (!FormValidator.validateBirthDate(birthDate)) {
    if(!FormValidator.type_check( {prop1: birthDate}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
      alert('La date de naissance est invalide. Veuillez entrer une date de naissance valide.');
      return;
    }
  }

  const email = formData.get('email');
  if (!FormValidator.validateEmail(email)) {
    if(!FormValidator.type_check( {prop1: email}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
      alert('Adresse e-mail invalide. Veuillez entrer une adresse e-mail valide.');
      return;
    }
  }

  const phone = parseInt(formData.get('phone'));
    if (!FormValidator.validatePhoneNumber(phone)) {
      if(!FormValidator.type_check( {prop1: phone}, { type: 'object', properties: {prop1: {type: 'number'}} } )){
        alert('Le code postal est invalide. Veuillez entrer un code postal de 5 chiffres.');
        return;
      }
    }

  const country = formData.get('country');
    if(!FormValidator.type_check( {prop1: country}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
      alert('Veuillez resaissir de nouveau votre pays.');
      return;
    }

  const zipCode = parseInt(formData.get('zipCode'));
  if (!FormValidator.validateZipCode(zipCode)) {
    if(!FormValidator.type_check( {prop1: zipCode}, { type: 'object', properties: {prop1: {type: 'number'}} } )){
      alert('Le code postal est invalide. Veuillez entrer un code postal de 5 chiffres.');
      return;
    }
  }

  const address = formData.get('address').toString();
  console.log(typeof address);
    if(!FormValidator.type_check( {prop1: address}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
      alert('L\'adresse est invalide. Veuillez entrer une adresse valide.');
      return;
    }

  const password = formData.get('password');
  const confirmPassword = formData.get('confirmPassword');
  if (!FormValidator.passwordsMatch(password, confirmPassword)) {
    if(!FormValidator.type_check( {prop1: password}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
      alert('Les mots de passe ne correspondent pas. Veuillez réessayer.');
      return;
    }
  }

  const data = {
    siteName: formData.get('siteName'),
    firstname: formData.get('firstname'),
    lastname: formData.get('lastname'),
    pseudo: formData.get('pseudo'),
    birthDate: birthDate,
    email: email,
    phone: phone,
    country: country,
    zipCode: zipCode,
    address: address,
    password: password,
    confirmPassword: confirmPassword,
  };

  fetch('/configsite', {
    method: 'POST',
    body: JSON.stringify(data),
    headers: {
      'Content-Type': 'application/json'
    }
  })
    .then(response => response.json())
    .then(responseData => {
      if (responseData.message) {
        alert(responseData.message);
      } else {
        console.log('Le fichier config.json a été mis à jour avec succès.');
  
        // Mettre à jour le modal avec les nouvelles données
        fetch('../config.json')
          .then(response => response.json())
          .then(newData => {
            // Mettre à jour le contenu du modal avec les nouvelles données
            updateModalContent(newData);
          })
          .catch(error => {
            console.error('Erreur lors de la récupération des données du fichier config.json:', error);
          });
      }
    })
    .catch(error => {
      console.error('Erreur lors de la mise à jour du fichier config.json:', error);
    });

  FormValidator.updateForm(data);

  const config = {
    type: 'object',
    properties: {
      siteName: { type: 'string'},
      address: { type: 'string'},
      birthDate: { type: 'string'},
      country: { type: 'string'},
      email: { type: 'string'},
      firstname: { type: 'string'},
      lastname: { type: 'string'},
      password: { type: 'string'},
      phone: { type: 'number'},
      pseudo: { type: 'string'},
      zipCode: { type: 'number'},
    }
  };
  
  // console.log(data);

  if (FormValidator.type_check({ prop1: data }, { type: 'object', properties: { prop1: { type: 'object' } } })) {
    let message = 'Félicitations ! Votre site est bien initialisé. Voici les valeurs que vous avez choisies :';
  
    const modalContainer = document.createElement('div');
    modalContainer.style.position = 'fixed';
    modalContainer.style.top = '0';
    modalContainer.style.left = '0';
    modalContainer.style.width = '100vw';
    modalContainer.style.height = '100vh';
    modalContainer.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    modalContainer.style.display = 'flex';
    modalContainer.style.justifyContent = 'center';
    modalContainer.style.alignItems = 'center';
  
    const modalContent = document.createElement('div');
    modalContent.style.display = 'flex';
    modalContent.style.backgroundColor = 'white';
    modalContent.style.padding = '20px';
    modalContent.style.borderRadius = '5px';
    modalContent.style.width = '100%';
    modalContent.style.height = '100%';
    modalContainer.id = 'modalContainer';


    const column1 = document.createElement('div');
    column1.style.width = '50%';
  
    const column2 = document.createElement('div');
    column2.style.width = '50%';
  
    for (const key in data) {
      if (key !== 'password' && key !== 'confirmPassword') {
        let value = data[key];
  
        if (value instanceof File) {
          value = value.name;
        }
  
        const valueElement = document.createElement('p');
        valueElement.innerText = `${key}: ${value}`;
  
        const containerElement = document.createElement('div');
        containerElement.style.cursor = 'pointer';
  
        containerElement.addEventListener('click', () => {
          const newValue = prompt(`Modifier la valeur de ${key}`, value);
          if (newValue !== null) {
            data[key] = newValue;
            FormValidator.display(data);
            console.log('ok');
            console.log(data);
          }
        });
  
        containerElement.appendChild(valueElement);
  
        if (Object.keys(column1.children).length < Object.keys(column2.children).length) {
          column1.appendChild(containerElement);
        } else {
          column2.appendChild(containerElement);
        }
      }
    }
  
    modalContent.appendChild(column1);
    modalContent.appendChild(column2);
  
    const messageElement = document.createElement('p');
    messageElement.innerText = message;
  
    const buttonContainer = document.createElement('div');
    buttonContainer.style.marginTop = '10px';
  
    const linkSpan = document.createElement('span');
    linkSpan.innerHTML = '<br> <a href="#">Confirmer</a>';
  
    messageElement.appendChild(linkSpan);
  
    modalContent.appendChild(messageElement);
  
    modalContainer.appendChild(modalContent);
    document.body.appendChild(modalContainer);
  
  }
}