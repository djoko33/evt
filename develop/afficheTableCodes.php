<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Affiche la table des codes</title>
	    <script src="../assets/js/jquery-2.2.3.min.js"></script>
		<script src="../assets/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
		<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="../assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="../assets/bootstrap-table/bootstrap-table.min.js"></script>
		<link rel="stylesheet" href="../assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
		<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="../assets/bootstrap-select/dist/css/bootstrap-select.min.css">
    	<link rel="stylesheet" href="../assets/bootstrap-table/bootstrap-table.min.css">

    </head>
    <style>
    form
    {
        text-align:center;
    }
    </style>

<body>
<table id="tableCodes" data-toggle="table"
       	data-url="jsonCodes.php"
       	data-toolbar="#toolbar"    
	    data-search="true"
	    data-show-refresh="true"
	    data-show-toggle="true"
	    data-show-columns="true"
	    data-show-export="true"
	    data-detail-view="false"
	    data-minimum-count-columns="2"
	    data-show-pagination-switch="true"
	    data-pagination="true"
	    data-id-field="id"    
	    data-page-list="[10, 25, 50, 100, ALL]"
	    data-show-footer="false">

    <thead>
    <tr>
        <th data-field="quad">Code</th>
        <th data-field="libelle">Libelle</th>
        <th data-field="categorie">Categorie</th>
        <th data-field="libelle_court">Libelle Court</th>
        <th data-formatter="actionFormatter" data-events="actionEvents">Reference</th>
    </tr>
    </thead>
</table>
</body>
<script type="text/javascript">
function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}
document.getElementById("tableCVT").data-url = jsonCVT.php;
document.getElementById("tableCVT").data-search = false;


function actionFormatter(value, row, index) {
    return [
        '<form class="form-horizontal" action="afficheCode.php" method="post">Modifier : <input type="submit" class="btn btn-info" name="quad" value="'+row[0]+'"></form>'
    ].join('');
}
</script>
</html>