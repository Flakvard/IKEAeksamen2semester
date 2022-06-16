<?php
require '../model/productClass.php';
require '../model/Products.php';
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
   
    public function list()
    {
        $result = $this->objsm->selectRecord(0);
        include "../view/listProducts.php";
    }
}
