<?php
include 'db_conn.php';
if(isset($_SESSION['ID'])){
$uid = $_SESSION['ID'];
}
else{
    session_start();
    $uid = $_SESSION['ID'];
}
$sql = "SELECT * FROM todo WHERE UserID = $uid";
if(isset($_GET['del_result'])){
    $id = $_GET['del_result'];
    $sql = "DELETE FROM todo WHERE UserID=$uid AND ID=$id";
    $result = mysqli_query($conn, $sql);
    header('location: templates/ToDo.php');
}
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)){


?>
<html>
<li id="toDoBox"><div><p id="<?php echo $row['ID']; ?>"><?php echo $row['Text']; ?><a href="../show.php?del_result=<?php echo $row['ID']; ?>" id="del_btn">Delete</a></p></div></li>
</html>
<?php
    }
    }
?>