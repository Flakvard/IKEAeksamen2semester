<?php
        require '../model/Events.php'; 
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
                        <h2>Update Events</h2>
                    </div>
                    <p>Please edit to change events record in the database.</p>
                    <form action="EventAdmin.php?act=update" method="post" >
                        <div class="form-group <?php echo (!empty($sporttb->category_msg)) ? 'has-error' : ''; ?>">
                            <label>Event Category</label>
                            <input type="text" name="category" class="form-control" value="<?php echo $sporttb->category; ?>">
                            <span class="help-block"><?php echo $sporttb->category_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($sporttb->name_msg)) ? 'has-error' : ''; ?>">
                            <label>Event Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $sporttb->name; ?> ">
                            <span class="help-block"><?php echo $sporttb->name_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($sporttb->description_msg)) ? 'has-error' : ''; ?>">
                            <label>Event Description</label>
                            <input type="text" name="description" class="form-control" value="<?php echo $sporttb->description; ?> ">
                            <span class="help-block"><?php echo $sporttb->description_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($sporttb->updatedAt_msg)) ? 'has-error' : ''; ?>">
                            <label>Event Date</label>
                            <input type="text" name="updatedAt" class="form-control" value="<?php echo $sporttb->updatedAt; ?> ">
                            <span class="help-block"><?php echo $sporttb->updatedAt_msg;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $sporttb->id; ?>"/>
                        <input type="submit" name="updatebtn" class="btn btn-primary" value="Submit">
                        <a href="EventAdmin.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>