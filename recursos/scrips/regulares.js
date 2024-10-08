const email = document.getElementById("gmail");
const pass = document.getElementById("password");
const formulario = document.getElementById("formu"); 
const mensaje = document.querySelector(".alert");
const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const min8 = /^.{8,}$/;
const minNumber = /^(?=.*\d).*$/; 
const minCaracterEspecial = /^(?=.*[@$!%*?&]).*$/; 
const minMayus = /^(?=.*[A-Z]).*$/; 
const minMinus = /^(?=.*[a-z]).*$/; 

let flag1 = false;
let flag2 = false;

formulario.addEventListener("submit", function(e){
    emailValidation(); 
    passwordValidation(); 

    if (flag1 && flag2) {
        return; // El formulario se enviará automáticamente
    } else {
        e.preventDefault(); 
    }
});

email.addEventListener("input", emailValidation);
pass.addEventListener("input", passwordValidation);

function emailValidation() {
    const correo = email.value;
    mensaje.innerHTML = ""; 
    flag1 = emailRegex.test(correo);

    if (!flag1) {
        mensaje.innerHTML = "Ingrese un email valido"; 
    }
}

function passwordValidation() {
    const contra = pass.value;
    mensaje.innerHTML = "";
    flag2 = true; 

    if (!minMayus.test(contra)) {
        flag2 = false;
        mensaje.innerHTML = "Minimo 1 mayuscula";
    } else if (!minMinus.test(contra)) {
        flag2 = false;
        mensaje.innerHTML = "Minimo 1 minuscula";
    } else if (!minNumber.test(contra)) {
        flag2 = false;
        mensaje.innerHTML = "Minimo 1 numero";
    } else if (!minCaracterEspecial.test(contra)) {
        flag2 = false;
        mensaje.innerHTML = "Minimo 1 caracter especial";
    } else if (!min8.test(contra)) {
        flag2 = false;
        mensaje.innerHTML = "Minimo 8 caracteres";
    }
}
