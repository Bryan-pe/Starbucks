document.addEventListener("DOMContentLoaded", function(){ //cuando aparece un mensaje (error o bueno) hace que desaparesca despues de 3 segundos
    const mensaje = document.getElementById("msg");
    setTimeout(() => {
        mensaje.classList.remove("show");
    }, 3000);
});