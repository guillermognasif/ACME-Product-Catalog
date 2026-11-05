let passInput = document.getElementById('pw');
let verifyInput = document.getElementById('vpw');
let msg = document.getElementById('msg');
let button = document.getElementById('main-button');

passInput.addEventListener('input', validate);
verifyInput.addEventListener('input', validate);

function validate() {
    const password = passInput.value;
    const confirm = verifyInput.value;
    let errors = [];

    // Check if password has at least one number
    if (!/\d/.test(password)) {
        errors.push("Password must contain a number");
    }

    // Check if password is at least 8 characters
    if (password.length < 8) {
        errors.push("Password must be at least 8 characters long");
    }

    // Check if passwords match 
    if ( password !== confirm) {
        errors.push("Passwords do not match");
    }

    if (errors.length === 0) {
        msg.innerText = "Perfect! Password is valid and matches.";
        msg.className = "valid";
        button.disabled = false;
    } else {
        msg.innerText = errors.join('\n');
        msg.className = "invalid";
        button.disabled = true;
    }
}
