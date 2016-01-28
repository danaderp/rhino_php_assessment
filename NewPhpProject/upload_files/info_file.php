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
					<li><a href="#">Information File</a></li>
					<li><a href="elements.html">Elements</a></li>
				</ul>
			</nav>

		<!-- Main -->
                <section id="main" class="wrapper">
                    <div class="container">
                        <header class="major special">
                            <h2>CSV Information File</h2>
                            <p>Please provide a CSV file for analysing</p>
                        </header>

                        <!-- Text -->
                        <section id="three" class="wrapper style3 special">
                            <div class="inner">
                                <header class="major narrow">
                                    <h2>Send Files to Server</h2>
                                    <p>Please provide a CSV file for parsing</p>
                                </header>
                                <form name="send_file_frm" method="post" action="#info" enctype="multipart/form-data" >
                                    <ul class="actions">
                                        <li><input type="file" name="file_fls" /></li>
                                        <li><input type="submit" name="upload_btn" value="Upload" /></li>
                                    </ul>
                                </form>
                            </div>
                        </section>

                        <!-- Table -->
                        <section id="info">

                            <h4>CSV General Information</h4>
                            <div class="6u 12u$(xsmall)">
                                <ul class="alt">
                                    <?php
                                    foreach ($_FILES['file_fls'] as $key => $value) {
                                        echo "<li> Property[ $key ] ---> Value: $value </li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </section>


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