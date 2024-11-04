const inputNoticia= document.getElementById("inputNoticia");
    inputNoticia.addEventListener("input", async function(){
        const fechBusqueda =await fetch ("/patronDiseño/recursos/controllers/buscarModal.php",{
            method: "POST",
            headers:{ "Content-Type": "application/json" },
            body:JSON.stringify({
                busqueda: inputNoticia.value
            })
        });
        const respuestaBusqueda =await fechBusqueda.json();
        const contenedorModal=document.getElementById("ContendorModal");
        contenedorModal.innerHTML="";
        respuestaBusqueda.forEach(noticia => {
            const fecha = new Date(noticia["fecha"]);
                const opciones = { year: 'numeric', month: 'long', day: 'numeric' };
                const fechaFormateada = new Intl.DateTimeFormat('es-ES', opciones).format(fecha);
            let detalle = `
                <div class="row mb-3">
                    <div class="col-12">
                    <h5 class="text-primary mb-2" id="noticiaTitulo"><a href="detalle.php?id=${noticia["id"]}" class="text-decoration-none">${noticia["titulo"]}</a></h5>
                    </div>
                    <div class="col-12">
                    <p class="text-muted" id="noticiaFecha">Fecha: ${fechaFormateada}</p>
                    </div>
                    <div class="col-4">
                    <img id="noticiaImagen" src="/patronDiseño/panel/uploads/noticias/${noticia['imagen']}" alt="Imagen de la Noticia" class="img-fluid rounded" style="max-width: 150px; max-height: 150px;">
                    </div>
                    <div class="col-8">
                    <p id="noticiaDescripcion">${noticia["descripcion"]}</p>
                    </div>
                    <div class="col-12 mt-2">
                    <p><strong>Escrito por:</strong> <span id="noticiaGmail" class="text-info">${noticia["gmail"]}</span></p>
                    </div>  <hr>
                </div>`;
        contenedorModal.innerHTML+=detalle;
        });
    });