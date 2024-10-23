<?php
require('./database.php');

if(isset($_POST['delete'])){

    
    $deleteID = $_POST['deleteID'];
    $querrydelete = "DELETE FROM tbl1 WHERE ID = $deleteID";
    $sqldelete = mysqli_query($connection, $querrydelete);
    

    echo '<script>alert("Successfully Deleted")</script>';
    echo '<script>window.location.href = "/bsis3b-bpm-pgn/view_records.php"</script>';
}
?>