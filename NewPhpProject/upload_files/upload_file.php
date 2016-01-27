<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

foreach ($_FILES['file_fls'] as $key => $value) {
    echo "Property: $key --- Value: $value <br/>";
}

$filename_ = $_FILES['file_fls']['tmp_name'];
$destination_ = 'files/' . $_FILES['file_fls']['name'];

if ($_FILES['file_fls']['type'] == "text/csv") {
    move_uploaded_file($filename_, $destination_);
    echo 'Uploaded File <br>';
    $file = file($destination_);
    foreach ($file as $line) {
        #Splitting each line in the csv file
        list($fname, $fpublication, $fcontact, $femail, $ftrash1, $ftrash2, $fregion, $fjdate) = explode("|", $line);

        if (substr_count($fname, ',') == 1) {
            $f_name = trim(strstr($fname, ' '));
            $f_surname = strstr($fname, ' ',true);
            $f_surname = substr($f_surname, 0, strlen($f_surname)-1);
        } else {
            $f_name = trim(strstr($fname, ' ', true));
            $f_surname = trim(strstr($fname, ' '));
        }

        echo "<h1>First name: $f_name  <br/> </h1>";
        echo "<h1>Last name: $f_surname  <br/> </h1>";

        #Telephone Number Validation 
        $phone = $fcontact;
        $phone_regular = "/^[0-9]{1,3}-[0-9]{1,4}-[0-9]{1,14}$/";
        #Regular expression for E.164 format
        if ( substr_count($phone, '/') == 1) {
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
                echo "<b> Telephone number(s) valid 1 </b> $phone1_ <br/> ";
            } else{
                echo "<b> Telephone number(s) not valid 1 </b> $phone1_ <br/> ";
            }
            
            if (preg_match($phone_regular, $phone2_)) {
                // $phone is valid
                echo "<b> Telephone number(s) valid 2 </b> $phone2_ <br/> ";
            } else{
                echo "<b> Telephone number(s) not valid 2 </b> $phone2_ <br/> ";
            }

        } else {
            $phone_ = preg_replace("/[^0-9]/", '', $phone);
            $phone_r = substr_replace($phone_, '-', 3, 0);
            $phone_r = substr_replace($phone_r, '-', 8, 0);

            if (preg_match($phone_regular, $phone_r)) {
                // $phone is valid
                echo "<b> Telephone number(s) valid </b> $phone_r <br/> ";
            } else{
                echo "<b> Telephone number(s) not valid </b> $phone_r <br/> ";
            }
        }

        echo "<b> Telephone number(s) </b> $fcontact <br/> ";

        #E-mail verification
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
        $email_ = str_replace('"', "", strtolower($femail) );
        #$email_ = strtolower($femail) ;
        if (substr_count($email_, ';') == 1) {
            #Validation for two e-mail
            $email1 = trim( strstr($email_, ';', true) );
            $email2 = strstr($email_, ';');
            #Delete the ; 
            $email2_ = trim( substr($email2, 1) ); 
            
            if ( preg_match($regex, $email1) ){
                // $regex is valid
                echo "<b> E-mail valid </b> $email1 <br/> ";
            } else {
                echo "<b> E-mail not valid </b> $email1 <br/> ";
            }
            
            if( preg_match($regex, $email2_)  ) {
                echo "<b> E-mail valid </b> $email2_ <br/> ";
            }else{
                echo "<b> E-mail not valid </b> $email2_ <br/> ";
            }
            
        } else {

            if (preg_match($regex, $email_)) {
                // $regex is valid
                echo "<b> E-mail valid </b> $email_ <br/> ";
            } else {

                echo "<b> E-mail not valid </b> $email_ <br/> ";
            }
        }
        
        echo "<b> E-mail </b> $email_ <br/> ";
        #Casting string to datetime
        $time = strtotime($fjdate);
        $newformat = date('Y-m-d', $time);
        echo "<b> Date </b> $newformat <br/> ";
    }
} else {
    echo "This file extension is not allowed <br/> <a href=\"send_file.php\">Send File</a>";
}
?>

