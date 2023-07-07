class FormValidator {
  /**
    * Main function for type checking which includes validation for type, value, enum, and properties.
    * @param {any} variable - The variable to be checked.
    * @param {Object} config - The configuration object for type checking.
    * @returns {boolean}
    */
  static type_check(variable, conf) {

    if ( conf === undefined || variable === undefined) {
        return false;
    }

    if (conf.type && typeof variable !== conf.type){
        return false;
    }

    const stack = [
        {
        currentVariable: variable,
        currentConf: conf,
        },
    ];

    while (stack.length > 0) {

        const current = stack.pop();
        const currentVariable = current.currentVariable;
        const currentConf = current.currentConf;

        if (currentConf.value !== undefined) {
            if (typeof currentConf.value === 'object') {
                if (JSON.stringify(currentVariable) !== JSON.stringify(currentConf.value)) {
                    return false;
                }
            } else if (currentVariable !== currentConf.value) {
                return false;
            }
        }

        if (currentConf.properties) {
            
            for (const subProp in currentConf.properties) {

                if (Object.prototype.hasOwnProperty.call(currentConf.properties, subProp)) {

                    if (!Object.prototype.hasOwnProperty.call(currentVariable, subProp)) {
                        return false;
                    }

                    const subPropertyConf = currentConf.properties[subProp];

                    if (subPropertyConf.type && typeof currentVariable[subProp] !== subPropertyConf.type) {
                        return false;
                    }

                    if (subPropertyConf.value && currentVariable[subProp] !== subPropertyConf.value){
                        return false;
                    }

                    if (subPropertyConf.enum) {
                        const enumValues = subPropertyConf.enum.map(JSON.stringify);
                        if (!enumValues.includes(JSON.stringify(currentVariable[subProp]))) {
                            return false;
                        }
                    }

                    if (subPropertyConf.properties) {
                        stack.push({
                                    currentVariable: currentVariable[subProp],
                                    currentConf: subPropertyConf,
                                    
                        });
                   }
                }
            }
        }
    
        if (currentConf.enum) {

        const enumValues = currentConf.enum.map(JSON.stringify);

            if (!enumValues.includes(JSON.stringify(currentVariable))) {
                return false;
            }
        }
    }
    return true;
}

  static validatePhoneNumber(phoneNumber) {
    const phoneNumberPattern = /^(06|07)\d{8}$/;
    return phoneNumberPattern.test(phoneNumber);
  }
 
   static validateEmail(email) {
     var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+(com|fr)$))$/;
     return re.test(email);
   }
 
   static validateZipCode(zipCode) {
     const zipCodePattern = /^\d{5}$/;
     return zipCodePattern.test(zipCode);
   }
 
   static validateBirthDate(birthDate) {
     const birthDatePattern = /^\d{2}\/\d{2}\/\d{4}$/;
     return birthDatePattern.test(birthDate);
   }
 
   static passwordsMatch(password, confirmPassword) {
     return password === confirmPassword;
   }
 }

//  ######################################################################
//  ######################################################################
//  ######################################################################

const form = document.createElement('form');

const siteNameInput = createInput('text', 'siteName', 'Nom du site', 'siteName');
form.appendChild(siteNameInput);

const backgroundImageInput = createInput('file', 'backgroundImage', 'Image de fond de la page d\'accueil', '');
form.appendChild(backgroundImageInput);

const logo = createInput('file', 'logo', 'Logo du site', '');
form.appendChild(logo);

// Ajouter les autres champs du formulaire ici
const firstnameInput = createInput('text', 'firstname', 'Prénom du modérateur', 'John');
form.appendChild(firstnameInput);

const lastnameInput = createInput('text', 'lastname', 'Nom de l\'admin', 'Doe');
form.appendChild(lastnameInput);

const pseudoInput = createInput('text', 'pseudo', 'Pseudo de l\'admin', 'john_doe');
form.appendChild(pseudoInput);

const birthdateInput = createInput('text', 'birthDate', 'Date de naissance de l\'admin', '01/01/1990');
form.appendChild(birthdateInput);

