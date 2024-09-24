<?php

class ControllerLog {

    public function register($user, $action, $otherUser = null): bool {
        
        // Obtener la IP del cliente
        $ipAddress = $this->getUserIP();

        // URL y método para hacer el request
        $url = 'logs?token=no&table=logs&suffix=log&except=user_log';
        $method = "POST";

        // Datos del log
        $fields = array(
            "user_log" => $user,
            "action_log" => $action,
            "user_action_log" => $otherUser,
            "date_created_log" => date('Y-m-d H:i:s'), // Fecha actual
            "ip_address_log" => $ipAddress 
        );

        // Realiza la solicitud CURL
        $registerLog = CurlController::request($url, $method, $fields);

        // Verifica si la solicitud fue exitosa
        if ($registerLog->status == 200) {
            return true; // Registro exitoso
        } else {
            error_log("Error al registrar el log: " . json_encode($registerLog)); // Log de error
            return false; // Error al registrar
        }
    }

    // Método para obtener la IP del cliente
    private function getUserIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            // IP desde un proxy compartido
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // IP detrás de un proxy
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            // IP directa
            return $_SERVER['REMOTE_ADDR'];
        }
    }
}

