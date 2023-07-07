export class FormValidator {
 /**
   * Main function for type checking which includes validation for type, value, enum, and properties.
   * @param {any} variable - The variable to be checked.
   * @param {Object} config - The configuration object for type checking.
   * @returns {boolean}
   */
  static type_check(variable, config) {
    // if 'type' is specified in config, checks if variable is of that type
    if (config.type && getType(variable) !== config.type) {
      return false;
    }
    
    // if 'value' is specified in config, checks if variable equals that value
    if (config.value && JSON.stringify(variable) !== JSON.stringify(config.value)) {
      return false;
    }
    
    // if 'enum' is specified in config, checks if variable is in that set of values
    if (config.enum && !config.enum.includes(variable)) {
      return false;
    }
    
    // if 'properties' is specified in config, checks if variable matches that structure
    if (config.properties) {
      // if variable is not an object, it cannot have properties
      if (getType(variable) !== 'object') {
        return false;
      }
      // check each property in the config
      for (let prop in config.properties) {
        if (!type_check(variable[prop], config.properties[prop])) {
          return false;
        }
      }
    }
    
    // if no checks failed, variable matches the config
    return true;
  }

  static validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+(.com|.fr)$))$/;
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