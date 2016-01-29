<!DOCTYPE HTML>
<!--
	Retrospect by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Elements - Retrospect by TEMPLATED</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="../template/assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
			<header id="header" class="skel-layers-fixed">
				<h1><a href="index.html">by David Alberto Nader</a></h1>
				<a href="#nav">Menu</a>
			</header>

		<!-- Nav -->
			<nav id="nav">
				<ul class="links">
					<li><a href="../index.html">Home</a></li>
                                        <li><a href="info_file.php">Information File</a></li>
				</ul>
			</nav>

		<!-- Main -->
                <section id="main" class="wrapper">
                    <div class="container">
                        <header class="major special">
                            <h2>Contact Table</h2>
                            <p>Information requested by
                                <?php
                                echo ' ' . htmlspecialchars($_POST["name"]) . ' - ' . htmlspecialchars($_POST["email"]);
                                ?>
                            </p>
                        </header>
                        
                        <?php
                        #Function for handling extension CSV exception
                        function checkCSV() {
                            if ($_FILES['file_fls']['type'] !== "text/csv") {
                                throw new Exception("This file extension is not allowed <br/> <a href=\"send_file.php\">Send File</a>");
                            }
                            return true;
                        }
                        ?>

                        <!-- Text -->
                        <section>
                            <h3>Parsed data from the file</h3>
                            <div class="table-wrapper">
                                <table class="alt">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Phone Number (01)</th>
                                            <th>Phone Number (02)</th>
                                            <th>E-Mail (01)</th>
                                            <th>E-Mail (02)</th>
                                            <th>Region</th>
                                            <th>Join Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include "../entities/facadePrintPHPClass.php";
                                        include "../entities/contactPHPClass.php";
                                        /*
                                         * To change this license header, choose License Headers in Project Properties.
                                         * To change this template file, choose Tools | Templates
                                         * and open the template in the editor.
                                         */

                                        $filename_ = $_FILES['file_fls']['tmp_name'];
                                        $destination_ = 'files/' . $_FILES['file_fls']['name'];
                                        $objPrint = new facadePrintPHPClass();
 
                                        #if ($_FILES['file_fls']['type'] == "text/csv") {
                                        try{
                                            #CSV Validation
                                            checkCSV();
                                            move_uploaded_file($filename_, $destination_);
                                            #echo 'Uploaded File <br>';
                                            $file = file($destination_);

                                            #Declaring region variable
                                            $region = none;

                                            #Reading lines within the file
                                            foreach ($file as $line) {
                                                #Splitting each line in the csv file
                                                list($fname, $fpublication, $fcontact, $femail, $ftrash1, $ftrash2, $fregion, $fjdate) = explode("|", $line);


                                                $objContact = new contactPHPClass();

                                                #Extracting region
                                                if ($objContact->validateRegion($fpublication, $fcontact, $femail, $ftrash1, $ftrash2, $fregion, $fjdate)) {
                                                    $region = $fname;
                                                    continue;
                                                }

                                                #Begin Row
                                                $objPrint->printFacadeTableRaw('<tr>');

                                                #Printing the name
                                                $objContact->validateName($fname);
                                                $objPrint->printFacadeTable($objContact->getName());
                                                $objPrint->printFacadeTable($objContact->getSurname());

                                                #Printing the phone number
                                                $objContact->validatePhonenumber($fcontact);
                                                $objPrint->printFacadeTable($objContact->getPhone1());
                                                $objPrint->printFacadeTable($objContact->getPhone2());

                                                #Printing E-mail 
                                                $objContact->validateEmail($femail);
                                                $objPrint->printFacadeTable($objContact->getEmail1());
                                                $objPrint->printFacadeTable($objContact->getEmail2());

                                                #Printing Region
                                                $objContact->setRegion($region);
                                                $objPrint->printFacadeTable($objContact->getRegion());

                                                #Printing Join Date
                                                $objContact->validateJoinDate($fjdate);
                                                $objPrint->printFacadeTable($objContact->getJdate());

                                                #End Row
                                                $objPrint->printFacadeTableRaw('</tr>');
                                            }
                                        } 
                                        catch (Exception $e ) {
                                            echo 'Message: ' .$e->getMessage();
                                            #die("This file extension is not allowed <br/> <a href=\"send_file.php\">Send File</a>");
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <!-- Table -->
                        <!-- Form -->

                    </div>
                </section>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<ul class="icons">
						<li><a href="#" class="icon fa-facebook">
							<span class="label">Facebook</span>
						</a></li>
						<li><a href="#" class="icon fa-twitter">
							<span class="label">Twitter</span>
						</a></li>
						<li><a href="#" class="icon fa-instagram">
							<span class="label">Instagram</span>
						</a></li>
						<li><a href="#" class="icon fa-linkedin">
							<span class="label">LinkedIn</span>
						</a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled.</li>
						<li>Images: <a href="http://unsplash.com">Unsplash</a>.</li>
						<li>Design: <a href="http://templated.co">TEMPLATED</a>.</li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="../template/assets/js/jquery.min.js"></script>
			<script src="../template/assets/js/skel.min.js"></script>
			<script src="../template/assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="../template/assets/js/main.js"></script>

	</body>
</html>
