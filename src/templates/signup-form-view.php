<?php


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once PATH_TEMPLATES . 'base/html_head.php'?>
    <link rel="stylesheet" href="<?=URL_CSS?>login/login.css">
    <script type="text/javascript" src="<?=URL_JS?>signup/signup.js"></script>
</head>
<body>
    <main id="main-login">
        <form id="form_login" action="<?=PATH_SIGNUP?>">
            <h2>FORMULARIO DE REGISTRO</h2>
            <div class="form-input">
                <label for="username">NOMBRE DE USUARIO</label>
                <input type="text" id="username">
            </div>
            <div class="form-input">
                <label for="password">CONTRASEÑA</label>
                <input type="password" id="password">
            </div>            
            <div class="form-input">
                <label for="password2"></label>
                <input type="password" id="password2">
            </div>     
            <div class="form-input">
                <label for="email">EMAIL</label>
                <input type="email" id="email">
            </div>            
        </form>
    <button id="btn_login">REGISTRARSE</button>
    <img id="spinner" src="<?=URL_IMGS?>spinner.svg" style="display:none;">
    <div id="error-log" style="display:none"><p></p></div>
    </main>
</body>
</html>