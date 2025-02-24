function Validation() {
  
       
    // Capitalize the first letter
let firstnameInput = document.getElementById('Firstname');
let firstname = firstnameInput.value;
let message1 = document.getElementById('message1');

// Capitalize the first letter
firstname = firstname.charAt(0).toUpperCase() + firstname.slice(1);

// Update the input value
firstnameInput.value = firstname;

if (firstname === "") {
  message1.textContent = "Firstname is required to fill out!";
  message1.style.color = "red";
  return false;
}

if (/[0-9]/.test(firstname) || /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(firstname)) {
  if (/[0-9]/.test(firstname) && /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(firstname)) {
      message1.textContent = "Firstname cannot contain numbers and symbols!";
  } else if (/[\d]/.test(firstname)) {
      message1.textContent = "Firstname cannot contain numbers!";
  } else {
      message1.textContent = "Firstname cannot contain symbols!";
  }
  message1.style.color = "red";
  return false;
}



// Allowing double spaces
if (/  /g.test(firstname)) {
  message1.textContent = "Firstname cannot contain consecutive spaces!";
  message1.style.color = "red";
  return false;
}

if (firstname.search(/^[A-Z][a-z]*(?: [A-Z][a-z]*)*$/) === -1) {
  message1.textContent = "Firstname must only capitalize the first letter!";
  message1.style.color = "red";
  message1.style.fontSize = "15px";
  return false;
}

if (firstname.length < 4) {
  message1.textContent = "Firstname requires more letters!";
  message1.style.color = "red";
  return false;
}

if (firstname.length >= 15) {
  message1.textContent = "Firstname exceeds the maximum letters!";
  message1.style.color = "red";
  return false;
}

message1.textContent = "Input success";
message1.style.color = "green";



let middlenameInput = document.getElementById('Middlename');
let middlename = middlenameInput.value.trim();
let message2 = document.getElementById('message2');

// Check if the middle name is not empty
if (middlename !== "") {
    middlename = middlename.charAt(0).toUpperCase() + middlename.slice(1);

    middlenameInput.value = middlename;

    // Check if the middle name contains numbers or symbols
    if (/[0-9]/.test(middlename) || /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(middlename)) {
        if (/[0-9]/.test(middlename) && /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(middlename)) {
            message2.textContent = "Middle name cannot contain numbers and symbols!";
        } else if (/[\d]/.test(middlename)) {
            message2.textContent = "Middle name cannot contain numbers!";
        } else {
            message2.textContent = "Middle name cannot contain symbols!";
        }
        message2.style.color = "red";
        return false;
    }

    // Check if the middle name contains double spacing
    if (/\s/.test(middlename)) {
        if (middlename.match(/\s/g).length > 1) {
            message2.textContent = "Middle name cannot contain double spacing!";
            message2.style.color = "red";
            return false;
        }
    }

    // Check if the middle name matches the required format
    if (middlename.search(/^[A-Z][a-z]*$/) === -1) {
        message2.textContent = "Middle name must only capitalize the first letter and contain only letters!";
        message2.style.color = "red";
        return false;
    }

    // Check if the middle name is too short or too long
    if (middlename.length < 4) {
        message2.textContent = "Middle name requires more letters!";
        message2.style.color = "red";
        return false;
    }

    if (middlename.length >= 10) {
        message2.textContent = "Middle name exceeds the maximum letters!";
        message2.style.color = "red";
        return false;
    }
}

// Proceed if middle name is empty or passes validations
message2.textContent = "Input success";
message2.style.color = "green";

let lastnameInput = document.getElementById('Lastname');
let lastname = lastnameInput.value;
let message3 = document.getElementById('message3');

lastname = lastname.charAt(0).toUpperCase() + lastname.slice(1);


lastnameInput.value = lastname;

if (lastname === "") {
  message3.textContent = "Lastname is required to fill out!";
  message3.style.color = "red";
  return false;
}

if (/[0-9]/.test(lastname) || /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(lastname)) {
  if (/[0-9]/.test(lastname) && /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(lastname)) {
      message3.textContent = "Lastname cannot contain numbers and symbols!";
  } else if (/[\d]/.test(lastname)) {
      message3.textContent = "Lastname cannot contain numbers!";
  } else {
      message3.textContent = "Lastname cannot contain symbols!";
  }
  message3.style.color = "red";
  return false;
}



if (/  /g.test(lastname)) {
    message3.textContent = "Lastname cannot contain consecutive spaces!";
    message3.style.color = "red";
    return false;
  }

if (lastname.search(/^[A-Z][a-z]*(?: [A-Z][a-z]*)*$/) === -1) {
  message3.textContent = "Lastname must only capitalize the first letter!";
  message3.style.color = "red";
  message3.style.fontSize = "15px";
  return false;
}

if (lastname.length < 4) {
  message3.textContent = "Lastname requires more letters!";
  message3.style.color = "red";
  return false;
}

if (lastname.length >= 10) {
  message3.textContent = "Lastname exceeds the maximum letters!";
  message3.style.color = "red";
  return false;
}

message3.textContent = "Input success";
message3.style.color = "green";



  


   
const birthdateInput = document.getElementById("Birthdate");
const ageInput = document.getElementById("Age");

// Event listener for the change event on birthdate input
birthdateInput.addEventListener("change", calculateAge);

function calculateAge() {
    const birthdate = new Date(birthdateInput.value);
    const today = new Date();
    
    // Calculate age
    let age = today.getFullYear() - birthdate.getFullYear();
    const monthDifference = today.getMonth() - birthdate.getMonth();
    
    // Adjust age if the birthday hasn't occurred yet this year
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthdate.getDate())) {
        age--;
    }

    // Set the calculated age in the Age input field
    ageInput.value = age;
}

   
   



   const password = document.getElementById('password').value;
   const messpass = document.getElementById('messpass');
   if (password === ""){
       messpass.textContent = "Password is required!";
       messpass.style.color = "red";
       return false;
   } else if (password.length < 8){
       messpass.textContent = "Password is Weak! It must be at least 8 characters";
       messpass.style.color = "red";
       return false;
   } else if (password.length < 10 || !(/[A-Z]/.test(password) && /[a-z]/.test(password) && /[0-9]/.test(password))){
       messpass.textContent = "Password is Medium! It must contain at least one uppercase letter, one lowercase letter, and one digit";
       messpass.style.color = "orange";
       return false;
   } else if (password.length < 14 || !(/[A-Z]/.test(password) && /[a-z]/.test(password) && /[0-9]/.test(password) && /\W/.test(password))){
       messpass.textContent = "Password is Strong! It must contain at least one uppercase letter, one lowercase letter, one digit, and one special character";
       messpass.style.color = "green";
   } else {
       messpass.textContent = "Password is Very Strong!";
       messpass.style.color = "green";
   }
   
   const cPassword = document.getElementById('cPassword').value;
   const messcpass = document.getElementById('messcpass');
   if (cPassword === ""){
       messcpass.textContent = "Confirm password is required!";
       messcpass.style.color = "red";
       return false;
   } else if (password === cPassword){
       messcpass.textContent = "Password matched";
       messcpass.style.color = "green";
       return true;
   } else {
       messcpass.textContent = "Passwords do not match";
       messcpass.style.color = "red";
       return false;
   }
}

document.addEventListener("DOMContentLoaded", () => {
    const eyeIcon = document.querySelector(".show-hide");
    const passwordInput = document.getElementById("password");
  
    eyeIcon.addEventListener("click", () => {
      if (passwordInput.type === "password") {
        eyeIcon.classList.replace("bx-hide", "bx-show");
        passwordInput.type = "text";
      } else {
        eyeIcon.classList.replace("bx-show", "bx-hide");
        passwordInput.type = "password";
      }


      

      
    });
  });


