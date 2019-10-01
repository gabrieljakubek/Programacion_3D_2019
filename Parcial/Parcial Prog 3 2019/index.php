<?php
include_once "./usuario.php";
include_once "./manejador.php";
include_once "./archivo.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch ($_POST["accion"]) {
        case 'cargarUsuario':
            if (isset($_POST["legajo"]) && isset($_POST["clave"]) && isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_FILES["foto1"]) && isset($_FILES["foto2"])) {
                $usuario = new Usuario($_POST["legajo"], $_POST["clave"], $_POST["nombre"], $_POST["email"]);
                echo (Manejador::GuardarUsuario($usuario, $_FILES["foto1"], $_FILES["foto2"]));
                Manejador::Logger($_POST["accion"], $_SERVER['REMOTE_ADDR']);
            }
            break;
        case 'modificarUsuario':
            if (isset($_POST["legajo"]) && isset($_POST["clave"]) && isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_FILES["foto1"]) && isset($_FILES["foto2"])) {
                $usuario = new Usuario($_POST["legajo"], $_POST["clave"], $_POST["nombre"], $_POST["email"]);
                echo (Manejador::ModificarUsuario($usuario, $_FILES["foto1"], $_FILES["foto2"]));
                Manejador::Logger($_POST["accion"], $_SERVER['REMOTE_ADDR']);
            } elseif (isset($_POST["legajo"]) && isset($_POST["clave"]) && isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_FILES["foto1"])) {
                $usuario = new Usuario($_POST["legajo"], $_POST["clave"], $_POST["nombre"], $_POST["email"]);
                echo (Manejador::ModificarUsuario($usuario, $_FILES["foto1"], null));
                Manejador::Logger($_POST["accion"], $_SERVER['REMOTE_ADDR']);
            } elseif (isset($_POST["legajo"]) && isset($_POST["clave"]) && isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_FILES["foto2"])) {
                $usuario = new Usuario($_POST["legajo"], $_POST["clave"], $_POST["nombre"], $_POST["email"]);
                echo (Manejador::ModificarUsuario($usuario, null, $_FILES["foto2"]));
                Manejador::Logger($_POST["accion"], $_SERVER['REMOTE_ADDR']);
            } else if (isset($_POST["legajo"]) && isset($_POST["clave"]) && isset($_POST["nombre"]) && isset($_POST["email"]) ) {
                $usuario = new Usuario($_POST["legajo"], $_POST["clave"], $_POST["nombre"], $_POST["email"]);
                echo (Manejador::ModificarUsuario($usuario, null, null));
                Manejador::Logger($_POST["accion"], $_SERVER['REMOTE_ADDR']);
            }
            break;
    }
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    switch ($_GET["accion"]) {
        case "login":
            if (isset($_GET["legajo"]) && isset($_GET["clave"])) {
                $usuario = new Usuario($_GET["legajo"], $_GET["clave"]);
                echo (Manejador::ListarUsuario($usuario));
                Manejador::Logger($_GET["accion"], $_SERVER['REMOTE_ADDR']);
            }
            break;
            case "verUsuario":
            if (isset($_GET["legajo"])) {
                $usuario = new Usuario($_GET["legajo"]);
                echo (Manejador::ListarUsuario($usuario));
                Manejador::Logger($_GET["accion"], $_SERVER['REMOTE_ADDR']);
            }
            break;
            
            //case'':
            // break;
    }}