const emailInput = createInput('email', 'email', 'Email de l\'admin', 'example@example.com');
form.appendChild(emailInput);

const phoneInput = createInput('number', 'phone', 'Téléphone de l\'admin', '0123456789');
form.appendChild(phoneInput);

const countryInput = createInput('text', 'country', 'Pays de l\'admin', 'France');
form.appendChild(countryInput);

const thumbnailInput = createInput('file', 'thumbnail', 'Miniature de l\'admin', 'thumbnail.jpg');
form.appendChild(thumbnailInput);

const zipCodeInput = createInput('number', 'zipCode', 'Code postal de l\'admin', '12345');
form.appendChild(zipCodeInput);

const addressInput = createInput('text', 'address', 'Adresse de l\'admin', '123 Rue Principale');
form.appendChild(addressInput);

const passwordInput = createInput('password', 'password', 'Mot de passe de l\'admin', '');
form.appendChild(passwordInput);

const confirmPasswordInput = createInput('password', 'confirmPassword', 'Confirmez le mot de passe de l\'admin', '');
form.appendChild(confirmPasswordInput);

const submitButton = document.createElement('button');
submitButton.type = 'submit';
submitButton.innerText = 'Envoyer';
form.appendChild(submitButton);

form.addEventListener('submit', handleSubmit);

document.body.appendChild(form);

function createInput(type, name, label, defaultValue) {
  const labelElement = document.createElement('label');
  labelElement.for = name;
  labelElement.innerText = label;

  let inputElement;

  if (type === 'text' && name === 'country') {
    inputElement = document.createElement('select');
    inputElement.name = name;
    inputElement.id = name;
    inputElement.required = true;

    const countries = ['FR', 'US', 'ENG', 'ALG', 'MOR']; // Liste des pays

    countries.forEach((country) => {
      const optionElement = document.createElement('option');
      optionElement.value = country;
      optionElement.innerText = country;
      inputElement.appendChild(optionElement);
    });
  } else {
    inputElement = document.createElement('input');
    inputElement.type = type;
    inputElement.name = name;
    inputElement.id = name;
    inputElement.required = true;

    // Gestion spécifique du champ de fichier
    if (type === 'file') {
      inputElement.accept = 'image/*';
    } else {
      inputElement.value = defaultValue;
    }
  }

  const container = document.createElement('div');
  container.appendChild(labelElement);
  container.appendChild(inputElement);

  return container;
}


