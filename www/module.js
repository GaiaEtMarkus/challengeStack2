export class Component {
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

export class FormValidator extends Component{

  static createInput(type, name, label, defaultValue) {
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
  
      countries.forEach(country => {
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
      inputElement.value = defaultValue;
  
    }
  
    inputElement.addEventListener('input', (data) => {
      data[name] = inputElement.value;
    });
  
    const container = document.createElement('div');
    container.appendChild(labelElement);
    container.appendChild(inputElement);
  
    return container;
  }
  
  // static updateModalContent(data) {
  //   const modalContainer = document.getElementById('modalContainer');
  //   if (modalContainer) {
  //     modalContainer.innerHTML = '';
  
  //     const column1 = document.createElement('div');
  //     column1.style.width = '50%';
  
  //     const column2 = document.createElement('div');
  //     column2.style.width = '50%';
  
  //     for (const key in data) {
  //       if (data.hasOwnProperty(key)) {
  //         const value = data[key];
  
  //         const valueElement = document.createElement('p');
  //         valueElement.innerText = `${key}: ${value}`;
  
  //         const containerElement = document.createElement('div');
  //         containerElement.style.cursor = 'pointer';
  
  //         containerElement.addEventListener('click', () => {
  //           const newValue = prompt(`Modifier la valeur de ${key}`, value);
  //           if (newValue !== null) {
  //             data[key] = newValue;
  //             updateModalContent(data);
  //           }
  //         });
  
  //         containerElement.appendChild(valueElement);
  
  //         if (Object.keys(column1.children).length < Object.keys(column2.children).length) {
  //           column1.appendChild(containerElement);
  //         } else {
  //           column2.appendChild(containerElement);
  //         }
  //       }
  //     }
  
  //     modalContainer.appendChild(column1);
  //     modalContainer.appendChild(column2);
  //   }
  // }

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

//    static updateForm(formData) {

//   }
  

// static updateFields(data) {
//   // Parcourez les champs du formulaire et mettez à jour uniquement ceux qui ont été modifiés
//   for (const key in data) {
//     if (data.hasOwnProperty(key)) {
//       const inputElement = document.getElementById(key);
//       if (inputElement && inputElement.value !== data[key]) {
//         inputElement.value = data[key];
//       }
//     }
//   }
// }

 }