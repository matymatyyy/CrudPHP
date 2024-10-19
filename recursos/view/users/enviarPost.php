<?php
function sendPost($url, array $data) {
    # Inicia la sesión cURL
    $ch = curl_init($url);
    # Configura cURL para enviar una solicitud POST
    curl_setopt($ch, CURLOPT_POST, 1);
    # Envía los datos en formato POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    # Configura cURL para que no devuelva la respuesta
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
    # Ejecuta la solicitud
    curl_exec($ch);
    # Verifica si hubo algún error
    if (curl_errno($ch)) {
        echo 'Error en cURL: ' . curl_error($ch);
    }
    # Cierra cURL
    curl_close($ch);
}
