<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Affiche une table de CVT</title>
	    <script src="../assets/js/jquery-2.2.3.min.js"></script>
	    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="../assets/bootstrap-select-1.10.0/dist/js/bootstrap-select.min.js"></script>
		<script src="../assets/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
		<script src="../assets/bootstrap-datepicker-1.5.1-dist/js/bootstrap-datepicker.min.js"></script>
		<script src="../assets/bootstrap-table/bootstrap-table.min.js"></script>
		<link rel="stylesheet" href="../assets/bootstrap-datepicker-1.5.1-dist/css/bootstrap-datepicker.min.css" />
		<link rel="stylesheet" href="../assets/bootstrap-3.3.6-dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/bootstrap-3.3.6-dist/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="../assets/bootstrap-select-1.10.0/dist/css/bootstrap-select.min.css">
    	<link rel="stylesheet" href="../assets/bootstrap-table/bootstrap-table.min.css">

    </head>
    <style>
    form
    {
        text-align:center;
    }
    </style>

<body>
<table id="top10" data-toggle="table" class="table table-striped"
       	data-url=<?php echo 'top10.php'   	?> >

    <thead>
    <tr>
        <th data-field="code">Code</th>
        <th data-field="nbTot">Total</th>
        <th data-field="nbPos">(+)</th>
        <th data-field="nbNeg">(+)</th>
    </tr>
    </thead>
</table>
</body>
</html>