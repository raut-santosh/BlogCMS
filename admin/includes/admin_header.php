<?php include "../includes/db.php" ?>
<?php include "functions.php" ?>

<?php ob_start(); ?>
<?php session_start(); ?>

<!-- validating user is admin or subscriber -->
<!-- if it is admin then only redirect to admin either redirect back to index page -->

<?php

// Checking if userrole is not set then redirect to index to logout that user from admin 
    if(!isset($_SESSION['user_role'])){
        header("Location: ../index.php");
    }

?>




<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="css/styles.css" rel="stylesheet">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- By me For Text Editor -->
    <!-- <script type="text/javascript" src="../ckeditor/ckeditor.js"></script> -->
  

        <!-- By Course but not working -->
        <script src="../ckeditor/ckeditor.js"></script> 
    
</head>

<body>