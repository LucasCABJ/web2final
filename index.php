<?php

session_start();

?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | TP1</title>
    <link rel="icon" type="image/x-icon" href="./resources/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="./js/jquery-3.7.0.min.js"></script>
    <script src="js/checkregister.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php

    if (isset($_GET['login'])) {

        if ($_GET['login'] == 'empty' || $_GET['login'] == 'failed') {
            echo '<div class="alert alert-danger alert-dismissible fade show position-absolute" role="alert" style="z-index: 1000; right:5px; top: 100px;">
                    <strong>Usuario y/o contraseña incorrectos.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    } else if (isset($_GET['signup'])) {

        if ($_GET['signup'] == 'success') {
            echo '<div class="alert alert-success alert-dismissible fade show position-absolute" role="alert" style="z-index: 1000; right:5px; top: 100px;">
                    <strong>El usuario ha sido registrado exitosamente.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        } else if ($_GET['signup'] == 'confirmpassword') {
            echo '<div class="alert alert-danger alert-dismissible fade show position-absolute" role="alert" style="z-index: 1000; right:5px; top: 100px;">
                    <strong>Las contraseñas no coinciden.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        } else if ($_GET['signup'] == 'already_registered') {
            echo '<div class="alert alert-danger alert-dismissible fade show position-absolute" role="alert" style="z-index: 1000; right:5px; top: 100px;">
                    <strong>El usuario ya se encuentra registrado.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        } else if ($_GET['signup'] == 'error') {
            echo '<div class="alert alert-danger alert-dismissible fade show position-absolute" role="alert" style="z-index: 1000; right:5px; top: 100px;">
                    <strong>Usted ha ingresado datos invalidos.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        } else if ($_GET['signup'] == 'empty') {
            echo '<div class="alert alert-danger alert-dismissible fade show position-absolute" role="alert" style="z-index: 1000; right:5px; top: 100px;">
                    <strong>Alguno/s campo/s se encuentran vacio/s.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }

    ?>
    <!-- Modal -->
    <div class="modal fade" id="iniciarSesion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action='pages/validatelogin.php' method='POST'>
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Inicio de sesion</h1>
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
                        <div class="mb-3"><a class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">No tienes cuenta? Registrate</a></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" id="loginsubmitbtn" name="submitbtn" class="btn btn-primary">Iniciar
                            Sesion</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Formulario de Registro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action='pages/validateregister.php' method='POST'>
                        <div class="mb-3">
                            <label for="rusername" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="rusername" name='rusername' autocomplete="off" required>
                            <div id="usernameHelp" class="form-text usernameHelp">
                                <div id="usernameHelp1">- No puede contener espacios ni caracteres especiales.</div>
                                <div id="usernameHelp2">- Minimo 8 caracteres.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="rpassword" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="rpassword" name='rpassword' autocomplete="off" required>
                            <div id="passwordHelp" class="form-text passwordHelp">
                                <div>- No puede contener espacios.</div>
                                <div>- Debe contener al menos un caracter especial.</div>
                                <div>- Debe contener minusculas.</div>
                                <div>- Debe contener mayusculas.</div>
                                <div>- Debe contener al menos un numero.</div>
                                <div>- Minimo 8 caracteres.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="rconfirmpassword" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="rconfirmpassword" name='rconfirmpassword' autocomplete="off" required>
                            <div id="confirmPasswordHelp" class="form-text confirmPasswordHelp">
                                <div>- Vuelve a ingresar la contraseña</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="firstname" name='firstname' autocomplete="off" required>
                            <div id="firstnameHelp" class="form-text firstnameHelp">
                                <div>- Ingrese solo caracteres alfabeticos</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="lastname" name='lastname' autocomplete="off" required>
                            <div id="lastnameHelp" class="form-text lastnameHelp">
                                <div>- Ingrese solo caracteres alfabeticos</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name='dni' autocomplete="off" required>
                            <div id="dniHelp" class="form-text dniHelp">
                                <div id="dniHelp1">- Debe contener solo valores numericos y un minimo de 7 caracteres.</div>
                            </div>
                        </div>
                        <button type="submit" id="registersubmitbtn" name="submitbtn" class="btn btn-primary" disabled>Registrar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-target="#iniciarSesion" data-bs-toggle="modal">Volver a atrás</button>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg" style="position: relative; ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Programacion Web II</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <?php

                    if (isset($_SESSION['is_admin']) && isset($_SESSION['username'])) {
                        echo '
                                <li class="nav-item">
                                    <a class="nav-link" href="pages/usuarios.php?alumnosSearch=">Usuarios</a>
                                </li>';
                    }

                    if (isset($_SESSION['username'])) {
                        echo '<div class="dropdown d-lg-none">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                ' . $_SESSION['username'] . '
                                </button>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Ajustes</a></li>
                                <li><a class="dropdown-item text-danger" href="pages/logout.php">Cerrar sesion</a></li>
                                </ul>
                            </div>';
                    } else {
                        echo '<!-- Button trigger modal -->
                        <div class="dropdown d-lg-none">
                        <button type="button" class="btn btn-success d-block d-lg-none text-light float-end mt-3" data-bs-toggle="modal" data-bs-target="#iniciarSesion">
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
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  ' . $_SESSION['username'] . '
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Ajustes</a></li>
                  <li><a class="dropdown-item text-danger" href="pages/logout.php">Cerrar sesion</a></li>
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

    <section class="body_section">
        <div class="container">
            <div class="row">
                <div class="col-12 pt-5 d-flex justify-content-center align-items-center">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <h1 class="text-white">¡Actualmente nos encontramos desarrollando la página!</h1>
                        <img src="./resources/mantenimiento.png" alt="Dibujo reparacion" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>