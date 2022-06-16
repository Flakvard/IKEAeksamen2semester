<?php
        require '../model/Products.php'; 
        session_start();             
        $sporttb=isset($_SESSION['sporttbl0'])?unserialize($_SESSION['sporttbl0']):new events();            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="../libs/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Add DIY Hack</h2>
                    </div>
                    <p>Please fill this form and submit to add DIY hack record in the database.</p>
                    <form action="ProductAdmin.php?act=add" method="post" >
                        <div class="form-group <?php echo (!empty($sporttb->category_msg)) ? 'has-error' : ''; ?>">
                            <label>DIY Hack Category</label>
                            <input type="text" name="category" class="form-control" value="<?php echo $sporttb->category; ?>">
                            <span class="help-block"><?php echo $sporttb->category_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($sporttb->name_msg)) ? 'has-error' : ''; ?>">
                            <label>DIY Hack Name</label>
                            <input name="name" class="form-control" value="<?php echo $sporttb->name; ?>">
                            <span class="help-block"><?php echo $sporttb->name_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($sporttb->description_msg)) ? 'has-error' : ''; ?>">
                            <label>DIY Hack step-by-step description</label>
                            <input name="description" class="form-control" value="<?php echo $sporttb->description; ?>">
                            <span class="help-block"><?php echo $sporttb->description_msg;?></span>
                            <input type='text' name='option' id='option' class="form-control" />
                            <br>
                            <button id='btnAdd'>Add Steps</button>
                        </div>
                        <div class="form-group <?php echo (!empty($sporttb->updatedAt_msg)) ? 'has-error' : ''; ?>">
                            <label>Upload photo of DIY Hack</label>
                            <input type="file" id="myFile" name="filename"<?php echo $sporttb->updatedAt; ?>">
                            <span class="help-block"><?php echo $sporttb->updatedAt_msg;?></span>
                        </div>
                        <input type="submit" name="addbtn" class="btn btn-primary" value="Submit">
                        <a href="ProductAdmin.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>