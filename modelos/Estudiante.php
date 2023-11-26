<?php 

header("Access-Control-Allow-Origin: *");

// Permitir los métodos que se utilizarán
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

// Permitir ciertos encabezados
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Establecer la respuesta como JSON
header("Content-Type: application/json");

//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Estudiante
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($cedula, $nombre, $primer_apellido, $segundo_apellido, $telefono,
	 $fecha_nacimiento, $grado, $nacionalidad, $sexo, $direccion )
	{
		$sql="INSERT INTO estudiante (cedula, nombre, primer_apellido, segundo_apellido, telefono,
		fecha_nacimiento, grado, nacionalidad, sexo, direccion)
		VALUES ('$cedula','$nombre', '$primer_apellido', '$segundo_apellido', '$telefono',
	 '$fecha_nacimiento', '$grado', '$nacionalidad', '$sexo', '$direccion')";
		return EjecutarConsulta($sql);
	}


	public function editar($cedula, $nuevo_nombre, $nuevo_primer_apellido, $nuevo_segundo_apellido, $nuevo_telefono, $nueva_fecha_nacimiento, $nuevo_grado, $nueva_nacionalidad, $nuevo_sexo, $nueva_direccion) {
        $sql = "UPDATE estudiante SET nombre='$nuevo_nombre', primer_apellido='$nuevo_primer_apellido'
		, segundo_apellido='$nuevo_segundo_apellido', telefono='$nuevo_telefono', fecha_nacimiento='$nueva_fecha_nacimiento'
		, grado='$nuevo_grado', nacionalidad='$nueva_nacionalidad', sexo='$nuevo_sexo', direccion='$nueva_direccion' WHERE cedula='$cedula'";
        return EjecutarConsulta($sql);
    }

    public function mostrar($cedula) {
        $sql = "SELECT * FROM estudiante WHERE cedula='$cedula'";
        $resultado = EjecutarConsulta($sql);

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    public function eliminar($cedula) {
        $sql = "DELETE FROM estudiante WHERE cedula='$cedula'";
        return EjecutarConsulta($sql);
    }

    public function listar() {
        $sql = "SELECT * FROM estudiante";
        $resultado = EjecutarConsulta($sql);

        if ($resultado->num_rows > 0) {
            $estudiantes = array();

            while ($row = $resultado->fetch_assoc()) {
                $estudiantes[] = $row;
            }

            return $estudiantes;
        } else {
            return null;
        }
    }
}
?>