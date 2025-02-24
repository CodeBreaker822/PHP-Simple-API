// script for the signin signup style
var a = document.getElementById("loginBtn");
var b = document.getElementById("registerBtn");
var x = document.getElementById("login");
var y = document.getElementById("register");

function login() {
    x.style.left = "4px";
    y.style.right = "-520px";
    a.className += " white-btn";
    b.className = "btn";
    x.style.opacity = 1;
    y.style.opacity = 0;
}

function register() {
    x.style.left = "-510px";
    y.style.right = "5px";
    a.className = "btn";
    b.className += " white-btn";
    x.style.opacity = 0;
    y.style.opacity = 1;
}


// script for timer the loader in login
// Update the timer every second
let consecutiveErrors = 0;
let baseSeconds = 15;

setInterval(updateTimer, 1000);

function updateTimer() {
    // Check if the timer element exists
    const timerElement = document.getElementById('timer');
    if (timerElement) {
        if (consecutiveErrors % 3 === 0) {
            // Increase base seconds after every 3 consecutive errors
            baseSeconds *= 2;
        }
        
        let remainingSeconds = baseSeconds;
        if (timerElement.dataset.remaining) {
            remainingSeconds = parseInt(timerElement.dataset.remaining);
        }

        if (remainingSeconds > 0) {
            remainingSeconds--;
            timerElement.dataset.remaining = remainingSeconds;
        } else {
            // Timer expired, reset the timer
            timerElement.remove();
            baseSeconds = 15;
            consecutiveErrors = 0;
            return;
        }

        // Format the remaining time with leading zeros
        const minutes = Math.floor(remainingSeconds / 60);
        const seconds = remainingSeconds % 60;
        const formattedTime = minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
        timerElement.innerHTML = "Please try again after " + formattedTime;

        if (remainingSeconds === 0) {
            consecutiveErrors++;
        }
    }
}



// register password areas
let pswrd = document.getElementById('pswrd');
let toggleBtn = document.getElementById('toggleBtn');

let lowerCase = document.getElementById('lower');
let upperCase = document.getElementById('upper');
let digit = document.getElementById('number');
let specialChar = document.getElementById('special');
let minLength = document.getElementById('length');

function checkPassword(data){
    // javascript regular expression pattern
    const lower = new RegExp('(?=.*[a-z])');
    const upper = new RegExp('(?=.*[A-Z])');
    const number = new RegExp('(?=.*[0-9])');
    const special = new RegExp('(?=.*[!@#\$%\^&\*])');
    const length = new RegExp('(?=.{8,})');

    // lower case validation check
    if(lower.test(data)){
        lowerCase.classList.add('valid');
    } else {
        lowerCase.classList.remove('valid');
    }
    // upper case validation check
    if(upper.test(data)){
        upperCase.classList.add('valid');
    } else {
        upperCase.classList.remove('valid');
    }
    // number case validation check
    if(number.test(data)){
        digit.classList.add('valid');
    } else {
        digit.classList.remove('valid');
    }
    // special character case validation check
    if(special.test(data)){
        specialChar.classList.add('valid');
    } else {
        specialChar.classList.remove('valid');
    }
    // minimum length validation check
    if(length.test(data)){
        minLength.classList.add('valid');
    } else {
        minLength.classList.remove('valid');
    }
}

// show hide password

toggleBtn.onclick = function(){
    if (pswrd.type === 'password'){
        pswrd.setAttribute('type', 'text');
        toggleBtn.classList.add('hide');
    } else {
        pswrd.setAttribute('type', 'password');
        toggleBtn.classList.remove('hide');
    }
}

// focus and focusout events

let validationBox = document.querySelector(".validation");
let passwordField = document.getElementById("pswrd");

passwordField.addEventListener("focus", () => {
    validationBox.classList.remove("label-hide");
});

passwordField.addEventListener("focusout", () => {
    validationBox.classList.add("label-hide");
});


