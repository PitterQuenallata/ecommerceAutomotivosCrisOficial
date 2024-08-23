<?php

class ControladorClientes
{    /*=============================================
    ingreso DE CLIENTE en usuo
    =============================================*/
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
    /*=============================================
    editar DE CLIENTE en usuo
    =============================================*/
    static public function ctrEditarCliente($data)
    {
        $response = ["success" => false, "error" => ""];

        // Validaciones básicas de sintaxis para los campos que se van a editar
        if (
            isset($data["id_cliente"]) &&
            preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $data["nombre_cliente"]) &&
            preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $data["apellido_cliente"]) &&
            preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $data["email_cliente"]) &&
            preg_match('/^[0-9]+$/', $data["telefono_cliente"]) &&
            preg_match('/^[0-9]+$/', $data["nit_ci_cliente"])
        ) {
            $tabla = "clientes";
            $id_cliente = $data["id_cliente"];
            
            
            // Verificar si se desea cambiar la contraseña
            if (!empty($data["password_cliente"])) {
                $crypt = crypt($data["password_cliente"], '$2a$07$azybxcags23425sdg23sdfhsd$');
            } else {
                $password = ModeloClientes::mdlMostrarClientePorId($tabla, $id_cliente);
                $crypt = $password["password_cliente"]; // Mantener la contraseña actual
            }

            // Preparar los datos para la actualización
            $datosActualizados = [
                "id_cliente" => $id_cliente,
                "nombre_cliente" => $data["nombre_cliente"],
                "apellido_cliente" => $data["apellido_cliente"],
                "email_cliente" => $data["email_cliente"],
                "telefono_cliente" => $data["telefono_cliente"],
                "nit_ci_cliente" => $data["nit_ci_cliente"],
                "password_cliente" => $crypt,
            ];

            // Llamar al modelo para actualizar los datos
            $respuesta = ModeloClientes::mdlEditarCliente($tabla, $datosActualizados);
            
            if ($respuesta == "ok") {
                // Actualizar la información en la sesión si es necesario
                $_SESSION['nombre_cliente'] = $data["nombre_cliente"];
                $_SESSION['email_cliente'] = $data["email_cliente"];
                $_SESSION['cliente'] = array_merge($_SESSION['cliente'], $datosActualizados);

                $response["success"] = true;
            } else {
                $response["error"] = "Hubo un problema al actualizar el perfil.";
            }
        } else {
            $response["error"] = "Error en los campos del formulario.";
        }

        return $response;
    }

    /*=============================================
    REGISTRO DE CLIENTE en usuo
    =============================================*/
    static public function ctrRegistrarCliente($data) {
        $response = ["success" => false, "error" => ""];

        if (isset($data["nombre_cliente"]) &&
            preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $data["nombre_cliente"]) &&
            preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $data["email_cliente"]) &&
            isset($data["password_cliente"])
        ) {
            // Asignar los valores
            
            $nombre = $_POST["nombre_cliente"];
            $email = $_POST["email_cliente"];
            $password = $_POST["password_cliente"];

            // Encriptar la contraseña
            $encryptedPassword = crypt($password, '$2a$07$azybxcags23425sdg23sdfhsd$');

            // Preparar los datos para la inserción en la base de datos
            $tabla = "clientes";
            $datos = array(
                "nombre_cliente" => $nombre,
                "email_cliente" => $email,
                "password_cliente" => $encryptedPassword,
            );

            // Llamar al modelo para registrar al cliente
            $respuesta = ModeloClientes::mdlRegistrarCliente($tabla, $datos);

            if ($respuesta == "ok") {
                $response["success"] = true;
            } else {
                $response["error"] = "Hubo un problema al registrar el cliente.";
            }
        } else {
            $response["error"] = "Datos inválidos o incompletos.";
            
        }

        return $response;
    }
}
