const boton = document.getElementById("enviarComentario");
    boton.addEventListener("click", async function(){
        boton.disabled=true;
        const id_noti=document.getElementById("noticia_id").value;
        const comentario=document.getElementById("comentario").value;
        if (comentario.trim().length === 0) {
            boton.disabled=false;
            return;
        }
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