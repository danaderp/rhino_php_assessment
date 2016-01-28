<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of facadePrintPHPClass
 *
 * @author david
 */
class facadePrintPHPClass {
    //put your code here
    public function printFacadeH1($description, $value){
        echo "<h1>$description : $value  <br/> </h1>";
    }
    
    public function printFacade($description, $value){
        echo "<b> $description </b> $value <br/> ";
    }
    
    public function printFacadeTable( $value ){
        echo "<td> $value </td> ";
    }
    
    public function printFacadeTableRaw($value){
        echo " $value ";
    }
}
