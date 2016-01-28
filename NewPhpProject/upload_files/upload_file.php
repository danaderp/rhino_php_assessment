<?php

include "../entities/facadePrintPHPClass.php";
include "../entities/contactPHPClass.php";

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
$objPrint = new facadePrintPHPClass();


if ($_FILES['file_fls']['type'] == "text/csv") {
    move_uploaded_file($filename_, $destination_);
    echo 'Uploaded File <br>';
    $file = file($destination_);
    
    #Declaring region variable
    $region = none;
    
    #Reading lines within the file
    foreach ($file as $line) {
        #Splitting each line in the csv file
        list($fname, $fpublication, $fcontact, $femail, $ftrash1, $ftrash2, $fregion, $fjdate) = explode("|", $line);
   
        
        $objContact = new contactPHPClass();
             
        #Extracting region
        if( $objContact->validateRegion($fpublication, $fcontact, $femail, $ftrash1, $ftrash2, $fregion, $fjdate) ){
            $region = $fname;
            continue;
        }
        
        #Printing the name
        $objContact->validateName($fname);
        $objPrint->printFacadeH1( 'First Name', $objContact->getName() );
        $objPrint->printFacadeH1( 'Last Name', $objContact->getSurname() );

        #Printing the phone number
        $objContact->validatePhonenumber($fcontact);
        $objPrint->printFacade( 'First Phone Number', $objContact->getPhone1() );
        $objPrint->printFacade( 'Second Phone Number', $objContact->getPhone2() );

        #Printing E-mail 
        $objContact->validateEmail($femail);
        $objPrint->printFacade( 'First E-Mail', $objContact->getEmail1() );
        $objPrint->printFacade( 'Second E-Mail', $objContact->getEmail2() );  
        
        #Printing Region
        $objContact->setRegion($region);
        $objPrint->printFacade( 'Region', $objContact->getRegion() );
        
        #Printing Join Date
        $objContact->validateJoinDate($fjdate);
        $objPrint->printFacade( 'Join Date', $objContact->getJdate() );
    }
} else {
    die( "This file extension is not allowed <br/> <a href=\"send_file.php\">Send File</a>" );
}
