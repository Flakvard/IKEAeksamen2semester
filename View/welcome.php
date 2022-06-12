<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: loginTemplate.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to VisitFyn.</h1>
    
    

    <table style="width: 100%;">
    <tbody>
        <tr>
            <td style="width: 33.3333%;">
                <a href="EventAdmin.php" class="btn btn-secondary">Attraktioner <img src="../img/Attraktioner.png"></a>
            </td>
            <td style="width: 33.3333%;">
                 <a href="EventAdmin.php" class="btn btn-secondary">Spise Steder <img src="../img/SpiseSteder.png"></a>
            </td>
            <td style="width: 33.3333%;">
                <a href="EventAdmin.php" class="btn btn-secondary">Events <img src="../img/Events.png"></a>
            </td>
        </tr>
        <tr>
            <td style="width: 33.3333%;">
              <a href="EventAdmin.php" class="btn btn-secondary">Overnatning <img src="../img/Overnatning.png"></a>
            </td>
            <td style="width: 33.3333%;">
                 <a href="EventAdmin.php" class="btn btn-secondary">Aktiviteter <img src="../img/Aktiviteter.png"></a>
            </td>
            <td style="width: 33.3333%;">
                <a href="EventAdmin.php" class="btn btn-secondary">Konferencer <img src="../img/Konferencer.png"></a>
            </td>
        </tr>
        <tr>
            <td style="width: 33.3333%;">
               <a href="EventAdmin.php" class="btn btn-secondary">Transport <img src="../img/Transport.png"></a>
            </td>
            <td style="width: 33.3333%;">
                 <a href="EventAdmin.php" class="btn btn-secondary">Information <img src="../img/Information.png"></a>
            </td>
            <td style="width: 33.3333%; text-align: center;">
                <a href="EventAdmin.php" class="btn btn-secondary">Alle <img src="../img/Alle.png"></a>
            </td>
        </tr>
        <tr>
            <td style="width: 33.3333%;">
                <div data-empty="true" style="text-align: center;"><br></div>
            </td>
            <td style="width: 33.3333%;">
               <a href="Brugerside.php" class="btn btn-secondary">Bruger <img src="../img/Bruger.png"></a>
            </td>
            <td style="width: 33.3333%;">
                <div data-empty="true" style="text-align: center;"><br></div>
            </td>
        </tr>
    </tbody>
</table>

</body>
</html>