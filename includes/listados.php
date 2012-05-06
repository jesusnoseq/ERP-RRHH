<?php
function listadoEmpleadosBaja(MDB &$db) {
        $sql='select e.idEmpleado ID,
                    e.Nombre Nombre,
                    Apellidos,
                    fechaNac Nacimiento,
                    NIF,
                    NumSegSoc SS,
                    NumHijos Hijos,
                    numTelfFijo Fijo,
                    numTelfMovil Movil,
                    email Email,
                    direccion Direccion,
                    provincia Provincia,
                    comunidadAutonoma Comunidad,
                    pais Pais,
                    fechaInicio Inicio,
                    fechaFin Baja,
                    d.nombre Departamento,
                    c.nombre categoria,
                    c.salarioBase "Salario base"
                from empleado e,
                    interno i,
                    categoria c,
                    departamento d
                where e.idEmpleado=i.idEmpleado and
                    c.idCategoria=i.categoria and 
                    d.idDepartamento=i.departamento and
                    fechaFin<NOW();';
    $matriz=$db->getMatriz($db->consulta($sql));
    return $matriz;
}

?>