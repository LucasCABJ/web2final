<?php

        require("connectdb.php");

        if(empty($_POST['id']))  {
            header('Location: ./usuarios.php?edit=empty');
        } else {
            $id = $_POST['id'];
        }
        
        $query = "SELECT * FROM user WHERE id_user = '$id'";
        $execute_query = mysqli_query($db_connect,$query);
        $record = mysqli_fetch_row($execute_query);

        if($record != null) {

            $id = $record['0'];
            $firstname = $record['1'];
            $lastname = $record['2'];
            $dni = $record['3'];
            if($record[6] == 1) {
                $isAdmin = "checked";
            } else {
                $isAdmin = "";
            }

            echo "<div class='modal-dialog'>
            <div class='modal-content'>
                    <form action='acciones/edit.php' method='POST'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='staticBackdropLabel'>Editar datos</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <div class='mb-3'>
                            <label for='firstName' class='form-label'>Nombre</label>
                            <input type='text' class='form-control' id='firstName' name='firstName' aria-describedby='emailHelp' value='$firstname' required>
                        </div>
                        <div class='mb-3'>
                            <label for='lastName' class='form-label'>Apellido</label>
                            <input type='text' class='form-control' id='lastName' name='lastName' value='$lastname' required>
                        </div>
                        <div class='mb-3'>
                            <label for='dni' class='form-label'>DNI</label>
                            <input type='text' class='form-control' id='dni' name='dni' value='$dni' required>
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
        </div>";
        } else {
            echo "<div class='modal-dialog'>
            <div class='modal-content'>
                    <div class='modal-header'>
                        <p class='modal-title fs-5' id='staticBackdropLabel'>Editar datos</p>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <p>Oh no... el usuario no se encuentra en la base de datos.</p>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                    </div>
            </div>
        </div>";
        }

?>