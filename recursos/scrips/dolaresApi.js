const contenedorExtas=document.getElementById("contenerExtras");
fetch("https://dolarapi.com/v1/dolares")
.then(response => response.json())
.then(data => agregarDolares(data));
function agregarDolares(dolares) {
dolares.forEach(dolar => {
    contenedorExtas.innerHTML+=  `
            <strong>${dolar["nombre"]}:</strong>$${dolar["venta"]}
    `;
});
}