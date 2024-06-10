<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<title>Welcome to EMR Marketing</title>
	<meta name="author" content="EMR">
	<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
	<link rel="shortcut icon" href="favicon.ico">
	<base href="<?php echo $domain_url;?>">
	<!-- Vendor -->
	<link href="js/vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link href="js/vendor/slick/slick.css" rel="stylesheet">
	<link href="js/vendor/swiper/swiper.min.css" rel="stylesheet">
	<link href="js/vendor/magnificpopup/dist/magnific-popup.css" rel="stylesheet">
	<link href="js/vendor/nouislider/nouislider.css" rel="stylesheet">
	<link href="js/vendor/darktooltip/dist/darktooltip.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	
	<!-- Custom -->
	<link href="css/style.css" rel="stylesheet">
	<link href="css/megamenu.css" rel="stylesheet">
	<link href="css/tools.css" rel="stylesheet">

	<!-- Color Schemes -->
	<link href="css/style-color-blue.css" rel="stylesheet">
	
	<!-- Icon Font -->
	<link href="fonts/icomoon-reg/style.css" rel="stylesheet">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700|Raleway:100,100i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<script>
    function loadNavigation() {
        fetch('include/navigation.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('navigation-placeholder').innerHTML = data;
            })
            .catch(error => console.error('Error loading navigation:', error));
    }

    // Load the navigation content initially
    document.addEventListener('DOMContentLoaded', loadNavigation);

    // Set an interval to reload the navigation content every 30 seconds (30000 milliseconds)
    setInterval(loadNavigation, 30000);
    </script>
</head>