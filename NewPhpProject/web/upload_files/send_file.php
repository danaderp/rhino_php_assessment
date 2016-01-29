<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title> Send Files to Server </title>
    </head>
    <body>
        <form name="send_file_frm" method="post" action="upload_file.php" enctype="multipart/form-data" >
            <input type="file" name="file_fls" />
            <input type="submit" name="upload_btn" value="Upload" />
        </form>
    </body>    
</html>

