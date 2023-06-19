<?php

        require("connectdb.php");

        session_start();

        if(empty($_POST['username']) || empty($_POST['password']))  {
            header('Location: ../index.php?login=empty');
        } else {
            $usuario = $_POST['username'];
            $password = $_POST['password'];
        }
        
        $query = "SELECT username, password, admin FROM user where username = '$usuario' AND password = '$password';";
        $execute_query = mysqli_query($db_connect,$query);
        $record = mysqli_fetch_row($execute_query);

        if($record[0] == $usuario && $record[1] == $password) {
            $_SESSION['username'] = $usuario; 
            if($record[2] == 1){
                $_SESSION['is_admin'] = True;
            }
            header('Location: ../index.php');
        } else {
            header('Location: ../index.php?login=failed');
        }

?>