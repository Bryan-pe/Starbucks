document.addEventListener("DOMContentLoaded", function(){
    const user = localStorage.getItem("user_logueado");
    const login = document.getElementById("login_link");
    const logout = document.getElementById("logout_link");

    if(user){
        login.style.display = "none";
        logout.style.display = "inline-block";
    }else{
        login.style.display = "inline-block";
        logout.style.display = "none";
    }

    const usuario = JSON.parse(localStorage.getItem("user_logueado"));
    const h2 = document.getElementById("log_user");

    if(user){
        h2.textContent = "¡Disfrútalos, "+ usuario.nombre +"!"
    }else{
        h2.textContent = "¡Disfrútalos!"
    }
});

function logout(){
    localStorage.removeItem("user_logueado");
    //localStorage.clear();
    window.location.reload();
}