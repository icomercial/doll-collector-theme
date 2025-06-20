<?php
$client_id = "3064222529212283"; // ← reemplázalo
$redirect_uri = "https://personaliss.cl/ml-auth"; // debe coincidir con el que registraste en ML

$url = "https://auth.mercadolibre.com.ar/authorization?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri";

header("Location: $url");
exit;
