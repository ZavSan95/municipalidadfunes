<?php

class ReclamoController{

    public function reclamoManage(){

        // Verificar que todos los campos requeridos están presentes y no están vacíos
        if ($this->validateForm()) {

            // Si la validación es exitosa, proceder con el procesamiento del formulario
            $direccion = explode(",", $_POST['direccion_transformada']);
            $direccion = $direccion[0];

            $fields = array(
                "nombre_reclamo" => $_POST['nombre_reclamo'],
                "apellido_reclamo" => $_POST['apellido_reclamo'],
                "dni_reclamo" => $_POST['dni_reclamo'],
                "celular_reclamo" => $_POST['celular_reclamo'],
                "correo_reclamo" => $_POST['correo_reclamo'],
                "cuenta_reclamo" => $_POST['cuenta_reclamo'],
                "direccion_reclamo" => $_POST['direccion_reclamo'],
                "latitud_reclamo" => $_POST['latitud_reclamo'],
                "longitud_reclamo" => $_POST['longitud_reclamo'],
                "categoria_reclamo" => $_POST['categoria_reclamo'],
                "img_reclamo" => '',
                "detalle_reclamo" => $_POST['detalle_reclamo']
            );

            $url = 'reclamos?token=no&table=reclamos&suffix=reclamo&except=id_reclamo';
            $method = 'POST';
            $createReclamo = CurlController::request($url, $method, $fields);

            if($createReclamo->status == 200){

                echo '    <script>
                            // Función para mostrar una alerta de SweetAlert2
                            function showAlert() {
                                Swal.fire({
                                    title: "Correcto",
                                    icon: "success",
                                    text: "Reclamo generado con éxito",
                                    confirmButtonColor: "#074A1F"
                                });
                            }
                            showAlert();
                        </script>
                ';

            }
            
        } else {
            // Si la validación falla, mostrar un mensaje de error o redirigir
            echo "Por favor, completa todos los campos obligatorios.";
        }
    }

    // Método para validar si todos los campos requeridos están presentes y no están vacíos
    private function validateForm() {
        $requiredFields = [
            'nombre_reclamo', 'apellido_reclamo', 'dni_reclamo', 
            'celular_reclamo', 'correo_reclamo', 'cuenta_reclamo', 
            'direccion_reclamo', 'latitud_reclamo', 'longitud_reclamo', 
            'categoria_reclamo', 'detalle_reclamo'
        ];

        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
                return false; // Fallo de validación si falta un campo o está vacío
            }
        }

        // Puedes agregar más validaciones específicas, como formato de correo electrónico, etc.
        if (!filter_var($_POST['correo_reclamo'], FILTER_VALIDATE_EMAIL)) {
            return false; // Validación de formato de correo
        }

        return true;
    }
}
