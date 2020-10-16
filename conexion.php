<?php
function retornarConexion()
{
    $conexion = mysqli_connect("localhost", "root", "", "proyecto3") or die("Problemas con la conexion");
    return $conexion;
}
