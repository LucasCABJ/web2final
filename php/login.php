<?php

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | To-Do List</title>
    <link rel="icon" type="image/x-icon" href="../imagenes/favicon.ico">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.7.0.min.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/checkregister.js"></script>
    <link rel="stylesheet" href="../assets/fontawesome-free-6.4.2-web/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <div id="particles-js"></div>

    <?php

    if (isset($_GET['login'])) {

        if ($_GET['login'] == 'failed') {
            echo '<div class="alert alert-danger alert-dismissible fade show position-absolute" role="alert" style="z-index: 1000; right:10px; top: 25px;">
                <strong>Usuario y/o contraseña incorrectos.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
    } else if (isset($_GET['signup'])) {

        if ($_GET['signup'] == 'success') {
            echo '<div class="alert alert-success alert-dismissible fade show position-absolute" role="alert" style="z-index: 1000; right:10px; top: 25px;">
                <strong>El usuario ha sido registrado exitosamente.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        } else if ($_GET['signup'] == 'confirmpassword') {
            echo '<div class="alert alert-danger alert-dismissible fade show position-absolute" role="alert" style="z-index: 1000; right:10px; top: 25px;">
                <strong>Las contraseñas no coinciden.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        } else if ($_GET['signup'] == 'already_registered') {
            echo '<div class="alert alert-danger alert-dismissible fade show position-absolute" role="alert" style="z-index: 1000; right:10px; top: 25px;">
                <strong>El usuario y dni ya se encuentra registrado.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        } else if ($_GET['signup'] == 'user_already_registered') {
            echo '<div class="alert alert-danger alert-dismissible fade show position-absolute" role="alert" style="z-index: 1000; right:10px; top: 25px;">
                <strong>El usuario ya se encuentra registrado.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        } else if ($_GET['signup'] == 'dni_already_registered') {
            echo '<div class="alert alert-danger alert-dismissible fade show position-absolute" role="alert" style="z-index: 1000; right:10px; top: 25px;">
                <strong>El dni ya se encuentran registrados.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        } else if ($_GET['signup'] == 'error') {
            echo '<div class="alert alert-danger alert-dismissible fade show position-absolute" role="alert" style="z-index: 1000; right:10px; top: 25px;">
                <strong>Usted ha ingresado datos invalidos.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        } else if ($_GET['signup'] == 'invalidspecialchar') {
            echo '<div class="alert alert-danger alert-dismissible fade show position-absolute" role="alert" style="z-index: 1000; right:10px; top: 25px;">
                <strong>El caracter especial ingresado no es valido.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        } else if ($_GET['signup'] == 'empty') {
            echo '<div class="alert alert-danger alert-dismissible fade show position-absolute" role="alert" style="z-index: 1000; right:10px; top: 25px;">
                <strong>Alguno/s campo/s se encuentran vacio/s.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
    }

    ?>

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
                        <div class="mb-3"><a class="btn-principal" data-bs-target="#exampleModalToggle2"
                                data-bs-toggle="modal">No tienes cuenta? Registrate</a></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" id="loginsubmitbtn" name="submitbtn" class="btn-principal">Iniciar
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
                        <button type="submit" id="registersubmitbtn" name="submitbtn" class="btn-principal"
                            disabled>Registrar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-target="#iniciarSesion" data-bs-toggle="modal">Volver a
                        atrás</button>
                </div>
            </div>
        </div>
    </div>

    <div class="layout">

        <div class="layout__container">

            <header class="layout__header">
                <h1 class="header__title">To-Do List</h1>
                <h3 class="header__subtitle">Mantené tu dia ordenado</h3>
            </header>

            <button type="button" class="btn-principal d-block text-light" data-bs-toggle="modal"
                data-bs-target="#iniciarSesion">Iniciar Sesion</button>

        </div>


    </div>

    <script src="../js/particles.js"></script>
    <script src="../js/app.js"></script>
</body>

</html>