<?php

        require("connectdb.php");

        session_start();

        if(isset($_SESSION['username'])) {
            header('Location: ./index.php');
        } else if (!isset($_POST['username']) || !isset($_POST['password']))  {
            header('Location: ./login.php?login=failed');
        } else {

            if(empty($_POST['username']) || empty($_POST['password'])) {
                header('Location: ./login.php?login=empty');
            } else {
                
                $usuario = $_POST['username'];
                $password = $_POST['password'];

            }
        }
        
        $query = "SELECT username, password, admin, id_user FROM user where username = '$usuario' AND password = '$password';";
        $execute_query = mysqli_query($db_connect,$query);
        $record = mysqli_fetch_row($execute_query);

        if($record[0] == $usuario && $record[1] == $password) {
            $_SESSION['username'] = $usuario; 
            $_SESSION['id'] = $record[3];
            if($record[2] == 1){
                $_SESSION['is_admin'] = True;
            }
            header('Location: ./index.php');
        } else {
            header('Location: ./login.php?login=failed');
        }

?>