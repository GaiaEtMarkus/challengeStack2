import {FormValidator} from './module.js';

export  function formConf() {
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
    ];
  
    const form = document.createElement('form');
  
    formFields.forEach(field => {
      const label = document.createElement('label');
      label.innerText = field.label;
  
      const input = document.createElement('input');
      input.type = field.type;
      input.name = field.name;
      input.value = field.defaultValue;
  
      label.appendChild(input);
      form.appendChild(label);
    });
  
    const submitButton = document.createElement('button');
    submitButton.type = 'submit';
    submitButton.innerText = 'Envoyer';
    form.appendChild(submitButton);
      form.addEventListener('submit', handleConfirmPage);

  
    return form;
}

export function handleConfirmPage(event) {
  event.preventDefault();

  const formData = new FormData(form);
  let data = {
    siteName: formData.get('siteName'),
    firstname: formData.get('firstname'),
    lastname: formData.get('lastname'),
    pseudo: formData.get('pseudo'),
    birthDate: formData.get('birthDate'),
    email: formData.get('email'),
    phone: formData.get('phone'),
    country: formData.get('country'),
    zipCode: formData.get('zipCode'),
    address: formData.get('address'),
  };

  const confFormPage = createConfirmationPage(data);

  const confFormContainerWrapper = document.createElement('div');
  confFormContainerWrapper.appendChild(confFormPage);

  formContainer.remove();
  document.body.appendChild(confFormContainerWrapper);

  const confFormContainer = document.getElementById('confirm-container');
  confFormContainer.appendChild(confFormPage);

  form.addEventListener('submit', handleConfirmPage);
}

export function handleSubmit(event) {
  event.preventDefault();

  let formData = localStorage.getItem("data");
  formData = JSON.parse(formData);

  console.log(formData);
  console.log(formData['siteName']);
  const siteName = formData['siteName'].toString();
  console.log(typeof siteName);


  if(!FormValidator.type_check( {prop1: siteName}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
    alert('Nom invalide. Veuillez entrer un nom valide.');
    return;
  }

  const firstname = formData['firstname'];
  console.log(firstname);
  if(!FormValidator.type_check( {prop1: firstname}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
    alert('Prénom invalide. Veuillez entrer un prénom valide.');
    return;
  }

  const lastname = formData['lastname'];
  console.log(lastname);
  if(!FormValidator.type_check( {prop1: lastname}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
    alert('Nom invalide. Veuillez entrer un nom valide.');
    return;
  }

  const pseudo = formData['pseudo'];
    if(!FormValidator.type_check( {prop1: pseudo}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
      alert('Pseudo invalide. Veuillez entrer un pseudo valide.');
      return;
    }
  

  const birthDate = formData['birthDate'];
  if (!FormValidator.validateBirthDate(birthDate)) {
    if(!FormValidator.type_check( {prop1: birthDate}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
      alert('La date de naissance est invalide. Veuillez entrer une date de naissance valide.');
      return;
    }
  }

  const email = formData['email'];
  if (!FormValidator.validateEmail(email)) {
    if(!FormValidator.type_check( {prop1: email}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
      alert('Adresse e-mail invalide. Veuillez entrer une adresse e-mail valide.');
      return;
    }
  }

  const phone = parseInt(formData['phone']);
    if (!FormValidator.validatePhoneNumber(phone)) {
      if(!FormValidator.type_check( {prop1: phone}, { type: 'object', properties: {prop1: {type: 'number'}} } )){
        alert('Le code postal est invalide. Veuillez entrer un code postal de 5 chiffres.');
        return;
      }
    }

  const country = formData['country'];
    if(!FormValidator.type_check( {prop1: country}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
      alert('Veuillez resaissir de nouveau votre pays.');
      return;
    }

  const zipCode = parseInt(formData['zipCode']);
  if (!FormValidator.validateZipCode(zipCode)) {
    if(!FormValidator.type_check( {prop1: zipCode}, { type: 'object', properties: {prop1: {type: 'number'}} } )){
      alert('Le code postal est invalide. Veuillez entrer un code postal de 5 chiffres.');
      return;
    }
  }

  const address = formData['address'].toString();
  console.log(typeof address);
    if(!FormValidator.type_check( {prop1: address}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
      alert('L\'adresse est invalide. Veuillez entrer une adresse valide.');
      return;
    }

  const data = {
    siteName: siteName,
    firstname: firstname,
    lastname: lastname,
    pseudo: pseudo,
    birthDate: birthDate,
    email: email,
    phone: phone,
    country: country,
    zipCode: zipCode,
    address: address,
  };

  fetch('configsite.php', {
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
        console.log('La configuration a été effectuée avec succès.');

        handleRedirection();
      }
    })
    .catch(error => {
      console.error('Erreur lors de la mise à jour de la configuration:', error);
    })
    .then(() => {
      window.location.href = "/";
    });

  
  console.log(data);
}

  
export function createConfirmationPage(data) {
  
  const formFields = [
    { type: 'text', label: 'Nom du site', value: data.siteName },
    { type: 'text', label: 'Prénom du modérateur', value: data.firstname },
    { type: 'text', label: 'Nom de l\'admin', value: data.lastname },
    { type: 'text', label: 'Pseudo de l\'admin', value: data.pseudo },
    { type: 'text', label: 'Date de naissance de l\'admin', value: data.birthDate },
    { type: 'email', label: 'Email de l\'admin', value: data.email },
    { type: 'number', label: 'Téléphone de l\'admin', value: data.phone },
    { type: 'text', label: 'Pays de l\'admin', value: data.country },
    { type: 'number', label: 'Code postal de l\'admin', value: data.zipCode },
    { type: 'text', label: 'Adresse de l\'admin', value: data.address },
  ];

  const form = document.createElement('form');

  formFields.forEach(field => {
    const label = document.createElement('label');
    label.innerText = field.label;

    const input = document.createElement('input');
    input.type = field.type;
    input.value = field.value;
    input.disabled = true;

    label.appendChild(input);
    form.appendChild(label);
  });

  const submitButton = document.createElement('button');
  submitButton.type = 'submit';
  submitButton.innerText = 'Confirmer';
  submitButton.addEventListener('click', handleSubmit); // Ajouter le gestionnaire d'événements

  form.appendChild(submitButton);

  return form;
}

// function getDataFromLocalStorage() {
//   const data = localStorage.getItem("data");
//   return data ? JSON.parse(data) : {};
// }


