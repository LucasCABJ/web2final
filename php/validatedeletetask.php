<?php

        require("connectdb.php");

        $id_task = $_POST['id'];
        
        $query = "SELECT * FROM task WHERE id_task = '$id_task'";
        $execute_query = mysqli_query($db_connect,$query);
        $record = mysqli_fetch_row($execute_query);

        if($record != null) {

            $id = $record['0'];
            $content = $record['2'];

            echo "<div class='modal-dialog'>
            <div class='modal-content'>
                <form action='acciones/deletetask.php' method='POST'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='staticBackdropLabel'>Finalizar Tarea</h1>
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
        </div>";
        } else {
            echo "<div class='modal-dialog'>
            <div class='modal-content'>
                    <div class='modal-header'>
                        <p class='modal-title fs-5' id='staticBackdropLabel'>Finalizar tarea</p>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <p>Oh no... algo ha salido mal.</p>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                    </div>
            </div>
        </div>";
        }

?>