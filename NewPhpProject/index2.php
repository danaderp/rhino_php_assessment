<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
         echo "Hello, world! This is my first PHP project for Rhino Enterprise!";
        ?>
        
        <form action="test_php/test_file.php" method="post" enctype="multipart/form-data">
            <input type="file" name="csv_file" />
            <input type="submit" value="Upload" />
        </form>
    </body>
</html>