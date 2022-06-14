<?php
// Include config file
require_once "../model/model.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = $navn = $efternavn = $tlf = $land = $by = $postnr = "";
$username_err = $password_err = $confirm_password_err = $navn_err = $efternavn_err = $tlf_err = $land_err = $by_err = $postnr_err = "";


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $sql = "SELECT UserID FROM user WHERE UserEmail = :username";
        $pdo = open_database_connection();
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $username_err = "This e-mail is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Validate navn
    if (empty(trim($_POST["navn"]))) {
        $navn_err = "Please enter a password.";
    } else {
        $navn = trim($_POST["navn"]);
    }

    // Validate efternavn
    if (empty(trim($_POST["efternavn"]))) {
        $efternavn_err = "Please enter a efternavn.";
    } else {
        $efternavn = trim($_POST["efternavn"]);
    }

    // Validate tlf
    if (empty(trim($_POST["tlfnr"]))) {
        $tlf_err = "Please enter a tlfnr.";
    } else {
        $tlf = trim($_POST["tlfnr"]);
    }

    // Validate by
    if (empty(trim($_POST["by"]))) {
        $by_err = "Please enter a by.";
    } else {
        $by = trim($_POST["by"]);
    }

    // Validate land
    if (empty(trim($_POST["land"]))) {
        $land_err = "Please enter a land.";
    } else {
        $land = trim($_POST["land"]);
    }

    // Validate postnr
    if (empty(trim($_POST["postnr"]))) {
        $postnr_err = "Please enter a postnr.";
    } else {
        $postnr = trim($_POST["postnr"]);
    }

    
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }


    
    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($navn_err) && empty($efternavn_err) && empty($tlf_err) && empty($postnr_err) && empty($land_err) && empty($by_err)) {

        // Prepare an insert statement
        $sql = 'CALL sp_insert_user_info(:UserEmail, :UserPassword, :UserFirstName, :UserLastName, :UserPhoneNo, @userid, :UserPostNo, :UserCity, :Country, :UserAddress, @contributoruserid)';
        //INSERT INTO user (UserEmail, UserPassword, UserFirstName, UserLastName, UserPhoneNo) VALUES (:UserEmail, :UserPassword, :UserFirstName, :UserLastName, :UserPhoneNo)

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":UserEmail", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":UserPassword", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":UserFirstName", $param_navn, PDO::PARAM_STR);
            $stmt->bindParam(":UserLastName", $param_efternavn, PDO::PARAM_STR);
            $stmt->bindParam(":UserPhoneNo", $param_tlf, PDO::PARAM_STR);
            //$stmt->bindParam(":userid", $param_userid, PDO::PARAM_STR);
            $stmt->bindParam(":Country", $param_land, PDO::PARAM_STR);
            $stmt->bindParam(":UserCity", $param_by, PDO::PARAM_STR);
            $stmt->bindParam(":UserPostNo", $param_postnr, PDO::PARAM_STR);
            $stmt->bindParam(":UserAddress", $param_address, PDO::PARAM_STR);
            //$stmt->bindParam(":contributoruserid", $param_contrid, PDO::PARAM_STR);

            // Set parameters
            $param_username = $username;
            $param_navn = $navn;
            $param_efternavn = $efternavn; 
            $param_tlf = $tlf;
            $param_land = $land;
            $param_by = $by;
            $param_postnr = $postnr;
            $param_address = "Address 2";
            //$param_userid = "@userid";
            //$param_contrid = "@contributoruserid";
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the stored procedure
            if ($stmt->execute()) {
                // Redirect to login page
                header("location: ../index.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);
}

?>