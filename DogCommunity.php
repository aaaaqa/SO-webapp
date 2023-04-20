<?php

print('<style>

titulo {
    text-align: center;
    text-transform: uppercase;
    color: #4CAF50;
  }

#tabla-con-estilo {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

#tabla-con-estilo td, #tabla-con-estilo th {
  border: 1px solid #ddd;
  padding: 8px;
}

#tabla-con-estilo tr:nth-child(even){background-color: #f2f2f2;}

#tabla-con-estilo tr:hover {background-color: #ddd;}

#tabla-con-estilo th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;



</style>');

$hostname = 'database-proyecto.cibjsg4po05d.us-east-1.rds.amazonaws.com';
$user = 'admin';
$password = 'NZ81kRLn0ObavBqieMiL';
$database = 'dog_community'; 
$port = 3306;
$mysqli = new mysqli($hostname, $user, $password, $database, $port);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}

/*
echo '<p>Connection OK '. $mysqli->host_info.'</p>';
echo '<p>Server '.$mysqli->server_info.'</p>';
echo '<p>Initial charset: '.$mysqli->character_set_name().'</p>';
*/

// Consultar datos con MySQLi
$dog = "select * from dog";
$resultado_dog = $mysqli->query($dog);
$user = "select x.name from user x join dog y where x.id = y.user_id";
$resultado_user = $mysqli->query($user);
$user_ = "select * from user";
$resultado_user_ = $mysqli->query($user_);

print("<header style='text-align:center; font-size:32px;'><strong>Comunidad para perros</strong></header>");
print("<hr>");

print("<h3>Perros</h3>");

print("<table id='tabla-con-estilo'>");
// Cabecera de Tabla
print("<tr>");
print("<th><b>Nombre</b></td>");
print("<th><b>Raza</b></td>");
print("<th><b>Edad</b></td>");
print("<th><b>Intereses</b></td>");
print("<th><b>Usuario</b></td>");
print("</tr>");

// Registros
while ($rows = $resultado_dog->fetch_assoc()) {
    $user_name = $resultado_user->fetch_assoc();
    print("<tr>");
    print("<td>" . $rows["name"] . "</td>");
    print("<td>" . $rows["breed"] . "</td>");
    print("<td>" . $rows["age"] . "</td>");
    print("<td>" . $rows["interests"] . "</td>");
    print("<td>" . $user_name["name"] . "</td>");
    print("</tr>");
}
print("</table>");

print("<h3>Usuarios</h3>");

print("<table id='tabla-con-estilo'>");
// Cabecera de Tabla
print("<tr>");
print("<th><b>Nombre</b></td>");
print("<th><b>Apellido</b></td>");
print("<th><b>Correo Electronico</b></td>");
print("</tr>");

while ($rows = $resultado_user_->fetch_assoc()) {
    print("<tr>");
    print("<td>" . $rows["name"] . "</td>");
    print("<td>" . $rows["lastname"] . "</td>");
    print("<td>" . $rows["email"] . "</td>");
    print("</tr>");
}
print("</table>");


$resultado_dog->free();
$resultado_user->free();
$resultado_user_->free();

$mysqli->close();
?>