function handleSubmit(event) {
  event.preventDefault();

  const formData = new FormData(form);

  const siteName = formData.get('siteName');
  if(!FormValidator.type_check( {prop1: siteName}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
    alert('Nom invalide. Veuillez entrer un nom valide.');
    return;  // Stopper l'exécution de la fonction
  }

  const backgroundImage = formData.get('backgroundImage');
  if(!FormValidator.type_check( {prop1: backgroundImage}, { type: 'object', properties: {prop1: {type: 'object'}} } )){
    alert('Image invalide. Veuillez entrer une image valide.');
    return;  // Stopper l'exécution de la fonction
  }

  const logo = formData.get('logo');
  if(!FormValidator.type_check( {prop1: logo}, { type: 'object', properties: {prop1: {type: 'object'}} } )){
    alert('Logo invalide. Veuillez entrer un logo valide.');
    return;  // Stopper l'exécution de la fonction
  }

  const firstname = formData.get('firstname');
  if(!FormValidator.type_check( {prop1: firstname}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
    alert('Prénom invalide. Veuillez entrer un prénom valide.');
    return;  // Stopper l'exécution de la fonction
  }

  const lastname = formData.get('lastname');
  if(!FormValidator.type_check( {prop1: lastname}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
    alert('Nom invalide. Veuillez entrer un nom valide.');
    return;  // Stopper l'exécution de la fonction
  }

  const pseudo = formData.get('pseudo');
    if(!FormValidator.type_check( {prop1: pseudo}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
      alert('Pseudo invalide. Veuillez entrer un pseudo valide.');
      return;  // Stopper l'exécution de la fonction
    }
  

  const birthDate = formData.get('birthDate');
  if (!FormValidator.validateBirthDate(birthDate)) {
    if(!FormValidator.type_check( {prop1: birthDate}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
      alert('La date de naissance est invalide. Veuillez entrer une date de naissance valide.');
      return;  // Arrêter l'exécution de la fonction
    }
  }

  const email = formData.get('email');
  if (!FormValidator.validateEmail(email)) {
    if(!FormValidator.type_check( {prop1: email}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
      alert('Adresse e-mail invalide. Veuillez entrer une adresse e-mail valide.');
      return;  // Stopper l'exécution de la fonction
    }
  }

  const phone = parseInt(formData.get('phone'));
    if (!FormValidator.validatePhoneNumber(phone)) {
      if(!FormValidator.type_check( {prop1: phone}, { type: 'object', properties: {prop1: {type: 'number'}} } )){
        alert('Le code postal est invalide. Veuillez entrer un code postal de 5 chiffres.');
        return;  // Arrêter l'exécution de la fonction
      }
    }

  const country = formData.get('country');
    if(!FormValidator.type_check( {prop1: country}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
      alert('Veuillez resaissir de nouveau votre pays.');
      return;  // Stopper l'exécution de la fonction
    }

  const thumbnail = formData.get('thumbnail');
    if(!FormValidator.type_check( {prop1: thumbnail}, { type: 'object', properties: {prop1: {type: 'object'}} } )){
      alert('Photo invalid. Veuillez entrer une photo valide.');
      return;  // Stopper l'exécution de la fonction
    }

  const zipCode = parseInt(formData.get('zipCode'));
  if (!FormValidator.validateZipCode(zipCode)) {
    if(!FormValidator.type_check( {prop1: zipCode}, { type: 'object', properties: {prop1: {type: 'number'}} } )){
      alert('Le code postal est invalide. Veuillez entrer un code postal de 5 chiffres.');
      return;  // Arrêter l'exécution de la fonction
    }
  }

  const address = formData.get('address').toString();
  console.log(typeof address);
    if(!FormValidator.type_check( {prop1: address}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
      alert('L\'adresse est invalide. Veuillez entrer une adresse valide.');
      return;  // Arrêter l'exécution de la fonction
    }

  const password = formData.get('password');
  const confirmPassword = formData.get('confirmPassword');
  if (!FormValidator.passwordsMatch(password, confirmPassword)) {
    if(!FormValidator.type_check( {prop1: password}, { type: 'object', properties: {prop1: {type: 'string'}} } )){
      alert('Les mots de passe ne correspondent pas. Veuillez réessayer.');
      return;  // Arrêter l'exécution de la fonction
    }
  }

  const data = {
    siteName: formData.get('siteName'),
    backgroundImage: formData.get('backgroundImage'),
    logo: formData.get('logo'),
    firstname: formData.get('firstname'),
    lastname: formData.get('lastname'),
    pseudo: formData.get('pseudo'),
    birthDate: birthDate,
    email: email,
    phone: phone,
    country: country,
    thumbnail: thumbnail,
    zipCode: zipCode,
    address: address,
    password: password,
    confirmPassword: confirmPassword,
  };

  const config = {
    type: 'object',
    properties: {
      siteName: { type: 'string'},
      address: { type: 'string'},
      backgroundImage: { type: 'file'},
      birthDate: { type: 'string'},
      country: { type: 'string'},
      email: { type: 'string'},
      firstname: { type: 'string'},
      lastname: { type: 'string'},
      logo: { type: 'file'},
      password: { type: 'string'},
      phone: { type: 'number'},
      pseudo: { type: 'string'},
      thumbnail: { type: 'file'},
      zipCode: { type: 'number'},
    }
  };
  
  console.log(data); // Affichage des données dans la console pour l'exemple

  if(FormValidator.type_check( {prop1: data}, { type: 'object', properties: {prop1: {type: 'object'}} } )){
    console.log('ok');
  }

  // Réinitialiser le formulaire
  form.reset();
}