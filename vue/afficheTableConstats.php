<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=9">
        <title>Affiche une table de CVT</title>
	    <script src="../../assets//js/jquery-2.2.3.min.js"></script>
		<script src="../../assets//bootstrap-select/dist/js/bootstrap-select.min.js"></script>
		<script src="../../assets//bootstrap/js/bootstrap.min.js"></script>
		<script src="../../assets//bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="../../assets//bootstrap-table/bootstrap-table.min.js"></script>
		<script src="../../assets//bootstrap-table/extensions/export/bootstrap-table-export.min.js"></script>
		<script type="text/javascript" src="../../assets//tableExport/tableExport.min.js"></script>
		<script type="text/javascript" src="../../assets//tableExport/libs/FileSaver/FileSaver.min.js"></script> 
		<script type="text/javascript" src="../../assets//tableExport/libs/jsPDF/jspdf.min.js"></script> 
		<script type="text/javascript" src="../../assets//tableExport/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script> 
		<script type="text/javascript" src="../../assets//tableExport/libs/html2canvas/html2canvas.min.js"></script>
		<link rel="stylesheet" href="../../assets//bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
		<link rel="stylesheet" href="../../assets//bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../assets//bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="../../assets//bootstrap-select/dist/css/bootstrap-select.min.css">
    	<link rel="stylesheet" href="../../assets//bootstrap-table/bootstrap-table.min.css">

    </head>
    <style>
	    form
	    {
	        text-align:center;
	    }
	    th
	    {
		text-align:center;
		}
	
		h1 {text-align:center;}
		.logo-small {
	      color: #f4511e;
	      font-size: 50px;}
    </style>
<body>
<?php 
       	if (isset($_GET['serv_conc']))
       		{	$title= "Service concern&eacute; = ".$_GET['serv_conc'];
       			$urlBack="service.php?serv=".$_GET['serv_conc'];}
       	elseif (isset($_GET['serv_emet']))
       		{	$title= "Service &eacute;metteur = ".$_GET['serv_emet'];
       			$urlBack="service.php?serv=".$_GET['serv_emet'];}
       	elseif (isset($_GET['sp']))
       		{	$title= "Sous Processus = ".$_GET['sp'];
       			$urlBack="sp.php?sp=".$_GET['sp'];}   
       	elseif (isset($_GET['pci']))
       			{	$title= "Code PCI = ".$_GET['pci'];
       			$urlBack="siteTdb.php?mp=0";}
       	elseif (isset($_GET['keyword']))
       			{	$title= "Mot cl&eacute; ".$_GET['keyword'];
       			$urlBack="mot.php";}
       	else 
       		{	$title= "Code = ".$_GET['code'];
       			$urlBack="code.php?code=".$_GET['code'];
       		}
       	?>
