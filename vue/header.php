<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=9">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $pageTitle;?></title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../assets/bootstrap-table/bootstrap-table.min.css">
	<link rel="stylesheet" href="../../assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/vue.css" type="text/css">
    <!-- Custom Fonts -->
    <link href="../../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Quill Themes -->
    <link href="../../assets/css/quill.snow.css" rel="stylesheet">
	<link href="../../assets/css/quill.bubble.css" rel="stylesheet">
</head>

<body>
<h6>Constats disponibles du <?php echo $_SESSION['cvtDebut']. ' au '.$_SESSION['cvtFin']?></h6>
