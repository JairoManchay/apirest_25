<?php
// Fuciones que seran accedidas por lo clientes

header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Headers:*');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Methods: DELETE');

include_once 'datos.php';

class Servicios
{

    // Servicio para la Vista
    function getVista()
    {
        $datos = new Datos();
        $lista = array();
        $res = $datos->Vista()->fetchAll();

        // Recorrer el arreglo de la consulta
        foreach ($res as $row) {
            // $r es un Array con la misma estructura de la tabla Curso
            $r["Id"] = $row["Id"];
            $r["Nombre"] = $row["Nombre"];
            $r['Apellido'] = $row['Apellido'];
            $r['Correo'] = $row['Correo'];
            array_push($lista, $r);
        }
        // json_encode -> Convertir un arreglo a un objeto JSON
        echo json_encode($lista);
    }


    // Servicio para BuscarCurso -> Luego crear la pagina php que lo ejecute
    function getBuscar($id)
    {
        $curso = new Datos();
        $lista = array();
        $res = $curso->Buscar($id);

        if ($res->rowCount() == 1) {
            $row = $res->fetch();
            $r["Id"] = $row["Id"];
            $r["Nombre"] = $row["Nombre"];
            $r['Apellido'] = $row['Apellido'];
            $r['Correo'] = $row['Correo'];
            array_push($lista, $r);
        } else {
            $r["Id"] = "";
            $r["Nombre"] = "";
            $r['Apellido'] = "";
            $r['Correo'] = "";
            array_push($lista, $r);
        }
        echo json_encode($lista);
    }


    function getNuevo($array)
    {
        $curso = new Datos();

        try {
            $curso->Nuevo($array);
            echo "El registro se inserto satisfactoriamente";
        } catch (Exception $e) {
            echo "El registro no se inserto";
        }
    }


    // Servicio para Actualizar
    function getActualizar($array)
    {
        $datos = new Datos();

        try {
            $datos->Actualizar($array);
            echo "El registro se actualizó satisfactoriamente";
        } catch (Exception $e) {
            echo "El registro no se actualizó";
        }
    }


    // Servicio para eliminar
    function getEliminar($id)
    {
        $datos = new Datos();
        try {
            $datos->Eliminar($id);
            echo "El registro se eliminó satisfactoriamente";
        } catch (Exception $e) {
            echo "El registro no se eliminó";
        }
    }
}
