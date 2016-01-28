<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of contactPHPClass
 *
 * @author david
 */
class contactPHPClass {
    
    private $name;
    private $surname;
    private $email1;
    private $email2;
    private $phone1;
    private $phone2;
    private $region;
    private $jdate;
    
    function getName() {
        return $this->name;
    }

    function getSurname() {
        return $this->surname;
    }

    function getRegion() {
        return $this->region;
    }

    function getJdate() {
        return $this->jdate;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }

    function setRegion($region) {
        $this->region = $region;
    }

    function setJdate($jdate) {
        $this->jdate = $jdate;
    }
    function getPhone1() {
        return $this->phone1;
    }

    function getPhone2() {
        return $this->phone2;
    }

    function setPhone1($phone1) {
        $this->phone1 = $phone1;
    }

    function setPhone2($phone2) {
        $this->phone2 = $phone2;
    }
    function getEmail1() {
        return $this->email1;
    }

    function getEmail2() {
        return $this->email2;
    }

    function setEmail1($email1) {
        $this->email1 = $email1;
    }

    function setEmail2($email2) {
        $this->email2 = $email2;
    }

    function __construct() {
       echo'this is a construction <br/>';
    }
    
    #Validating Functions
    
    #Name validation
    public function validateName($fname){
        #Name sorting
        if (substr_count($fname, ',') == 1) {
            $f_name = trim(strstr($fname, ' '));
            $f_surname = strstr($fname, ' ',true);
            $f_surname = substr($f_surname, 0, strlen($f_surname)-1);
        } else {
            $f_name = trim(strstr($fname, ' ', true));
            $f_surname = trim(strstr($fname, ' '));
        }
        
        self::setName($f_name);
        self::setSurname($f_surname);
    }
    
    #Phone number validation

    public function validatePhonenumber($phone) {
        if (empty(trim($phone))) {
            self::setPhone1('none');
            self::setPhone2('none');
        } else {
            $phone_regular = "/^[0-9]{1,3}-[0-9]{1,4}-[0-9]{1,14}$/";
            #Regular expression for E.164 format
            if (substr_count($phone, '/') == 1) {
                #Validation for two telephone numbers
                $phone1 = strstr($phone, '/', true);
                $phone2 = strstr($phone, '/');
                #Cleaning every char except 0-9
                $phone1 = preg_replace("/[^0-9]/", '', $phone1);
                $phone2 = preg_replace("/[^0-9]/", '', $phone2);
                #Preparing the format
                $phone1_ = substr_replace($phone1, '-', 3, 0);
                $phone1_ = substr_replace($phone1_, '-', 8, 0);

                $phone2_ = substr_replace($phone2, '-', 3, 0);
                $phone2_ = substr_replace($phone2_, '-', 8, 0);

                if (preg_match($phone_regular, $phone1_)) {
                    // $phone is valid
                    //Setting the phone numbers
                    self::setPhone1($phone1_);
                } else {
                    echo "<b> Telephone number(s) not valid 1 </b> $phone1_ <br/> ";
                }

                if (preg_match($phone_regular, $phone2_)) {
                    // $phone is valid
                    //Setting the phone numbers
                    self::setPhone2($phone2_);
                } else {
                    echo "<b> Telephone number(s) not valid 2 </b> $phone2_ <br/> ";
                }
            } else {
                $phone_ = preg_replace("/[^0-9]/", '', $phone);
                $phone_r = substr_replace($phone_, '-', 3, 0);
                $phone_r = substr_replace($phone_r, '-', 8, 0);

                if (preg_match($phone_regular, $phone_r)) {
                    // $phone is valid
                    //Setting the phone numbers
                    self::setPhone1($phone_r);
                } else {
                    echo "<b> Telephone number(s) not valid </b> $phone_r <br/> ";
                }
            }
        }
    }

    #E-mail validation
    public function validateEmail($femail){
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
        $email_ = str_replace('"', "", strtolower($femail) );
        if (substr_count($email_, ';') == 1) {
            #Validation for two e-mail
            $email1 = trim( strstr($email_, ';', true) );
            $email2 = strstr($email_, ';');
            #Delete the ; 
            $email2_ = trim( substr($email2, 1) ); 
            
            if ( preg_match($regex, $email1) ){
                // $regex is valid
                self::setEmail1($email1);
            } else {
                echo "<b> E-mail not valid </b> $email1 <br/> ";
            }
            
            if( preg_match($regex, $email2_)  ) {
                self::setEmail2($email2_);
            }else{
                echo "<b> E-mail not valid </b> $email2_ <br/> ";
            }
            
        } else {
            if (preg_match($regex, $email_)) {
                // $regex is valid
                self::setEmail1($email_);
            } else {
                echo "<b> E-mail not valid </b> $email_ <br/> ";
            }
        }
    }
    
    #Join date validation
    public function validateJoinDate($fjdate){
        #Casting string to datetime
        #$fjdate = preg_replace("/[^0-9]/", '', $fjdate);
        if( empty(trim($fjdate)) ){
            self::setJdate('none');
        }else{
            $time = strtotime(str_replace('/', '-', trim($fjdate)));
            $newformat = date('Y-m-d', $time);
            self::setJdate($newformat);
        }
    }
    
    #Region validation
    public function validateRegion( $fpublication, $fcontact, $femail, $ftrash1, $ftrash2, $fregion, $fjdate){
        if( empty(trim($fpublication)) &&
            empty(trim($fcontact)) &&
            empty(trim($femail)) &&
            empty(trim($ftrash1)) &&
            empty(trim($ftrash2)) &&   
            empty(trim($fregion)) &&  
            empty(trim($fjdate)) ){
            return true;
        }
    }
    
}
?>