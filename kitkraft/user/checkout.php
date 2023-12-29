<?php 
    require '../db_connection.php';
    session_start();

    if(empty($_SESSION['user_id'])){
        header("location: ../login.php");   
    }

    if($_SESSION['user_type'] == 'A'){ 
        header("location: ../admin/index.php");   
    }

    $id = $_SESSION['user_id'];
    $steps = [];
    $step1 = "";
    $step2 = "";
    $step3 = "";
    $step4 = ""; 
    if(!empty($_POST['step_1'])){
        array_push($steps, $_POST['step_1']);
        $step1 = $_POST['step_1'];
    }
    if(!empty($_POST['step_2'])){
        array_push($steps, $_POST['step_2']);
        $step2 = $_POST['step_2'];
    }
    if(!empty($_POST['step_3'])){
        array_push($steps, $_POST['step_3']);
        $step3 = $_POST['step_3'];
    }
    if(!empty($_POST['step_4'])){
        array_push($steps, $_POST['step_4']);
        $step4 = $_POST['step_4'];
    } 
    $quantity = $_POST['quantity'];
    $payment = $_POST['payment'];
    $total_price = $_POST['total_price'];

    if(isset($_POST['checkout'])){

        $sql = "INSERT INTO `orders`(`user_id`, `step1`, `step2`, `step3`, `step4`, `order_qty`, `order_status`, `type_of_payment`, `price`) VALUES ('$id','$step1','$step2','$step3','$step4','$quantity','P', '$payment', '$total_price');";

        for($a = 0; $a < count($steps); $a++){ 
            $exe_update_sql = "SELECT * FROM `materials` WHERE `material_id` = $steps[$a];";
            $fetch_update_sql = mysqli_query($conn, $exe_update_sql);
            $fetched_row = mysqli_fetch_assoc($fetch_update_sql);
            if($quantity > $fetched_row['stock']){
                return header("location: ./index.php?error=Not enough stock");
            } 
        }
    
        for($i = 0; $i < count($steps); $i++){ 
            $exe_update_sql = "UPDATE `materials` SET `stock` = `stock` - $quantity WHERE `material_id` = $steps[$i];";
            $fetch_update_sql = mysqli_query($conn, $exe_update_sql);
            
            if(!$fetch_update_sql){
                return header("location: ./index.php?error=Something went wronazg");
            } 
        }

        $result = mysqli_query($conn, $sql);
         
        if($result){
            header("location: ./pending.php?success=Order placed successfully");
        }else{
            header("location: ./index.php?error=Something went wrong");
        }
    }

?>