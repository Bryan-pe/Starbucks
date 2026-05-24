document.addEventListener("DOMContentLoaded", function(){
    const mensaje = document.getElementById("msg");
    setTimeout(() => {
        mensaje.classList.remove("show");
    }, 3000);
});