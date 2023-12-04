<?php

session_start();

require("connectdb.php");


if(isset($_POST['id'])) {
    $id_task = $_POST['id'];
} else {
    header('Location: index.php');
}


$query = "SELECT * FROM task WHERE id_task = '$id_task'";
$execute_query = mysqli_query($db_connect, $query);
$record = mysqli_fetch_row($execute_query);

if ($record != null) {

    $id = $record['0'];
    $content = $record['2'];

    echo "<div class='modal-dialog'>
            <div class='modal-content'>
                    <form action='acciones/edittask.php' method='POST'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='staticBackdropLabel'>Editar tarea</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <div class='mb-3'>
                            <label for='edit' class='form-label'>Tarea</label>
                            <input type='text' class='form-control' id='task' name='task' value='$content' autocomplete='off' required>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                        <input type='hidden' name='editar' value='$id'>
                        <button type='submit' name='submitbtn' class='btn-principal'>Guardar cambios</button>
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
                        <p>Oh no... algo ha salido mal.</p>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                    </div>
            </div>
        </div>";
}