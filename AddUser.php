<?php

print('<style>
@import url(\'https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap\');

html {
  scroll-behaviour: smooth;
}

body {
  font-family: \'Poppins\', sans-serif;
  line-height: 1.7px;
  color: white;
  background: #272626;
}

section {
  padding: 10px 0;
}
.topbar {
  background: #272626;
  color: white;
}
.tables {
  background: white;
  color: black;
  height:900px;
}

.container {
  width: 80%;
  margin: 0 auto;
}
.container_topbar {
  width:90%;
  margin: 0 auto;
  height:40px;
  margin-top:5px;
}
.container_credits {
  width:90%;
  height:60px;
  line-height:30px;
  text-align: center;
  vertical-align:center;
}

titulo {
    text-align: center;
    text-transform: uppercase;
    color: #4CAF50;
}

#tabla-con-estilo {
  border-collapse: collapse;
  width: 50%;
}

#tabla-con-estilo td, #tabla-con-estilo th {
  border: 1px solid #ddd;
  padding: 8px;
  color:black;
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

// Añadir una persona
error_reporting(E_ALL ^ E_WARNING ^ E_DEPRECATED);
if (isset($_POST['submit_person'])) {
    $nombre = $_POST['name'];
    $apellido = $_POST['lastname'];
    $correo = $_POST['email'];
    $password = $_POST['password_hash'];

    $salt = generateSalt();
    $hashed_password = crypt($password, $salt);

    $query = "INSERT INTO user (name, lastname, email, password_hash) VALUES ('$nombre', '$apellido', '$correo', '$hashed_password')";

    if ($mysqli->query($query) === TRUE) {
        $last_user_id = $mysqli->insert_id;
        echo "<p>Persona añadida correctamente.<br></p>";
        echo "<p><a href='AddDog.php?user_id=$last_user_id'>Añadir un perro a este usuario</a></p>";
    } else {
        echo "Error al añadir la persona: " . $mysqli->error . "<br>";
    }
}


function generateSalt() {
    $length = 22;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $salt = '';
    for ($i = 0; $i < $length; $i++) {
        $salt .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $salt;
}

print('
<section class="topbar" id="topbar">
  <div class="container container_topbar">
    <h1><b>Comunidad para perros</b></h1>
  </div>
</section>
');


print("<section class=\"tables\">");
print("<div class=\"container\">");


// Buttonbar
print('
<section class="buttonbar" id="buttonbar">
  <div class="container container_buttonbar">
    <a href="DogCommunity.php" class="btn">Inicio</a>
    <a href="AddUser.php" class="btn">Añadir</a>
  </div>
</section>
');

print("<h3>Añadir Persona</h3>");
print('
<form method="POST" action="">
    <label for="name">Nombre:</label>
    <input type="text" name="name" required>
    <label for="lastname">Apellido:</label>
    <input type="text" name="lastname" required>
    <label for="email">Correo electrónico:</label>
    <input type="text" name="email" required>
    <label for="password">Contraseña:</label>
    <input type="password" name="password" required>
    <input type="submit" name="submit_person" value="Añadir Persona">
</form>');


$mysqli->close();
?>
