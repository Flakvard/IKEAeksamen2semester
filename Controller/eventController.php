<?php
require '../model/EventClass.php';
require '../model/Events.php';
require_once '../model/config.php';
require_once '../model/model.php';

session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

class eventController
{

    function __construct()
    {
        $this->objconfig = new config();
        $this->objsm =  new eventClass($this->objconfig);
    }
    // mvc handler request
    public function mvcHandler()
    {
        $act = isset($_GET['act']) ? $_GET['act'] : NULL;
        switch ($act) {
            case 'add':
                $this->insert();
                break;
            case 'update':
                $this->update();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                $this->list();
        }
    }
    // page redirection
    public function pageRedirect($url)
    {
        header('Location:' . $url);
    }
    // check validation
    public function checkValidation($sporttb)
    {
        $noerror = true;
        // Validate category        
        if (empty($sporttb->category)) {
            $sporttb->category_msg = "Field is empty.";
            $noerror = false;
        } elseif (!filter_var($sporttb->category, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
            $sporttb->category_msg = "Invalid entry.";
            $noerror = false;
        } else {
            $sporttb->category_msg = "";
        }
        // Validate name            
        if (empty($sporttb->name)) {
            $sporttb->name_msg = "Field is empty.";
            $noerror = false;
        } elseif (!filter_var($sporttb->name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
            $sporttb->name_msg = "Invalid entry.";
            $noerror = false;
        } else {
            $sporttb->name_msg = "";
        }
        // Validate description            
        if (empty($sporttb->description)) {
            $sporttb->description_msg = "Field is empty.";
            $noerror = false;
        } elseif (!filter_var($sporttb->description, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
            $sporttb->description_msg = "Invalid entry.";
            $noerror = false;
        } else {
            $sporttb->description_msg = "";
        }
        // Validate date            
        if (empty($sporttb->updatedAt)) {
            $sporttb->updatedAt_msg = "Field is empty.";
            $noerror = false;
        } elseif (!filter_var($sporttb->updatedAt, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/")))) {
            $sporttb->updatedAt_msg = "Invalid entry. Skrive YYYY-MM-DD. F.eks: 2022-12-31";
            $noerror = false;
        } else {
            $sporttb->updatedAt_msg = "";
        }
        return $noerror;
    }
    // add new record
    public function insert()
    {
        try {
            $sporttb = new events();
            if (isset($_POST['addbtn'])) {
                // read form value
                $sporttb->category = trim($_POST['category']);
                $sporttb->name = trim($_POST['name']);
                $sporttb->description = trim($_POST['description']);
                $sporttb->updatedAt = trim($_POST['updatedAt']);
                //call validation
                $chk = $this->checkValidation($sporttb);
                if ($chk) {
                    //call insert record            
                    $pid = $this->objsm->insertRecord($sporttb);
                    if ($pid > 0) {
                        $this->list(); //tilføjer eventet til listen af events 
                    } else {
                        echo "Somthing is wrong..., try again."; //hvis ikke noget id bliver returneret
                    }
                } else {
                    $_SESSION['sporttbl0'] = serialize($sporttb); //add session obj           
                    $this->pageRedirect("../view/insertEvent.php");
                }
            }
        } catch (Exception $e) {
            $this->close_db();
            throw $e;
        }
    }
    // delete record
    public function delete()
    {
        try {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $res = $this->objsm->deleteRecord($id);
                if ($res) {
                    $this->pageRedirect('../View/EventAdmin.php');
                } else {
                    echo "Somthing is wrong..., try again.";
                }
            } else {
                echo "Invalid operation.";
            }
        } catch (Exception $e) {
            $this->close_db();
            throw $e;
        }
    }
    // update record
    public function update()
    {
        try {

            if (isset($_POST['updatebtn'])) {
                $sporttb = unserialize($_SESSION['sporttbl0']);
                $sporttb->id = trim($_POST['id']);
                $sporttb->category = trim($_POST['category']);
                $sporttb->name = trim($_POST['name']);
                $sporttb->description = trim($_POST['description']);
                $sporttb->updatedAt = trim($_POST['updatedAt']);
                // check validation  
                $chk = $this->checkValidation($sporttb);
                if ($chk) {
                    $res = $this->objsm->updateRecord($sporttb);
                    if ($res) {
                        $this->list();
                    } else {
                        echo "Somthing is wrong..., try again.";
                    }
                } else {
                    $_SESSION['sporttbl0'] = serialize($sporttb);
                    $this->pageRedirect("../View/updateEvents.php");
                }
            } elseif (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
                $id = $_GET['id'];
                $result = $this->objsm->selectRecord($id);
                $row = mysqli_fetch_array($result);
                $sporttb = new events();
                $sporttb->id = $row["id"];
                $sporttb->name = $row["name"];
                $sporttb->category = $row["category"];
                $sporttb->description = $row["description"];
                $sporttb->updatedAt = $row["updatedAt"];
                $_SESSION['sporttbl0'] = serialize($sporttb);
                $this->pageRedirect('../view/updateEvents.php');
            } else {
                echo "Invalid operation.";
            }
        } catch (Exception $e) {
            $this->close_db();
            throw $e;
        }
    }
    public function list()
    {
        $result = $this->objsm->selectRecord(0);
        include "../view/listEvents.php";
    }
}
