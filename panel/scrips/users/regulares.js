const email = document.querySelector(".email");
const pass = document.querySelector(".password");
const formulario = document.querySelector(".formulario");
const mensaje = document.querySelector(".error");
const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const min8 = /^.{8,}$/;
const minNumber = /^(?=.*\d).*$/; 
const minCaracterEspecial = /^(?=.*[@$!%*?&]).*$/; 
const minMayus = /^(?=.*[A-Z]).*$/; 
const minMinus = /^(?=.*[a-z]).*$/; 
let flag1 = 0;
let flag2 = 0;

formulario.addEventListener("submit", function (e) {
    let correo = email.value.trim();
    let contra = pass.value.trim();
    emailValidation(); 
    passwordValidation(); 

    if (correo !== "" && contra !== "" && flag1 === 1 && flag2 === 1) {
        formulario.submit();
    } else {
        e.preventDefault(); 
    }
});

email.addEventListener("input", function emailValidation(){
    let correo = email.value.trim();
    mensaje.innerHTML = ""; 
    if (emailRegex.test(correo)) {
        flag1 = 1; 
    } else {
        flag1 = 0; 
        mensaje.innerHTML = "Ingrese un email valido"; 
    }
});

pass.addEventListener("input", function passwordValidation(){
    let contra = pass.value;
    mensaje.innerHTML = "";
    flag2 = 1; 

    if (!minMayus.test(contra)) {
        flag2 = 0;
        mensaje.innerHTML = "Minimo 1 mayuscula";
    } else if (!minMinus.test(contra)) {
        flag2 = 0;
        mensaje.innerHTML = "Minimo 1 minuscula";
    } else if (!minNumber.test(contra)) {
        flag2 = 0;
        mensaje.innerHTML = "Minimo 1 numero";
    } else if (!minCaracterEspecial.test(contra)) {
        flag2 = 0;
        mensaje.innerHTML = "Minimo 1 caracter especial";
    } else if (!min8.test(contra)) {
        flag2 = 0;
        mensaje.innerHTML = "Minimo 8 caracteres";
    }
});

