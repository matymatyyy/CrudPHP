let contador = 6;
document.getElementById("ver-mas").addEventListener("click", async function() {
    const params = new URLSearchParams(window.location.search);
    let filtro = params.has("filtro") ? params.get("filtro") : "";
    let bodyData = { //creamos un objeto dinamico y le agregamos el filtro si existe
        traer: contador
    };
    if (filtro) {
        bodyData.filtro = filtro; 
    }
    const response = await fetch("recursos/controllers/verMas.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(bodyData)
    });
    const noticias = await response.json();
    const contenedor = document.getElementById("contenedor-noticias");
    contador += 6;
    if (noticias.length < 6) {
        let boton = document.getElementById("ver-mas");
        boton.disabled = true;
        boton.innerText = "No hay más noticias";
    }
        noticias.forEach(noticia => {
            const fecha = new Date(noticia.fecha);
            const opciones = { year: 'numeric', month: 'long', day: 'numeric' };
            const fechaFormateada = new Intl.DateTimeFormat('es-ES', opciones).format(fecha);
            const noticiaHTML = `
                <div class="col-md-4">
                    <div class="card">
                        <img src="/patronDiseño/panel/uploads/noticias/${noticia.imagen}" class="card-img-top" alt="Noticia">
                        <div class="card-body">
                            <h5 class="card-title">${noticia.titulo}</h5>
                            <h6 class="card-text">${noticia.nombre}</h6>
                            <p class="card-text">${fechaFormateada}</p>
                            <p class="card-text">${noticia.descripcion}</p>
                            <a href="detalle.php?id=${noticia.id}" class="btn btn-primary">Leer mas</a>
                        </div>
                    </div>
                </div>
            `;
            contenedor.innerHTML += noticiaHTML;
        });
});