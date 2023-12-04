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
    <link rel="icon" type="image/x-icon" href="../imagenes/favicon.ico">
    <title>Usuarios | To-Do List</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/jquery-3.7.0.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/datatables.min.css" />
    <script src="../js/datatables.min.js"></script>
    <script>
        $(document).ready(function () {

            $('#myTable').DataTable({
                scrollX: true,
            });

        });

        function openEditModal(id) {

            $('#modal-editar').load('validateedit.php', {
                id: id,
            })
        }

        function openDeleteModal(id) {

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
    <link rel="stylesheet" href="../assets/fontawesome-free-6.4.2-web/css/all.min.css">
</head>

<body>

    <div id="particles-js"></div>

    <?php

    if (isset($_GET['edit'])) {

        if ($_GET['edit'] == 'failed') {
            echo '<div class="alert alert-danger alert-dismissible fade show position-absolute" role="alert" style="z-index: 1000; right:5px; top: 100px;">
                    <strong>Error al actualizar datos, por favor ingrese datos correctos.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        } else if ($_GET['edit'] == 'success') {
            echo '<div class="alert alert-success alert-dismissible fade show position-absolute" role="alert" style="z-index: 1000; right:5px; top: 100px;">
                    <strong>El usuario ha sido actualizado exitosamente.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        } else if ($_GET['edit'] == 'failed2') {
            echo '<div class="alert alert-danger alert-dismissible fade show position-absolute" role="alert" style="z-index: 1000; right:5px; top: 100px;">
                    <strong>Error al actualizar datos, por favor ingrese datos correctos. Además, no puedes quitarte los permisos de administrador!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }

    }


    ?>

    <!-- Modal ELIMINAR  -->
    <div class='modal fade' id='modal-eliminar' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1'
        aria-labelledby='staticBackdropLabel' aria-hidden='true'>
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
    <div class='modal fade' id='modal-editar' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1'
        aria-labelledby='staticBackdropLabel' aria-hidden='true'>
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
                            <input type='text' class='form-control' id='firstName' name='firstName'
                                aria-describedby='emailHelp' required>
                            <div id="editfirstNameHelp" class="form-text firstnameHelp">
                                <div>- Ingrese solo caracteres alfabeticos</div>
                            </div>
                        </div>
                        <div class='mb-3'>
                            <label for='lastName' class='form-label'>Apellido</label>
                            <input type='text' class='form-control' id='lastName' name='lastName' required>
                            <div id="editlastNameHelp" class="form-text firstnameHelp">
                                <div>- Ingrese solo caracteres alfabeticos</div>
                            </div>
                        </div>
                        <div class='mb-3'>
                            <label for='dni' class='form-label'>DNI</label>
                            <input type='text' class='form-control' id='dni' name='dni' required>
                            <div id="editdniHelp" class="form-text firstnameHelp">
                                <div>- Ingrese solo dígitos (mínimo 7)</div>
                            </div>
                        </div>
                        <div class='mb-3 form-check'>
                            <label class='form-check-label' for='adminCheck'>Administrador</label>
                            <input type='checkbox' class='form-check-input' id='adminCheck' name='admin' $isAdmin>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                        <input type='hidden' name='editar' value='$id'>
                        <button type='submit' name='submitbtn' class='btn-principal'>Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal LOGIN  -->
    <div class="modal fade" id="iniciarSesion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <input type="text" class="form-control" id="username" name='username'
                                aria-describedby="emailHelp" required>
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
                        <button type="submit" name="submitbtn" class="btn-principal">Iniciar
                            Sesion</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg" style="position: relative;">
        <div class="container-fluid">
            <a class="navbar-brand navbar__brand" href="index.php">
                <img src="../imagenes/todo.png" alt="To do list logo" width="40" height="40">
                <span class="fs-3 brand__text">To-Do list</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
                                <button class="btn-principal dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                ' . $_SESSION['username'] . '
                                </button>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" hr
                                ef="#">Ajustes</a></li>
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
                <button class="btn-principal dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                    <h1 class="mb-5 text-white">Panel administrador</h1>
                </div>
                <!--
                <div class="col-12 p-3 mb-3" style="border: 2px solid #434343">
                    <h3>Estadisticas</h3>
                    
                </div>
                -->
                <div class="col-12 p-3" style="border: 2px solid #434343; background-color: #212121;">
                    <h3>Usuarios</h3>
                    <table id="myTable" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre de usuario</th>
                                <th>Tareas asignadas</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>DNI</th>
                                <th>id_user</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $query = "SELECT * FROM user";

                            $execute_query = mysqli_query($db_connect, $query);

                            $count = 1;

                            while ($row = mysqli_fetch_assoc($execute_query)) {
                                $id_user = $row['id_user'];

                                $count_query = "SELECT COUNT(*) FROM task WHERE id_user = '$id_user'";

                                $execute_count_query = mysqli_query($db_connect, $count_query);

                                $result_count = mysqli_fetch_row($execute_count_query);

                                echo "<tr>";
                                echo "<th>" . $count . "</th>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $result_count[0] . "</td>";
                                echo "<td>" . $row['firstname'] . "</td>";
                                echo "<td>" . $row['lastname'] . "</td>";
                                echo "<td>" . $row['dni'] . "</td>";
                                echo "<td>" . $row['id_user'] . "</td>";
                                echo "<td>
                                        <div class='d-flex'>
                                            <button type='submit' class='btn btn-secondary text-light' onclick='openEditModal($id_user)' name='editar' data-bs-toggle='modal' data-bs-target='#modal-editar'><i class='fa-solid fa-pencil'></i></button>
                                            <button type='submit' class='ms-2 btn btn-danger text-light' onclick='openDeleteModal($id_user)' name='eliminar' data-bs-toggle='modal' data-bs-target='#modal-eliminar'><i class='fa-solid fa-trash-can'></i></button>
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

    <script src="../js/particles.js"></script>
    <script src="../js/app.js"></script>

</body>

</html>