<?php

require("connectdb.php");

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | To-Do List</title>
    <link rel="icon" type="image/x-icon" href="../imagenes/favicon.ico">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.7.0.min.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/checkregister.js"></script>
    <script>
        function openDeleteModal(id) {

            $('#modal-eliminar').load('validatedeletetask.php', {
                id: id,
            })

        }

        function openEditModal(id) {

            $('#modal-editar').load('validateedittask.php', {
                id: id,
            })

        }

        function toggleCheck(id) {

            $('#todo-list__tasks').load('validatecheck.php', {
                id: id,
            })

        }
    </script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.4.2-web/css/all.min.css">
</head>

<body>

    <div id="particles-js"></div>

    <!-- Edit task MODAL -->
    <div class='modal fade' id='modal-editar' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1'
        aria-labelledby='staticBackdropLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <form action='acciones/deletetask.php' method='POST'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='staticBackdropLabel'>Editar Tarea</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <p>A continuacion se finalizara la tarea: <strong>$content</strong></p>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                        <input type='hidden' name='eliminar' value='$id'>
                        <button type='submit' name='submitbtn' class='btn btn-danger'>Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete task MODAL -->
    <div class='modal fade' id='modal-eliminar' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1'
        aria-labelledby='staticBackdropLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <form action='acciones/deletetask.php' method='POST'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='staticBackdropLabel'>Finalizar Tarea</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <p>A continuacion se finalizara la tarea: <strong>Lorem</strong></p>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                        <input type='hidden' name='eliminar' value=''>
                        <button type='submit' name='submitbtn' class='btn btn-danger'>Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="iniciarSesion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action='validatelogin.php' method='POST'>
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Inicio de sesion</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="username" name='username'
                                aria-describedby="emailHelp" requered autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name='password' requered
                                autocomplete="off">
                        </div>
                        <div class="mb-3"><a class="btn btn-primary btn-principal" data-bs-target="#exampleModalToggle2"
                                data-bs-toggle="modal">No tienes cuenta? Registrate</a></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" id="loginsubmitbtn" name="submitbtn"
                            class="btn btn-primary btn-principal">Iniciar
                            Sesion</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Formulario de Registro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action='validateregister.php' method='POST'>
                        <div class="mb-3">
                            <label for="rusername" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="rusername" name='rusername' autocomplete="off"
                                required autocomplete="off">
                            <div id="usernameHelp" class="form-text usernameHelp">
                                <div id="usernameHelp1">- No puede contener espacios ni caracteres especiales.</div>
                                <div id="usernameHelp2">- Minimo 8 caracteres.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="rpassword" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="rpassword" name='rpassword'
                                autocomplete="off" required autocomplete="off">
                            <div id="passwordHelp" class="form-text passwordHelp">
                                <div id="passwordHelp1">- No puede contener espacios.</div>
                                <div id="passwordHelp2">- Debe contener al menos un caracter especial.</div>
                                <div id="passwordHelp3">- Debe contener minusculas.</div>
                                <div id="passwordHelp4">- Debe contener mayusculas.</div>
                                <div id="passwordHelp5">- Debe contener al menos un numero.</div>
                                <div id="passwordHelp6">- Minimo 8 caracteres.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="rconfirmpassword" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="rconfirmpassword" name='rconfirmpassword'
                                autocomplete="off" required autocomplete="off">
                            <div id="confirmPasswordHelp" class="form-text confirmPasswordHelp">
                                <div id="rconfirmpasswordHelp1">- Vuelve a ingresar la contraseña</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="firstName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="firstName" name='firstname' autocomplete="off"
                                required autocomplete="off">
                            <div id="firstNameHelp" class="form-text firstnameHelp">
                                <div>- Ingrese solo caracteres alfabeticos</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="lastName" name='lastname' autocomplete="off"
                                required autocomplete="off">
                            <div id="lastNameHelp" class="form-text lastnameHelp">
                                <div>- Ingrese solo caracteres alfabeticos</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name='dni' autocomplete="off" required
                                autocomplete="off">
                            <div id="dniHelp" class="form-text dniHelp">
                                <div id="dniHelp1">- Debe contener solo valores numericos y un minimo de 7 caracteres.
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="registersubmitbtn" name="submitbtn"
                            class="btn btn-primary btn-principal" disabled>Registrar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-target="#iniciarSesion" data-bs-toggle="modal">Volver a
                        atrás</button>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg" style="position: relative; ">
        <div class="container-fluid">
            <a class="navbar-brand navbar__brand" href="#">
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
                                    <a class="nav-link" href="usuarios.php">Usuarios</a>
                                </li>';
                    }

                    if (isset($_SESSION['username'])) {
                        echo '<div class="dropdown d-lg-none">
                                <button class="btn-principal dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                ' . $_SESSION['username'] . '
                                </button>
                                <ul class="dropdown-menu" style="right:0%; left:unset;">
                                <li><a class="dropdown-item" href="#">Ajustes</a></li>
                                <li><a class="dropdown-item text-danger" href="logout.php">Cerrar sesion</a></li>
                                </ul>
                            </div>';
                    } else {
                        echo '<!-- Button trigger modal -->
                        <div class="dropdown d-lg-none">
                        <button type="button" class="btn-success d-block d-lg-none text-light float-end mt-3" data-bs-toggle="modal" data-bs-target="#iniciarSesion">
                            Iniciar Sesion
                        </button>
                        </div>';
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
                <ul class="dropdown-menu" style="right:0%; left:unset;">
                  <li><a class="dropdown-item" href="#">Ajustes</a></li>
                  <li><a class="dropdown-item text-danger" href="logout.php">Cerrar sesion</a></li>
                </ul>
              </div>';
            } else {
                echo '<!-- Button trigger modal -->
                        <button type="button" class="btn-principal d-none d-lg-block text-light" data-bs-toggle="modal" data-bs-target="#iniciarSesion">
                            Iniciar Sesion
                        </button>';
            }
            ?>
        </div>
    </nav>

    <section class="container main">

        <?php

        if (isset($_SESSION['username'])) {

            echo '<header class="main__header">
                            <h2 class="mt-4 mb-3 main__title">¡Bienvenido ' . $_SESSION['username'] . '!</h2>
                      </header>

                      <section class="main__todo-list">

                            <section class="todo-list__form-container">

                        <form action="validatetask.php" class="todo-list__form" method="POST">

                            <label for="todo-task" class="todo-list__label fs-4">Agregar tarea:</label>
                            <div class="form-group">
                                <input id="todo-task" autocomplete="off" name="todo-task" type="text" class="todo-list__task fs-5" placeholder="Pasear al perro, entrenar, etc." required>
                                <button class="todo-submit"><i class="fa-solid fa-plus"></i></button>
                            </div>

                        </form>

                      </section>
                      <div class="todo-list__subtitle">
                        <h3 class="todo-list__subtitle-text fs-5">Estas son tus tareas pendientes</h3>
                      </div>
                      ';

            echo '<section id="todo-list__tasks" class="todo-list__tasks">';

            $id = $_SESSION['id'];
            $query = "SELECT * FROM task WHERE id_user  = '$id'";
            $execute_query = mysqli_query($db_connect, $query);

            $counter = 0;

            while ($result = mysqli_fetch_assoc($execute_query)) {
                $counter++;
                $task = $result['content'];
                $id_task = $result['id_task'];
                $icon = 'fa-check';
                $text_class = '';
                $btn_class = '';

                if ($result['completed'] == '1') {
                    $icon = 'fa-x';
                    $text_class = 'completed-task';
                    $btn_class = 'completed-task-btn';
                }

                echo "<div class='todo-list__task'>";
                echo "<div id='task-$id_task' class='todo-list__text $text_class'>$task</div>";
                // echo "<form class='todo-list__check-form' action='validatecheck.php' method='post'>";
                // echo "<input type='hidden' name='update' value='$id_task'>";
                echo "<button onclick='toggleCheck($id_task)' class='todo-list__checkbtn $btn_class text-light' name='editar'><i class='fa-solid $icon'></i></button>";
                // echo "</form>";
                echo "<button type='submit' class='todo-list__finishbtn btn btn-secondary text-light' onclick='openEditModal($id_task)' name='editar' data-bs-toggle='modal' data-bs-target='#modal-editar'><i class='fa-solid fa-pencil'></i></button>";
                echo "<button class='todo-list__finishbtn' onclick='openDeleteModal($id_task)' name='eliminar' data-bs-toggle='modal' data-bs-target='#modal-eliminar'><i class='fa-solid fa-trash-can'></i></button>";
                echo "</div>";

            }

            if ($counter == 0) {
                echo '<div class="todo-list__no-pending">
                    <p class="no-pending__text">No tienes ninguna tarea pendiente.</p>
                    </div>';
            }

            echo '</section>';

        } else {

            echo '<header class="main__header">
                            <h2 class="mt-5 main__title">Debes iniciar sesion para comenzar a usar To-Do List</h2>
                      </header>
                      ';
        }


        ?>
    </section>

    </section>

    <script src="../js/particles.js"></script>
    <script src="../js/app.js"></script>
    <script src="../js/checktask.js"></script>
</body>

</html>