<div class="container">
	<div class="row">
	    <div class="col-lg-1">
	        <p>
  				<br><a href="../index.php"><span class="glyphicon glyphicon-home logo-small"></span></a>
			</p>
	    </div>
	    <div class="col-lg-1">
	        <p>
  				<br><a href="<?php echo $urlBack; ?>"><span class="glyphicon glyphicon-circle-arrow-left logo-small"></span></a>
			</p>
		</div>
	    <div class="col-lg-8">
	        <h1 id="titre" class="page-header"><?php echo $title ?></h1>
	    </div>
	    <div class="col-lg-2">
	      <p></p>
	    </div>
	</div>
	<div id="toolbar">
		<!-- <button id="button" class="btn btn-default">Supprimer</button> -->
	  	<select class="form-control">
		    <option value="all">Export complet</option>
		    <option value="selected">Export Selection</option>
	 	 </select>
	</div>	
	<table id="tableCVT" data-toggle="table" 
       	data-url=<?php 
       	if (isset($_GET['serv_conc']))
       		{echo '../modele/jsonCvt.php?serv_conc='.$_GET['serv_conc']."&nature=".$_GET['nature'];}
       	elseif (isset($_GET['serv_emet']))
       		{echo '../modele/jsonCvt.php?serv_emet='.$_GET['serv_emet']."&nature=".$_GET['nature'];}
       	elseif (isset($_GET['sp']))
       		{echo '../modele/jsonCvt.php?sp='.$_GET['sp']."&nature=".$_GET['nature'];}
       	elseif (isset($_GET['pci']))
       		{echo '../modele/jsonCvt.php?pci='.$_GET['pci'];}
       	elseif (isset($_GET['keyword']))
       		{
       			$kw=str_replace("&", "%26",$_GET['keyword']);
       			$kw=str_replace(" ", "",$kw);
       			echo '../modele/jsonCvt.php?keyword='.$kw;}
		elseif (isset($_GET['keywordPtiRex']))
       		{
       			$kw=str_replace("&", "%26",$_GET['keywordPtiRex']);
       			$kw=str_replace(" ", "",$kw);
       			echo '../modele/jsonCvt.php?keywordPtiRex='.$kw;}
       	else 
       		{echo '../modele/jsonCvt.php?code='.$_GET['code']."&nature=".$_GET['nature'];}
       	?>
       	data-toolbar="#toolbar"    
	    data-search="true"
	    data-show-refresh="true"
	    data-show-toggle="false"
	    data-show-columns="true"
	    data-show-export="true"
	    data-detail-view="false"
	    data-minimum-count-columns="2"
	    data-show-pagination-switch="false"
	    data-pagination="true"
	    data-id-field="id"    
	    data-page-list="[10, 25, 50, 100, ALL]"
	    data-show-footer="false"
	    data-click-to-select="true"
	    >

	    <thead>
		    <tr>
		        <th data-field="state" data-checkbox="true"></th>
		        <!--<th data-field="operate" data_events="operateEvents" data-formatter="operateFormatter">Suppr</th>   -->
		        <th data-field="titre">Titre</th>
		        <th data-field="texte">CVT</th>
		        <th data-field="action">Actions Imm&eacute;diates</th>
		        <th data-field="serv_emet" data-align="center">Serv Emet</th>
		        <th data-field="serv_conc" data-align="center">Serv Conc</th>
		        <th data-formatter="actionFormatter" data-events="actionEvents">Reference</th>
		        <th data-field="Comp1" data-visible="false">Comp 1</th>
		        <th data-field="Comp2" data-visible="false">Comp 2</th>
		        <th data-field="Comp3" data-visible="false">Comp 3</th>
		    </tr>
	    </thead>
	</table>
</div>

<script type="text/javascript">
var $table = $('#tableCVT'),$button = $('#button');
var $remove = $('#remove');

function getIdSelections() {
    return $.map($table.bootstrapTable('getSelections'), function (row) {
        return row.id
    });
}

$table.on('check.bs.table uncheck.bs.table ' +
        'check-all.bs.table uncheck-all.bs.table', function () {
    $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);

    // save your data, here just save the current page
    selections = getIdSelections();
    // push or splice the selections if you want to save all data selections
});

function actionFormatter(value, row, index) {
    if (row[0].substr(0,3)== 'CVT') 
	{
	return [
        '<form class="form-horizontal" action="afficheCvt.php" method="post"><input type="submit" class="btn btn-info" name="cvt_ref" value="'+row[0]+'"></form>'
    ].join('');
	} else
	{	return [
        '<form class="form-horizontal" action="afficheFirex.php" method="post"><input type="submit" class="btn btn-info" name="fiche_ref" value="'+row[0]+'"></form>'
    ].join('');
	}

}
function operateFormatter(value, row, index) {
    return [
        '<a class="remove" href="javascript:void(0)" title="Remove">',
        '<i class="glyphicon glyphicon-remove"></i>',
        '</a>'
    ].join('');
}

window.operateEvents = {
    'click .remove': function (e, value, row, index) {
        $table.bootstrapTable('remove', {
            field: 'titre',
            values: [row.titre]
        });
    }
};

$remove.click(function () 
		{
		    var ids = getIdSelections();
		    $table.bootstrapTable('remove', 
		    	{
			        field: 'titre',
			        values: ids
		    	});
		    $remove.prop('disabled', true);
		});

$(function () {
	var $table = $('#tableCVT');
	$('#toolbar').find('select').change(function () {
    $table.bootstrapTable('refreshOptions', {
      exportDataType: $(this).val()
    });
  });
});



$(function () 
	{
		$button.click(function () 
		{
	    var ids = $.map($table.bootstrapTable('getSelections'), function (row) 
	    	{
	        	return row.titre;
	    	});
	    $table.bootstrapTable('remove', 
	    	{
		        field: 'titre',
		        values: ids
	    	});
    	});
	});

</script>
</body>
</html>