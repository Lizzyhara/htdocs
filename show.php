<?php
include 'db_conn.php';
if(isset($_SESSION['ID'])){
    $uid = $_SESSION['ID'];
}
else{
session_start();
//shows the todos
}
$uid = $_SESSION['ID'];
$sql = "SELECT * FROM todo WHERE UserID = $uid"; //SQL request
if (isset($_GET['del_result'])) { //get input
    $id = $_GET['del_result'];
    $sql = "DELETE FROM todo WHERE UserID=$uid AND ID=$id";
    $result = mysqli_query($conn, $sql);
    header('location: templates/todo.php');
}
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) { //if there todo are entriess in the database
    while ($row = mysqli_fetch_assoc($result)) {

        //show entries as a list (ul of list is in todo.pdf)
        //marks the textareas with their database ID and shows their text
        //delete button identifies them by their ID
        ?>
        <html>
        <li id="toDoBox">
            <div>
                <p><textarea id="<?php echo $row['ID']; ?>" onload="resize(this)"><?php echo $row['Text']; ?> </textarea><a
                        href="../show.php?del_result=<?php echo $row['ID']; ?>" id="del_btn">Delete</a></p>
            </div>
        </li>
        <script type="text/javascript" src="../static/txtarea.js"></script>
        </html>
        <?php
    }
}
?>