<?php
session_start();
//adds todo to database
include 'db/db_conn.php';
if (!empty($_POST['txt'])) { //checks if input is filled
    if (isset($_POST['txt'])) {
        function validate($data)
        {
            //clean up data
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $txt = validate($_POST['txt']);
        $id = $_SESSION['ID'];
        $sql = "INSERT INTO todo ( UserID,Text ) VALUES($id ,'$txt')"; //SQL request
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: templates/todo.php?success=ToDo erfolgreich hinzugefügt");
        } else {
            echo "Error : ($sql}" . mysqli_error($conn);
        }
    } else {
        echo "Error";
    }
} else {
    header("Location: templates/todo.php?error=Bitte Text einfügen");
}
?>