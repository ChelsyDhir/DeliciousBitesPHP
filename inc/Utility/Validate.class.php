<?php

class Validate {

    static $valid_status  = [];
   
    static function ValidateForm(){

        if($_POST){
            
            if(strlen($_POST['name'])==0){
                self::$valid_status ['name'] =  "Please enter a valid Name";
            }

            // Email should be email format
            $filteredEmail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            if(!$filteredEmail){
                self::$valid_status ['email'] = "Please enter a valid email address";
            }

            // password
                // should be a 7 digits string
                // both password and password confirm needs to be exactly similar
            if(strlen($_POST['password'])!=7){
                self::$valid_status ['password'] =  "Please enter a valid password of 7 digits";
            }  

            // password confirmation
            if(!($_POST['password2']==$_POST['password'])){
                self::$valid_status ['password2'] =  "Please re-check. Password didn't match. ";
            }

            //phone number verification
            $phone = (string) filter_input(INPUT_POST, 'phone', FILTER_VALIDATE_REGEXP,
                    array("options"=>array("regexp"=>"/^\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/")));
            if(!$phone){
                self::$valid_status ['phone'] = "Please enter a valid 10 digit phone number";
            }
        return self::$valid_status;
        }
    }
}
?>