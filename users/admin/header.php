<?php 
	include_once '../../includes/config.php';

	session_start();

	if (!isset($_SESSION['admin_name'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: ../../index.php');
    }

	if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['admin_name']);
        header("location: ../../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
  	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<title>Pampanga's Inasal | Dashboard</title>
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<!----css3---->
		<link rel="stylesheet" href="../../assets/css/dashboard.css">
        <link rel="icon" type="image/x-icon" href="../../assets/images/favicon.ico">
			
		
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!--google fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
		<!--google material icon-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
		<link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
		<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
		
		
		<!-- SCRIPTS -->
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

		<!-- Include jQuery library -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<!-- Include jQuery UI library -->
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

		<!-- Include jQuery UI stylesheet -->
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

		<!-- Include BOOTSTRAP JS -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

		<!-- Include CHART.JS -->
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  	</head>
  	<body>
		<div class="wrapper">
			<div class="body-overlay"></div>