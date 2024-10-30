const boton =document.getElementById("enviarComentario");
    boton.addEventListener("click", async function(e){
        boton.disabled=true;
        boton.innerHTML="Enviando..."
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
            boton.innerHTML="Enviar comentario";
            contenedorComentarios=document.getElementById("contedorComentarios");
            try {
                const response=await fetch("http://localhost/patronDiseño/recursos/controllers/obtenerComentarios.php",{
                    method: "POST",
                    headers:{
                        "Content-Type": "application/json"
                    },
                    body:JSON.stringify({
                        id_noticia:id_noti
                    })
                });
                const respon =await response.json();
                if (respon.length > 0) {
                    contenedorComentarios.innerHTML="";
                    respon.forEach(comentario => {
                        const detalle= `
                        <div class='card my-2'>
                        <div class='card-body'>
                        <h6 class='card-title'>${comentario["name"]}</h6>
                        <p class='card-muted'>${comentario["fecha"]}</p>
                        <p class='text-muted'>${comentario["comentario"]}</p>
                        </div>
                        </div> `;
                        contenedorComentarios.innerHTML+=detalle;
                    });
                }
            } catch (error) {
                conosle.log("error al obtener comentarios")
            }


        }else{
            console.log("error de respuesta");
        }
        } catch (error) {
            console.log("error");
        }
        
    });
