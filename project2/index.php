<?php
session_start();
if(!isset($_SESSION["username"])){
    header("location:http://localhost/project1/login.php");
}else{
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Parking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center" id="header">
                   <h1> Parking Lot Management System</h1>
                   <div class="left">
                        <img src="images\l2.jpeg" alt="Logo">
                    </div>
                   <ul>
                       <li><a href="index.php">Home</a></li>
                       <li><a href="record.php">All Records</a></li>
                       <li><a href="admin.php">Add User</a></li>
                       <li><a  href="logout.php">Logout </a></li>
                       <!-- <li><a style="color: orange;" href="logout.php">Logout <?php echo $_SESSION['username']; ?></a></li> -->
                   </ul>
                   <div class="right">
                    <button class="myBtn">Contact Us</button>
                    <button class="myBtn">E-mail Us</button>
                   </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center mb-6">
                    <!-- <h2 class="register">Registration Form</h2> -->
                    <form action="save.php" method="post">
                    <div class="formWorks">
                    <h2 class="register">Registration Form</h2>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="owner">Vehicle Owner Name:&emsp;</span>
                        </div>
                        <input type="text" name="owner_name" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> Vehicle Name:&emsp;&emsp;&emsp;&emsp;</span>
                        </div>
                        <input type="text" name="vehicle_name" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> Vehicle Number:&emsp;&emsp;&emsp;</span>
                        </div>
                        <input type="text" name="vehicle_number" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> Entry Date:&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</span>
                        </div>
                        <input type="datetime-local" name="entry_date" class="form-control">
                    </div>
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Token Number:&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</span>
                        </div>
                        <input type="number" name="Token" class="form-control">
                    </div>
                   <input type="submit" class="btn btn-dark my-3">
                    </div> 
                    
                   </form>
                </div>
                <div class="col-md-6">                                 
                    <?php 
                     $conn = Mysqli_connect("localhost", "root", "", "parking_project") or die("conection failed!");
                     $sql = "SELECT * FROM Vehicle_info";
                     $result = mysqli_query($conn, $sql) or die("query Failed");
                     $num = mysqli_num_rows($result);
                    //  echo $num;
                    ?>
                    <!-- <div class="myC">
                    <div id="car">
                        <h2>Parking Space Information :</h2>
                        <h3>Total space :- <span> 50</span> </h3>
                        <?php
                            if($num != 50){
                                ?>
                                <h3>Parking Booked space :- <span><?php echo $num ?> </span> </h3>
                                <h3>Total Available space :- <span> <?php echo (50-$num) ?></span> </h3>
                                <?php
                            }else{                    
                                echo "<h3>Sorry for that No paking Space avialeble</h3>";
                            }
                        ?>
                    </div>
                    </div> -->
                    
                    <!-- <img src="images/car.png" class="car" style="width: 650px; height: 250px; margin-top: 100px;" alt="car picture"> -->
                    <!-- <img src="images/car.png" class="car" style="width: 650px; height: 250px; margin-top: 100px;" alt="car picture"> -->
                    
                </div>
            </div>
        </div> 
             
    </div>
    <div id="car">
                        <h2 class="tit" style="text-decoration:underline ;">Parking Space Information :</h2>
                        <div class="titBody">
                        <p>Total space : <span> 50</span> </p>
                        <?php
                            if($num != 50){
                                ?>
                                <p>Parking Booked space : <span><?php echo $num ?> </span> </p>
                                <p>Total Available space : <span> <?php echo (50-$num) ?></span> </p>
                                <?php
                            }else{                    
                                echo "<h3>Sorry for that No paking Space avialeble</h3>";
                            }
                        ?>
                        </div>
                        
                    </div>


    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="register1">All Vehicle Entry Records</h2>
                </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                   <div class="input-group">
                       <div class="input-group-prepend">
                           <span class="input-group-text" >Search</span>
                       </div>
                        <input type="text" class="form-control" onkeyup="search()" id="text" placeholder="Search Vehicle Details">
                   </div>
                   
                <table class="table table-striped" id="table" >
                    <?php
                        if($num>0){
                        ?>
                            <thead>
                        <tr>
                            <th>Owner Name</th>
                            <th>Vehicle Name</th>
                            <th>Vehicle Number</th>
                            <th>Entry Date</th>
                            <th>Token Number</th>
                            <th>Update Record</th>
                            <th>Delete Record</th>
                        </tr>
                    </thead>
                    <?php
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                   
                    <tbody>                      
                        <tr>
                            <td><?php echo $row['Owner_name']; ?></td>
                            <td> <?php echo $row['Vehicle_name']; ?> </td>
                            <td><?php echo $row['Vehicle_number']; ?></td>
                            <td> <?php echo $row['Entry_date']; ?></td>
                            <td><?php echo $row['Token_number']; ?></td>
                            <td><a href="update.php?Token_number=<?php echo $row['Token_number']?>">Exit Date</a></td>
                            <td><a href="delete-inline.php?Token_number=<?php echo $row['Token_number']?>">Delete</a></td>
                        </tr>  
                    </tbody>
                    <?php
                    }
                    ?>
                </table> 
                <?php
                }else{
                    echo "No Data found!";
                }
                    ?>         
               </div>
            </div>
        </div>
    </section>
    <script>    
        const search = () =>{
            var input_value = document.getElementById("text").value.toUpperCase();
            var table = document.getElementById("table");
            var tr = table.getElementsByTagName("tr");
            for(var i =0; i<tr.length; i++){
               td = tr[i].getElementsByTagName("td")[0];
               if(td){
                 var text_value = td.textContent;
                 if(text_value.toUpperCase().indexOf(input_value)>-1){
                    tr[i].style.display = "";
                 }else{
                    tr[i].style.display= "none";
                 }
               }
            }
        }   
    </script>
</body>
</html>

  <?php  
}
?>
