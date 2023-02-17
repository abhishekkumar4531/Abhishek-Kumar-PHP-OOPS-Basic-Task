class Validity{
  check_valid = /^[A-Za-z]+$/;
  check_phone = /^(\+91)[0-9]{10}$/;
  check_email = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  checkName(userName, invalidName, submitBtn, type){
    if(!(userName.match(this.check_valid))){
      document.getElementById(invalidName).innerHTML = `<span style="color:${type};">Enter only alphabets<span>`;
      document.getElementById(submitBtn).disabled = true;
    }else{
      document.getElementById(invalidName).innerHTML = '';
      document.getElementById(submitBtn).disabled = false;
    }
  }
  checkPhone(userPhone, invalidPhone, submitBtn, type){
    if(!(userPhone.match(this.check_phone))){
      document.getElementById(invalidPhone).innerHTML = `<span style="color:${type};">Enter only 10 digits number and country code<span>`;
      document.getElementById(submitBtn).disabled = true;
    }else{
      document.getElementById(invalidPhone).innerHTML = '';
      document.getElementById(submitBtn).disabled = false;
    }
  }
  checkEmail(userEmail, emailStatus, submitBtn){
    if(!(userEmail.match(this.check_email))){
      document.getElementById(emailStatus).innerHTML = `<span style="color:red;">Enter a valid-email syntax<span>`;
      document.getElementById(submitBtn).disabled = true;
    }else{
      document.getElementById(emailStatus).innerHTML = `<span style="color:green;">This is valid-email syntax<span>`;
      document.getElementById(submitBtn).disabled = false;
    }
  }
}