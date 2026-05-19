//en caso de ya estar logueado redirige al index
document.addEventListener("DOMContentLoaded", function(){
    const user = localStorage.getItem("user_logueado")

    if(user){
        window.location.href = "index.html";
    }
});

function registro(e){
    e.preventDefault();

    const nombre = document.getElementById("nombre").value;
    const apellido = document.getElementById("apellido").value;
    const email = document.getElementById("email").value;
    const pass = document.getElementById("pass").value;

    if(!nombre || !apellido || !email || !pass){
        msg("Complete todos los campos!", "error");
        return;
    }

    let users = JSON.parse(localStorage.getItem("users")) || [];

    console.log(users);
    const existe = users.find(p => p.email === email);
    if(existe){
        msg("Este correo ya esta registrado", "error");
        return;
    }

    const new_user = {
        nombre,
        apellido,
        email,
        pass
    };

    users.push(new_user);
    localStorage.setItem("users", JSON.stringify(users));
    msg("Se registro correctamente", "good")
    log();
}

function login(e){
    e.preventDefault();

    const email = document.getElementById("login_email").value;
    const pass = document.getElementById("login_pass").value;

    let users = JSON.parse(localStorage.getItem("users")) || [];
    const user = users.find(p => p.email === email && p.pass === pass);

    if(user){
        localStorage.setItem("user_logueado", JSON.stringify(user));
        window.location.href = "index.html";
    }else{
        msg("Usuario o contraseña incorrectos", "error")
    }
}

//muestra un mensage en la esquina inferior izquierda
function msg(texto, tipo) {
    const mensaje = document.getElementById("msg");
    mensaje.textContent = texto;

    mensaje.className = "";
    mensaje.classList.add(tipo);
    mensaje.classList.add("show");

    setTimeout(() => {
        mensaje.classList.remove("show");
    }, 3000);
}