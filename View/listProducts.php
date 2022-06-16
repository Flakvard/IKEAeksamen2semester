<?php 
//session_unset(); 
//session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="../libs/fontawesome/css/font-awesome.css" rel="stylesheet" />    
    <link rel="stylesheet" href="../libs/bootstrap.css"> 
    <script src="../libs/jquery.min.js"></script>
    <script src="../libs/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <a href="welcome.php" class="btn btn-primary pull-left">Home</a>
                        <h2 class="pull-left">Product hack Details</h2>
                        <a href="insertProduct.php" class="btn btn-primary pull-right">Add New Product hack</a>
                    </div>
                    <?php
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";                                        
                                        echo "<th>Product hack Navn</th>";
                                        echo "<th>Product hack Category</th>";
                                        echo "<th>Product hack Sub category</th>";
                                        echo "<th>Product hack Image</th>";
                                        echo "<th>DIY Hack made by</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['ProductID'] . "</td>";                                        
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['CategoriesName'] . "</td>";
                                        echo "<td>" . $row['UnderCategoriesName'] . "</td>";
                                        echo "<td>" ."<img src="."'"."data:image/jpg;charset=utf8;base64," . base64_encode($row['PhotoUpload']) ."'". "width='400' height='300'". "/>" . "</td>";
                                        echo "<td>" . $row['Created by fname'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>