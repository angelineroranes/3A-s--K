

<?php 

    include_once "../db_connection.php";

    $id = $_GET['id'];  

    if(!empty($id)){

        $sql = "SELECT * FROM materials WHERE material_id = $id;";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) == 0){
            header('Location: ./index.php?error=Material not found');
        }else{

            $sql = "UPDATE materials SET status = 'A' WHERE material_id = $id;";
            $query = mysqli_query($conn, $sql);
    
            if($query){
                header("Location: ./index.php?success=Material activated");
            }else{
                header("Location: ./index.php?error=Failed to activate");
            }
        }

    }else{
        header('Location: ./index.php?error=Material not found');
    }


?>