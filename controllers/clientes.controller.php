<?php

class ControladorClientes
{
    static public function ctrIngresoCliente($usuario, $password)
    {
        $response = ["success" => false, "error" => ""];

        // Validaciones básicas de sintaxis
        if (
            preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $usuario) &&
            preg_match('/^[a-zA-Z0-9]+$/', $password)
        ) {
            // Encriptar contraseña
            $crypt = crypt($password, '$2a$07$azybxcags23425sdg23sdfhsd$');
            $tabla = "clientes";
            $item = "email_cliente";
            $valor = $usuario;

            // Obtener el cliente desde la base de datos
            $respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

            // Validar el login
            if (is_array($respuesta) && isset($respuesta["email_cliente"]) && isset($respuesta["password_cliente"])) {
                if ($respuesta["email_cliente"] == $usuario && $respuesta["password_cliente"] == $crypt) {
                    if ($respuesta["estado_cliente"] == 1) {
                        // Inicio de sesión exitoso, guardar información en la sesión
                        $_SESSION['id_cliente'] = $respuesta["id_cliente"];
                        $_SESSION['nombre_cliente'] = $respuesta["nombre_cliente"];
                        $_SESSION['email_cliente'] = $respuesta["email_cliente"];
                        $_SESSION['cliente'] = $respuesta; // Puedes guardar más detalles si es necesario

                        $response["success"] = true;
                        return $response;
                    } else {
                        // Cliente inactivo
                        $response["error"] = "Cuenta inactiva.";
                    }
                } else {
                    // Credenciales incorrectas
                    $response["error"] = "Usuario o contraseña incorrectos.";
                }
            } else {
                // Cliente no encontrado
                $response["error"] = "Usuario o contraseña incorrectos.";
            }
        } else {
            // Error de sintaxis
            $response["error"] = "Error en los campos del formulario.";
        }

        return $response;
    }
}
