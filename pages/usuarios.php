<?php

session_start();

require("connectdb.php");

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
} else if (!isset($_SESSION['is_admin'])) {
    if ($_SESSION['is_admin'] != 1) {
        header('Location: ../index.php');
    }
}

$fullUrl = 'http//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../resources/favicon.ico">
    <title>Usuarios | TP1</title>
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {

            $('#myTable').DataTable({
                scrollX: true,
            });

        });

        function openEditModal(id) {
            console.log(id);

            $('#modal-editar').load('validateedit.php', {
                id: id,
            })
        }

        function openDeleteModal(id) {
            console.log(id);

            $('#modal-eliminar').load('validatedelete.php', {
                id: id,
            })
        }
    </script>
    <style>
        option {
            background-color: #212121;
            color: #fff;
        }

        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <!-- Modal ELIMINAR  -->
    <div class='modal fade' id='modal-eliminar' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <form action='acciones/delete.php' method='POST'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='staticBackdropLabel'>Eliminar Permanentemente</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <p>A continuacion se borrara a <strong>$row[1] $row[2]</strong> de la base de datos.</p>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                        <input type='hidden' name='eliminar' value='$row[0]'>
                        <button type='submit' name='submitbtn' class='btn btn-danger'>Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal EDITAR  -->
    <div class='modal fade' id='modal-editar' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <form action='acciones/edit.php' method='POST'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='staticBackdropLabel'>Editar datos</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <div class='mb-3'>
                            <label for='firstName' class='form-label'>Nombre</label>
                            <input type='text' class='form-control' id='firstName' name='firstName' aria-describedby='emailHelp' required>
                        </div>
                        <div class='mb-3'>
                            <label for='lastName' class='form-label'>Apellido</label>
                            <input type='text' class='form-control' id='lastName' name='lastName' required>
                        </div>
                        <div class='mb-3'>
                            <label for='dni' class='form-label'>DNI</label>
                            <input type='text' class='form-control' id='dni' name='dni' required>
                        </div>
                        <div class='mb-3 form-check'>
                            <label class='form-check-label' for='adminCheck'>Administrador</label>
                            <input type='checkbox' class='form-check-input' id='adminCheck' name='admin' $isAdmin>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                        <input type='hidden' name='editar' value='$id'>
                        <button type='submit' name='submitbtn' class='btn btn-primary'>Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal LOGIN  -->
    <div class="modal fade" id="iniciarSesion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action='pages/validatelogin.php' method='POST'>
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Formulario de ingreso</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="username" name='username' aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name='password' required>
                        </div>
                        <?php

                        $finalUrl = "http//" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

                        if (strpos($finalUrl, 'login=notfound')) {
                            echo '<div class="alert alert-danger">Usuario y/o contraseña incorrectos.</div>';
                        } elseif (strpos($finalUrl, 'login=empty')) {
                            echo '<div class="alert alert-danger">Algunos campos se encuentran vacios.</div>';
                        }

                        ?>
                        <div class="mb-3"><a href="pages/register.php" class="fs-6">¿No tienes cuenta?
                                Registrate</a></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="submitbtn" class="btn btn-primary">Iniciar
                            Sesion</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg" style="position: relative;">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Programacion Web II</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <?php

                    if (isset($_SESSION['is_admin']) && isset($_SESSION['username'])) {
                        echo '
                                <li class="nav-item">
                                    <a class="nav-link" href="./usuarios.php?alumnosSearch=">Usuarios</a>
                                </li>';
                    }

                    if (isset($_SESSION['username'])) {
                        echo '<div class="dropdown d-lg-none">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                ' . $_SESSION['username'] . '
                                </button>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Ajustes</a></li>
                                <li><a class="dropdown-item text-danger" href="./logout.php">Cerrar sesion</a></li>
                                </ul>
                            </div>';
                    } else {
                        echo '<!-- Button trigger modal -->
                        <button type="button" class="btn btn-success d-block d-lg-none text-light" data-bs-toggle="modal" data-bs-target="#iniciarSesion">
                            Iniciar Sesion
                        </button>';
                    }
                    ?>
                </ul>
            </div>
            <?php

            if (isset($_SESSION['username'])) {
                echo '<div class="dropdown d-none d-lg-block">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  ' . $_SESSION['username'] . '
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Ajustes</a></li>
                  <li><a class="dropdown-item text-danger" href="./logout.php">Cerrar sesion</a></li>
                </ul>
              </div>';
            } else {
                echo '<!-- Button trigger modal -->
                        <button type="button" class="btn btn-success d-none d-lg-block text-light" data-bs-toggle="modal" data-bs-target="#iniciarSesion">
                            Iniciar Sesion
                        </button>';
            }
            ?>
        </div>
    </nav>
    <section>
        <div class="container p-5">
            <div class="row">
                <div class="col-12">
                    <h1 class="mb-5">Usuarios</h1>
                </div>
                <div class="col-12 p-3" style="border: 2px solid #434343">
                    <table id="myTable" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>DNI</th>
                                <th>Nombre de usuario</th>
                                <th>id_user</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $query = "SELECT * FROM user";

                            $execute_query = mysqli_query($db_connect, $query);

                            $count = 1;

                            while ($row = mysqli_fetch_array($execute_query)) {

                                echo "<tr>";
                                echo "<th>" . $count . "</th>";
                                echo "<td>" . $row[1] . "</td>";
                                echo "<td>" . $row[2] . "</td>";
                                echo "<td>" . $row[3] . "</td>";
                                echo "<td>" . $row[4] . "</td>";
                                echo "<td>" . $row[0] . "</td>";
                                echo "<td>
                                        <div class='d-flex'>
                                            <button type='submit' class='btn btn-secondary text-light' onclick='openEditModal($row[0])' name='editar' data-bs-toggle='modal' data-bs-target='#modal-editar'>Editar</button>
                                            <button type='submit' class='ms-2 btn btn-danger text-light' onclick='openDeleteModal($row[0])' name='eliminar' data-bs-toggle='modal' data-bs-target='#modal-eliminar'>Delete</button>
                                        </div>
                                  </td>";

                                $count += 1;
                                echo '</tr>';
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script src="../js/alumnos.js"></script>
</body>

</html>