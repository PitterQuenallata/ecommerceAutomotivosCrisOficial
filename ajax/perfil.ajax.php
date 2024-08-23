<?php
session_start();
require_once "../controllers/clientes.controller.php";
require_once "../models/clientes.model.php";

class AjaxPerfil {

    public function ajaxRequestHandler() {
        // Verificamos si el tipo de acción está definido en la solicitud
        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            switch ($action) {
                case 'registrarCliente':
                    $this->registrarCliente();
                    break;

                case 'editarPerfil':
                    $this->editarPerfil();
                    break;

                case 'obtenerHistorial':
                    $this->obtenerHistorial();
                    break;

                case 'obtenerCompras':
                    $this->obtenerCompras();
                    break;

                case 'obtenerEnvios':
                    $this->obtenerEnvios();
                    break;

                // Puedes agregar más casos para diferentes acciones aquí

                default:
                    echo json_encode(['success' => false, 'error' => 'Acción no reconocida']);
                    break;
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'No se especificó ninguna acción']);
        }
    }

    private function editarPerfil() {
        if (isset($_POST["nombre_cliente"])) {
            $data = array(
                "id_cliente" => $_POST["id_cliente"],
                "nombre_cliente" => $_POST["nombre_cliente"],
                "apellido_cliente" => $_POST["apellido_cliente"],
                "email_cliente" => $_POST["email_cliente"],
                "telefono_cliente" => $_POST["telefono_cliente"],
                "nit_ci_cliente" => $_POST["nit_ci_cliente"],
                "password_cliente" => $_POST["password_cliente"]
            );
            
            $respuesta = ControladorClientes::ctrEditarCliente($data);

            echo json_encode($respuesta);
        } else {
            echo json_encode(['success' => false, 'error' => 'Datos insuficientes']);
        }
    }

    private function registrarCliente() {
        if (isset($_POST["nombre_cliente"])) {
            $data = array(
                "nombre_cliente" => $_POST["nombre_cliente"],
                "email_cliente" => $_POST["email_cliente"],
                "password_cliente" => $_POST["password_cliente"]
            );
            
            $respuesta = ControladorClientes::ctrRegistrarCliente($data);

            echo json_encode($respuesta);
        } else {
            echo json_encode(['success' => false, 'error' => 'Datos insuficientes']);
        }
    }

    private function obtenerHistorial() {
        // Lógica para obtener el historial del cliente
        echo json_encode(['success' => true, 'data' => 'Historial del cliente']);
    }

    private function obtenerCompras() {
        // Lógica para obtener las compras del cliente
        echo json_encode(['success' => true, 'data' => 'Compras del cliente']);
    }

    private function obtenerEnvios() {
        // Lógica para obtener los envíos del cliente
        echo json_encode(['success' => true, 'data' => 'Envíos del cliente']);
    }

}

// Inicializamos la clase y manejamos la solicitud
$ajaxPerfil = new AjaxPerfil();
$ajaxPerfil->ajaxRequestHandler();

