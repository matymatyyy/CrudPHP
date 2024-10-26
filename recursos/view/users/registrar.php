<?php  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header text-center">
            <h1>Registrar Usuario</h1>
        </div>
        <div class="card-body">
            <div class="text-center" id="result">
            </div>
            <div class="form text-center" id="formu" method="POST" action="registrar.php?registro=1">
            <p class="alert alert-danger" role="alert" id="mesajes">Complete los campos</p> 
                <div class="form-group">
                    <label for="gmail">Correo Electrónico</label>
                    <input type="text" class="form-control" name="gmail" id="gmail" placeholder="ejemplo@gmail.com">
                </div>
                <div class="form-group">
                    <label for="text">Usuario</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="usuario">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="text" class="form-control" name="password" id="password" placeholder="contraseña">
                </div>
                <br>
                <input type="submit" class="btn btn-primary w-100" id="enviar">
            </div>
            <br>
            <form action="inicioSesion.php">
                <button type="submit" class="btn btn-secondary w-100">Volver</button>
            </form>
        </div>
    </div>
</div>
<script src="../../scrips/regulares.js"></script>
<script>
    let boton= document.getElementById("enviar");
    boton.addEventListener("click", async function(event) {
        let gmail = document.getElementById("gmail").value;
        let name = document.getElementById("name").value;
        let password = document.getElementById("password").value;
        const resultado = validarTotalDatos(event);
        if (!resultado) {
            return false;
        }
        boton.disabled = true;
        const texto = document.getElementById("mesajes");
        texto.innerHTML = "Procesando, por favor espere...";
        texto.className = "alert alert-info";
        try {
            const response = await fetch("../../controllers/registro.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    "gmail": gmail,
                    "name": name,
                    "password": password
                })
            });

            const respuesta = await response.json();
            if (respuesta == "1") {
                texto.innerHTML = "Se registró correctamente, por favor revise su email para confirmar el usuario";
                texto.className = "alert alert-success";
            } else if (respuesta == "2") {
                texto.innerHTML = "Este usuario ya existe";
                texto.className = "alert alert-warning";
            } else {
                texto.innerHTML = "Error en el registro";
                texto.className = "alert alert-danger";
            }
            boton.disabled = false;
            document.getElementById("gmail").value = "";
            document.getElementById("name").value = "";
            document.getElementById("password").value = "";
        } catch (error) {
            texto.innerHTML = "Error en la conexión o en el servidor ";   
            texto.className = "alert alert-danger";
        }
    });
</script>
</body>
</html