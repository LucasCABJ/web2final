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

            echo "<div class='modal-dialog'>
            <div class='modal-content'>
                <form action='acciones/delete.php' method='POST'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='staticBackdropLabel'>Eliminar Permanentemente</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <p>A continuacion se borrara a <strong>$firstname $lastname</strong> de la base de datos.</p>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                        <input type='hidden' name='eliminar' value='$id'>
                        <button type='submit' name='submitbtn' class='btn btn-danger'>Eliminar</button>
                    </div>
                </form>
            </div>
        </div>";
        } else {
            echo "<div class='modal-dialog'>
            <div class='modal-content'>
                    <div class='modal-header'>
                        <p class='modal-title fs-5' id='staticBackdropLabel'>Eliminar datos</p>
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