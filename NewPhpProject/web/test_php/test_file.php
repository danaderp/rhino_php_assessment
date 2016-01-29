<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $folder = "files/";
    opendir($folder);
    $destiny = $folder.$_FILES['csv_file']['name'];
    copy( $_FILES['csv_file']['tmp_name'], $destiny );
    echo 'The file was Uploaded successfully';
    $name = $_FILES['csv_file']['name'];
    echo $name;
?>
