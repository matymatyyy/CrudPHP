let offset = 0;
let limit= 3;
const boton = document.getElementById("enviarComentario");
    boton.addEventListener("click", async function(){
        boton.disabled=true;
        const id_noti=document.getElementById("noticia_id").value;
        const comentario=document.getElementById("comentario").value;
        try {
            const respuesta =await fetch("http://localhost/patronDiseño/recursos/controllers/guardarComentarios.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                id_noticia: id_noti,
                comentario: comentario
            })
        });
        const resp=await respuesta.json();
        if (resp=="1") {
            boton.disabled=false;
            recargarComentarios(id_noti);
            document.getElementById("comentario").value="";
        }else{
            console.log("error de respuesta");
        }
        } catch (error) {
            console.log("error");
        }
        
    });

async function eliminarComentario(id_coment,id_noticia) {
    try {
        const response2= await fetch("/patronDiseño/recursos/controllers/eliminarComentario.php", {
            method: "POST",
            headers:{
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                id_comentario: id_coment
            })
        });
        const resultado = await response2.json();
        if (resultado=="1") {
            recargarComentarios(id_noticia);
        }else{
            conosle.log("error en la parte de recarga comentarios");
        }
    } catch (error) {
        console.log("error");
        recargarComentarios(id_noticia);
    }
}

async function recargarComentarios(id_noti) {
    contenedorComentarios=document.getElementById("contedorComentarios");
            try {
                const response=await fetch("http://localhost/patronDiseño/recursos/controllers/obtenerComentarios.php",{
                    method: "POST",
                    headers:{
                        "Content-Type": "application/json"
                    },
                    body:JSON.stringify({
                        id_noticia:id_noti,
                        offset: offset,
                        limit: limit
                    })
                });
                const respon =await response.json();
                const botonCargarMas = document.getElementById("cargarMasComentarios");
                if (respon.length < limit) {
                    botonCargarMas.disabled=true;
                    botonCargarMas.innerHTML="No hay mas comentarios";
                }else{
                    botonCargarMas.disabled=false;
                    botonCargarMas.innerHTML="Mostrar mas comentarios";
                }
                if (respon.length > -1) {
                    contenedorComentarios.innerHTML = "";
                respon.forEach(async comentario => {
                    const detalle = `
                    <div class='card my-2'>
                        <div class='card-body'>
                            <div class='d-flex justify-content-between align-items-center'>
                                <h6 class='card-title'>${comentario["name"]}</h6>`;                               
                const esComentarioUsuario = await comentarioUser(comentario["id_usuario"]);
                let detalle2 = "";
                if (esComentarioUsuario) { 
                    detalle2 = `<button class='btn btn-danger btn-sm' onclick='eliminarComentario(${comentario["id"]}, ${id_noti})'>X</button>`;
                }                
                const detalle3 = `
                            </div>
                            <p class='card-muted'>${comentario["fecha"]}</p>
                            <p class='text-muted'>${comentario["comentario"]}</p>
                        </div>
                    </div>`;
                let final = detalle + detalle2 + detalle3;
                contenedorComentarios.innerHTML += final;
            });
        }
    } catch (error) {
        console.log("error al obtener comentarios:");
    }
}

async function comentarioUser(id) {
    try {
        const responseID = await fetch("/patronDiseño/recursos/controllers/userVerifi.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                id_user: id
            })
        });
        const respuestaID = await responseID.json();
        if (respuestaID["valido"]) {  
            return true;
        } else {
            return false;
        }
    } catch (error) {
        console.log("Error en comentarioUser:", error);
        return false;
    }
}

function CargarMasComentarios(id_noti) {
    limit+=3;
    recargarComentarios(id_noti);
}