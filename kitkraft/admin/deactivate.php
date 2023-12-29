

<?php 

    include_once "../db_connection.php";
    session_start();
    if(empty($_SESSION['user_id'])){
        header("location: ../login.php?error=user_not_authenticated");   
    }
    if($_SESSION['user_type'] != 'A'){
        header("location: ../user/index.php");   
    }


    $id = $_GET['id'];  

    if(!empty($id)){

        $sql = "SELECT * FROM materials WHERE material_id = $id;";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) == 0){
            header('Location: ./index.php?error=Material not found');
        }else{

    
    
            $sql = "UPDATE materials SET status = 'I' WHERE material_id = $id;";
            $query = mysqli_query($conn, $sql);
    
            if($query){
                header("Location: ./index.php?success=Material deactivated");
            }else{
                header("Location: ./index.php?error=Failed to activate");
            }
        }

    }else{
        header('Location: ./index.php?error=Material not found');
    }


?>