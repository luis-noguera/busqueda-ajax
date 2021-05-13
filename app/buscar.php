<?php

require_once 'conexion.php';

$salida = "";

if(!empty($_POST['consulta'])) {
    $consulta = filter_var($_POST['consulta']) ;
    $sql = "SELECT * FROM usuario WHERE id LIKE '%".$consulta."%' OR nombre LIKE '%".$consulta."%' OR apellido LIKE '%".$consulta."%' OR correo LIKE '%".$consulta."%'";
    $query = $pdo->prepare($sql);
    $query->execute();
}

if($resultado = $query->rowCount() > 0) {
    $salida .= '<table class="table table-bordered text-center">
    <thead class="thead-light">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Correo</th>
      </tr>
    </thead>
    <tbody>';

    while($fila = $query->fetch(PDO::FETCH_ASSOC)) {
        $salida.="<tr>
                <td>".$fila['id']."</td>
                <td>".$fila['nombre']."</td>
                <td>".$fila['apellido']."</td>
                <td>".$fila['correo']."</td>
            </tr>";
    }

    $salida.="</tbody></table>";

} else {
    $salida .= '<table class="table table-bordered text-center">
    <thead class="thead-light">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Correo</th>
      </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="4" class="text-center">NO HAY DATOS EN ESTA BUSQUEDA</td>
        </tr>
    </tbody></table>';
}
echo $salida;