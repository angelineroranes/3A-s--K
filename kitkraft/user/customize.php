<?php 
    session_start();
    include "../db_connection.php"; 


    if(empty($_SESSION['user_id'])){
        header("location: ../login.php");   
    } 

    if($_SESSION['user_type'] == 'A'){ 
        header("location: ../admin/index.php");   
    }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KitKraft | Student</title>
    
    
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">  
    
    <link rel="stylesheet" type="text/css" href="../styles.css" />
    
</head>
<body> 


    <nav style="z-index:10" class=" navbar fixed-top  shadow-lg navbar-expand-lg   navbar-light bg-light">
        
        <a class="navbar-brand" href="./index.php">KitKraft</a>

        <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
 
        <div class="navbar-collapse collapse " id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-md-0">
                <li  class="nav-item  ">
                    <a class="nav-link"  href="./index.php">Home</a>
                </li>  
                <li  class="nav-item  active">
                    <a class="nav-link "  href="./customize.php">Customize your own gift </a>
                </li>    
                <li  class="nav-item  ">
                    <a class="nav-link "  href="./orders.php">My Orders</a>
                </li>   
            </ul>
            <form class="form-inline my-lg-0 mr-3" action="./search.php" method="get">
                <input class="form-control form-control-sm mr-sm-2 " type="text" name="search" placeholder="Search" aria-label="Search">
                <button class="form-control btn btn-sm btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            
            <a href="../logout.php?id=<?php echo $_SESSION['user_id']; ?>" class="nav-item btn btn-sm btn-outline-danger d-block shadow-sm"> Log out </a> 
            
        </div>


    </nav>
    
    <div class="container-fluid padding-x pb-5 mt-5 pt-5"> 
        <div class="row  py-4  ">  
            <div class="col mb-4" > 
               
                <h1>Customize your order</h1>

            </div>   
        </div> 
        <form method="get" action="order-summary.php">  
            <?php 
                
            ?>
            <div class="row mb-4    d-flex justify-content-center    " >   
                <div class="col-12 col-md-4 d-flex justify-content-center">  
                    <input required min="1"  class="form-control form-control-lg full-width-sm" type="number" min="1" placeholder="Quantity" name="quantity">
                </div> 
            </div>

            <div class="row   gap-y"> 
                
                <div class="col-12 col-lg-6">
                    <h3 class="badge bg-color-1 text-white p-2">Step 1: Pick your gift container</h3>
                    <div class="row mt-2">   
                        <?php
                            $step_1 = "SELECT * FROM `materials` WHERE `step_id` = '1' AND stock > 0 AND STATUS = 'A';";
                            $result_step_1 = mysqli_query($conn, $step_1);  
                            if(mysqli_num_rows($result_step_1) > 0 ){
                                while($step1 = mysqli_fetch_assoc($result_step_1)){
                        ?>  
                                    <div class="col-sm-12 col-md-6 " >  
                                        <input hidden class="btn-check-step-1" type="radio" id="<?php echo $step1['material_id']; ?>" value='<?php echo $step1['material_id']; ?>' name="step_1" />
                                        <label for="<?php echo $step1['material_id']; ?>"  class="px-3 pt-3 w-100 rounded-lg hover-item btn  d-flex-column text-left">
                                            <h1 class="title text-truncate"><?php echo $step1['material_name']; ?> </h1>   
                                            <h4 class="sub-title">Price: <?php echo $step1['material_price']; ?></h4>
                                            <h4 class="sub-title ">Detail: <?php echo $step1['material_description']; ?></h4> 
                                            <h4 class="sub-title ">Stock: <?php echo $step1['stock']; ?></h4> 
                                        </label>
                                    </div>
                        <?php
                                }
                            }else{
                        ?>
                                <div class="col " >   
                                    <h1 style="cursor:not-allowed"  class="text-center px-2 py-5 h-100 w-100 rounded-lg hover-item">
                                        There is no available gift container
                                    </h1>
                                </div>
                        <?php
                            }
                        ?> 
                    </div> 
                </div>
 

                <div class="col-12 col-lg-6">
                    <h3 class="badge bg-color-1 text-white p-2">Step 2: Pick your preferred  flower</h3>
                    <div class="row mt-2">   
                        <?php
                            $step_2 = "SELECT * FROM `materials` WHERE `step_id` = '2' AND stock > 0 AND STATUS = 'A';";
                            $result_step_2 = mysqli_query($conn, $step_2);  
                            if(mysqli_num_rows($result_step_2) > 0 ){
                                while($step2 = mysqli_fetch_assoc($result_step_2)){
                        ?>  
                                    <div class="col-sm-12 col-md-6 " >  
                                        <input hidden class="btn-check-step-2 " type="radio" id="<?php echo $step2['material_id']; ?>" value='<?php echo $step2['material_id']; ?>' name="step_2" />
                                        <label for="<?php echo $step2['material_id']; ?>"  class="px-3 pt-3 w-100 rounded-lg hover-item btn  d-flex-column text-left">
                                            <h1 class="title text-truncate"><?php echo $step2['material_name']; ?> </h1>   
                                            <h4 class="sub-title">Price: <?php echo $step2['material_price']; ?></h4>
                                            <h4 class="sub-title ">Detail: <?php echo $step2['material_description']; ?></h4> 
                                            <h4 class="sub-title ">Stock: <?php echo $step2['stock']; ?></h4> 
                                        </label>
                                    </div>
                        <?php
                                }
                            }else{
                        ?>
                                <div class="col " >   
                                    <h1 style="cursor:not-allowed"  class="text-center px-2 py-5 h-100 w-100 rounded-lg hover-item">
                                        There is no available flower
                                    </h1>
                                </div>
                        <?php
                            }
                        ?> 
                    </div> 
                </div>
            </div>
    
            <div class="row  gap-y mt-4"> 

                <div class="col-12 col-lg-6">
                    <h3 class="badge badge-danger p-2">Step 3: Pick your decoration</h3>
                    <div class="row mt-2">   
                        <?php
                            $step_3 = "SELECT * FROM `materials` WHERE `step_id` = '3' AND stock != 0 AND STATUS = 'A';";
                            $result_step_3 = mysqli_query($conn, $step_3);  
                            if(mysqli_num_rows($result_step_3) > 0 ){
                                while($step3 = mysqli_fetch_assoc($result_step_3)){
                        ?>  
                                    <div class="col-sm-12 col-md-6 " >  
                                        <input hidden class="btn-check-step-3" type="radio" id="<?php echo $step3['material_id']; ?>" value='<?php echo $step3['material_id']; ?>' name="step_3" />
                                        <label for="<?php echo $step3['material_id']; ?>"  class="px-3 pt-3 w-100 rounded-lg hover-item btn  d-flex-column text-left">
                                            <h1 class="title text-truncate"><?php echo $step3['material_name']; ?> </h1>   
                                            <h4 class="sub-title">Price: <?php echo $step3['material_price']; ?></h4>
                                            <h4 class="sub-title ">Detail: <?php echo $step3['material_description']; ?></h4> 
                                            <h4 class="sub-title ">Stock: <?php echo $step3['stock']; ?></h4> 
                                        </label>
                                    </div>
                        <?php
                                }
                            }else{
                        ?>
                                <div class="col " >   
                                    <h1 style="cursor:not-allowed"  class="text-center px-2 py-5 h-100 w-100 rounded-lg hover-item">
                                        There is no available flower
                                    </h1>
                                </div>
                        <?php
                            }
                        ?> 
                    </div> 
                </div>


                <div class="col-12 col-lg-6">
                    <h3 class="badge badge-danger p-2">Step 4: Add ons</h3>
                    <div class="row mt-2">   
                        <?php
                            $step_4 = "SELECT * FROM `materials` WHERE `step_id` = '4' AND stock != 0  AND STATUS = 'A';";
                            $result_step_4 = mysqli_query($conn, $step_4);  
                            if(mysqli_num_rows($result_step_4) > 0 ){
                                while($step4 = mysqli_fetch_assoc($result_step_4)){
                        ?>  
                                    <div class="col-sm-12 col-md-6 " >  
                                        <input hidden class="btn-check-step-4" type="radio" id="<?php echo $step4['material_id']; ?>" value='<?php echo $step4['material_id']; ?>' name="step_4" />
                                        <label for="<?php echo $step4['material_id']; ?>"  class="px-3 pt-3 w-100 rounded-lg hover-item btn  d-flex-column text-left">
                                            <h1 class="title text-truncate"><?php echo $step4['material_name']; ?> </h1>   
                                            <h4 class="sub-title">Price: <?php echo $step4['material_price']; ?></h4>
                                            <h4 class="sub-title ">Detail: <?php echo $step4['material_description']; ?></h4> 
                                            <h4 class="sub-title ">Stock: <?php echo $step4['stock']; ?></h4> 
                                        </label>
                                    </div>
                        <?php
                                }
                            }else{
                        ?>
                                <div class="col " >   
                                    <h1 style="cursor:not-allowed"  class="text-center px-2 py-5 h-100 w-100 rounded-lg hover-item">
                                        There is no available flower
                                    </h1>
                                </div>
                        <?php
                            }
                        ?> 
                    </div> 
                </div>
            </div>
            
            <div class="row mt-4  ">
                <div class="d-flex col-12 justify-content-center">
                    
                    <button type="submit" name="order-now" class="btn btn-info " style="font-size:24px;padding: 5px 16px">
                        Order now 
                    </button>
                </div>
            </div> 
        </form>
    </div> 
        
    <script src="../bootstrap/jquery-3.2.1.slim.min.js"></script>
    <script src="../bootstrap/popper.min.js"></script>
    <script src="../bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>