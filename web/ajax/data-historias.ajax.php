<?php
class Conexion {

    public static function conectar() {
        $host = "localhost";
        $dbname = "prueba";  // Base de datos
        $user = "root";      // Usuario
        $pass = "";          // Contraseña (vacía en este caso)

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}

class DataTableController {

    public function data() {
        // Verificar si se recibió una petición POST con el id de la mascota
        if (isset($_POST['id_mascota'])) {
            $idMascota = base64_decode($_POST['id_mascota']);

            // Conectar a la base de datos
            $pdo = Conexion::conectar();

            // Definir la consulta SQL con INNER JOIN entre historias, veterinarios y tipoconsultas
            $sql = "SELECT h.id_historia, h.fecha_hora_historia, t.descripcion_tipoconsulta, v.nombre_veterinario AS veterinario, t.descripcion_tipoconsulta AS tipo_consulta
            FROM historias h
            INNER JOIN veterinarios v ON h.id_veterinario_historia = v.id_veterinario
            INNER JOIN tipoconsultas t ON h.id_tipoconsulta_historia = t.id_tipoconsulta
            WHERE h.id_mascota_historia = ".$idMascota;
    

            // Preparar la consulta
            $stmt = $pdo->prepare($sql);

            // Ejecutar la consulta con el id de la mascota
            $stmt->bindParam(":id_mascota", $idMascota, PDO::PARAM_INT);
            $stmt->execute();

            // Obtener los resultados
            $historias = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Crear un array para almacenar los datos que necesita DataTables
            $data = [];
            foreach ($historias as $historia) {
                $data[] = [
                    $historia['id_historia'],
                    $historia['fecha'],
                    $historia['descripcion'],
                    $historia['veterinario'],
                    $historia['tipo_consulta']
                ];
            }

            // Retornar los datos en formato JSON que DataTables espera
            echo json_encode(["data" => $data]);
        }
    }
}

// Crear una instancia del controlador y llamar al método data para manejar la petición AJAX
$dataController = new DataTableController();
$dataController->data();

