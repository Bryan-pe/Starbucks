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