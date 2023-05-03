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

// Añadir un perro
if (isset($_POST['submit_dog'])) {
    $nombre_perro = $_POST['name'];
    $raza = $_POST['breed'];
    $edad = $_POST['age'];
    $intereses = $_POST['interests'];
    $id_persona = $_POST['user_id'];

    $query_perro = "INSERT INTO dog (name, breed, age, interests, user_id) VALUES ('$nombre_perro', '$raza', '$edad', '$intereses', '$id_persona')";

    if ($mysqli->query($query_perro) === TRUE) {
        echo "<p>Perro añadido correctamente. <a href='AddDog.php?user_id=$id_persona'>Añadir otro perro</a></p>";
    } else {
        echo "Error al añadir el perro: " . $mysqli->error;
    }
}

$last_user_id = $_GET['user_id'];

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


print("<h3>Añadir Perro</h3>");
print('
<form method="POST" action="">
    <input type="hidden" name="user_id" value="' . $last_user_id . '">
    <label for="name">Nombre del Perro:</label>
    <input type="text" name="name" required>
    <label for="breed">Raza:</label>
    <input type="text" name="breed" required>
    <label for="age">Edad:</label>
    <input type="text" name="age" required>
    <label for="interests">Intereses:</label>
    <input type="text" name="interests" required>
    <input type="submit" name="submit_dog" value="Añadir Perro">
    
</form>');

$mysqli->close();
?>
