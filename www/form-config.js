const form = document.createElement('form');

const siteNameInput = createInput('text', 'siteName', 'Nom du site', 'siteName');
form.appendChild(siteNameInput);

const backgroundImageInput = createInput('file', 'backgroundImage', 'Image de fond de la page d\'accueil', '');
form.appendChild(backgroundImageInput);

const logoInput = createInput('file', 'logoInput', 'Logo du site', '');
form.appendChild(logoInput);

// Ajouter les autres champs du formulaire ici
const firstnameInput = createInput('text', 'firstname', 'Prénom du modérateur', 'John');
form.appendChild(firstnameInput);

const lastnameInput = createInput('text', 'lastname', 'Nom du modérateur', 'Doe');
form.appendChild(lastnameInput);

const pseudoInput = createInput('text', 'pseudo', 'Pseudo du modérateur', 'john_doe');
form.appendChild(pseudoInput);

const birthdateInput = createInput('text', 'birthDate', 'Date de naissance du modérateur', '01/01/1990');
form.appendChild(birthdateInput);

const emailInput = createInput('email', 'email', 'Email du modérateur', 'example@example.com');
form.appendChild(emailInput);

const phoneInput = createInput('text', 'phone', 'Téléphone du modérateur', '0123456789');
form.appendChild(phoneInput);

const countryInput = createInput('text', 'country', 'Pays du modérateur', 'France');
form.appendChild(countryInput);

const thumbnailInput = createInput('file', 'thumbnail', 'Miniature du modérateur', 'thumbnail.jpg');
form.appendChild(thumbnailInput);

const zipCodeInput = createInput('text', 'zipCode', 'Code postal du modérateur', '12345');
form.appendChild(zipCodeInput);

const addressInput = createInput('text', 'address', 'Adresse du modérateur', '123 Rue Principale');
form.appendChild(addressInput);

const passwordInput = createInput('password', 'password', 'Mot de passe du modérateur', '');
form.appendChild(passwordInput);

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

  const inputElement = document.createElement('input');
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

  const container = document.createElement('div');
  container.appendChild(labelElement);
  container.appendChild(inputElement);

  return container;
}

function handleSubmit(event) {
  event.preventDefault();

  const formData = new FormData(form);

  const data = {
    siteName: formData.get('siteName'),
    backgroundImage: formData.get('backgroundImage'),
    logoInput: formData.get('logoInput'),
    firstname: formData.get('firstname'),
    lastname: formData.get('lastname'),
    pseudo: formData.get('pseudo'),
    birthDate: formData.get('birthDate'),
    email: formData.get('email'),
    phone: formData.get('phone'),
    country: formData.get('country'),
    thumbnail: formData.get('thumbnail'),
    zipCode: formData.get('zipCode'),
    address: formData.get('address'),
    password: formData.get('password'),
  };

  // Effectuer le traitement des données ici
  // Par exemple, vous pouvez envoyer les données vers un endpoint ou les stocker localement

  console.log(data); // Affichage des données dans la console pour l'exemple

  // Réinitialiser le formulaire
  form.reset();
}
