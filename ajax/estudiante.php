<?php 
header('Content-Type: application/json');
// Obtiene el contenido JSON desde el cuerpo de la solicitud
$jsonData = file_get_contents('php://input');
// Datos estáticos para prueba
//$jsonData = '{"id": 1, "nombre": "Juan"}';
// Decodifica el JSON a un array de PHP
$data = json_decode($jsonData, true);
require_once "../modelos/Estudiante.php";
$estudiante = new Estudiante();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        // Ruta: /estudiantes (Insertar)
        $cedula = isset($data['cedula']) ? $data['cedula'] : '';
        $nombre = isset($data['nombre']) ? $data['nombre'] : '';
        $primer_apellido = isset($data['primer_apellido']) ? $data['primer_apellido'] : '';
        $segundo_apellido = isset($data['segundo_apellido']) ? $data['segundo_apellido'] : '';
        $telefono = isset($data['telefono']) ? $data['telefono'] : '';
        $fecha_nacimiento = isset($data['fecha_nacimiento']) ? $data['fecha_nacimiento'] : '';
        $grado = isset($data['grado']) ? $data['grado'] : '';
        $nacionalidad = isset($data['nacionalidad']) ? $data['nacionalidad'] : '';
        $sexo = isset($data['sexo']) ? $data['sexo'] : '';
        $direccion = isset($data['direccion']) ? $data['direccion'] : '';

        $rspta = $estudiante->insertar($cedula, $nombre, $primer_apellido, $segundo_apellido, $telefono, $fecha_nacimiento, $grado, $nacionalidad, $sexo, $direccion);
        echo json_encode($rspta ? ["mensaje" => "Estudiante registrado"] : ["error" => "Estudiante no se pudo registrar"]);
        break;

    case 'PUT':
        // Ruta: /estudiantes/{cedula} (Actualizar)
        $cedula = isset($data['cedula']) ? $data['cedula'] : '';
        $nuevo_nombre = isset($data['nombre']) ? $data['nombre'] : '';
        $nuevo_primer_apellido = isset($data['primer_apellido']) ? $data['primer_apellido'] : '';
        $nuevo_segundo_apellido = isset($data['segundo_apellido']) ? $data['segundo_apellido'] : '';
        $nuevo_telefono = isset($data['telefono']) ? $data['telefono'] : '';
        $nueva_fecha_nacimiento = isset($data['fecha_nacimiento']) ? $data['fecha_nacimiento'] : '';
        $nuevo_grado = isset($data['grado']) ? $data['grado'] : '';
        $nueva_nacionalidad = isset($data['nacionalidad']) ? $data['nacionalidad'] : '';
        $nuevo_sexo = isset($data['sexo']) ? $data['sexo'] : '';
        $nueva_direccion = isset($data['direccion']) ? $data['direccion'] : '';

        $rspta = $estudiante->editar($cedula, $nuevo_nombre, $nuevo_primer_apellido, $nuevo_segundo_apellido, $nuevo_telefono, $nueva_fecha_nacimiento, $nuevo_grado, $nueva_nacionalidad, $nuevo_sexo, $nueva_direccion);
        echo json_encode($rspta ? ["mensaje" => "Estudiante actualizado"] : ["error" => "Estudiante no se pudo actualizar"]);
        break;

    case 'DELETE':
        // Ruta: /estudiantes/{cedula} (Eliminar)
        $cedula = isset($data['cedula']) ? $data['cedula'] : '';
        $rspta = $estudiante->eliminar($cedula);
        echo json_encode($rspta ? ["mensaje" => "Estudiante eliminado"] : ["error" => "Estudiante no se pudo eliminar"]);
        break;

    case 'GET':
        // Ruta: /estudiantes (Listar)
        $rspta = $estudiante->listar();
        if ($rspta) {
            echo json_encode($rspta);
        } else {
            echo json_encode(["mensaje" => "No hay registros"]);
        }
        break;

    default:
        echo json_encode(["error" => "Método no permitido"]);
        break;
}
?>
