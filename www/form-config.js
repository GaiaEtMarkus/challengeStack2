class Component {
  constructor(props) {
    this.props = props;
    this.oldProps = props;
  }

  static shouldUpdate(newProps) {
    return JSON.stringify(this.props) !== JSON.stringify(newProps);
  }

  static render(data) {
    const jsonData = JSON.stringify(data);
    return jsonData;
  }

  static display(newProps) {
    if (this.shouldUpdate(newProps)) {
      this.props = newProps;
      this.render();

      for (const key in this) {
        if (this[key] instanceof Component) {
          this[key].display(this.props);
        }
      }
    }
  }
}

class FormValidator extends Component{

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

const formFields = [
  { type: 'text', name: 'siteName', label: 'Nom du site', defaultValue: 'siteName' },
  { type: 'file', name: 'backgroundImage', label: 'Image de fond de la page d\'accueil', defaultValue: '' },
  { type: 'file', name: 'logo', label: 'Logo du site', defaultValue: '' },
  { type: 'text', name: 'firstname', label: 'Prénom du modérateur', defaultValue: 'John' },
  { type: 'text', name: 'lastname', label: 'Nom de l\'admin', defaultValue: 'Doe' },
  { type: 'text', name: 'pseudo', label: 'Pseudo de l\'admin', defaultValue: 'john_doe' },
  { type: 'text', name: 'birthDate', label: 'Date de naissance de l\'admin', defaultValue: '01/01/1990' },
  { type: 'email', name: 'email', label: 'Email de l\'admin', defaultValue: 'example@example.com' },
  { type: 'number', name: 'phone', label: 'Téléphone de l\'admin', defaultValue: '0123456789' },
  { type: 'text', name: 'country', label: 'Pays de l\'admin', defaultValue: 'France' },
  { type: 'file', name: 'thumbnail', label: 'Miniature de l\'admin', defaultValue: 'thumbnail.jpg' },
  { type: 'number', name: 'zipCode', label: 'Code postal de l\'admin', defaultValue: '12345' },
  { type: 'text', name: 'address', label: 'Adresse de l\'admin', defaultValue: '123 Rue Principale' },
  { type: 'password', name: 'password', label: 'Mot de passe de l\'admin', defaultValue: '' },
  { type: 'password', name: 'confirmPassword', label: 'Confirmez le mot de passe de l\'admin', defaultValue: '' },
];

const form = document.createElement('form');

formFields.forEach(field => {
  const input = createInput(field.type, field.name, field.label, field.defaultValue);
  form.appendChild(input);
});

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

    const countries = ['FR', 'US', 'ENG', 'ALG', 'MOR'];

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
    return;
  }

  const backgroundImage = formData.get('backgroundImage');
  if(!FormValidator.type_check( {prop1: backgroundImage}, { type: 'object', properties: {prop1: {type: 'object'}} } )){
    alert('Image invalide. Veuillez entrer une image valide.');
    return;
  }

  const logo = formData.get('logo');
  if(!FormValidator.type_check( {prop1: logo}, { type: 'object', properties: {prop1: {type: 'object'}} } )){
    alert('Logo invalide. Veuillez entrer un logo valide.');
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

  const thumbnail = formData.get('thumbnail');
    if(!FormValidator.type_check( {prop1: thumbnail}, { type: 'object', properties: {prop1: {type: 'object'}} } )){
      alert('Photo invalid. Veuillez entrer une photo valide.');
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
  
  console.log(data);

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
  
    form.reset();
  }
  
}