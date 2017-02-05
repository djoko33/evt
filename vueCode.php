<?php
session_start();
include_once 'session.php';

$pageTitle="Exploitation Visites Terrain - CVT par Code";
include_once 'header.php';
include_once 'connexionPG.php';
//prepare un tableau de correspondance code 1er niveau / code 2ème niveau
$reponse = $bdd->query('SELECT * FROM codification');
$convert=array();
while ($donnees = $reponse->fetch())
{
	$convert[$donnees['quad']]=$donnees['code_nat'];
}
$reponse->closeCursor();
?>

<div class="container">
	<div class="row">
	    <div class="col-lg-1">
	        <p>
  				<br><a href="main.php"><span class="glyphicon glyphicon-home logo-small"></span></a>
			</p>

	    </div>
	    <div class="col-lg-5">
	    	<h1>Le trepied du REX</h1>
		
		</div>
		<form action=<?php echo "\"vueCode.php?code=". $_SESSION["code"]."\""; ?> method="post" enctype="multipart/form-data">
			<div class="col-lg-4">   
				<br> 			
					<div class="input-daterange input-group" id="datepicker">
						<span class="input-group-addon">S&eacute;lection du </span>	    
					    <input type="text" class="input form-control" data-provide="datepicker" name="debut" value=<?php echo $_SESSION["debut"] ?> data-date-format="yyyy-mm-dd" data-date-language="fr"/>
					    <span class="input-group-addon">au</span>
					    <input type="text" class="input form-control" data-provide="datepicker" name="fin" value=<?php echo $_SESSION["fin"] ?> data-date-format="yyyy-mm-dd" data-date-language="fr"/>
						
					</div>						
			</div>
			<div class="col-lg-2"> 
				<br>  
			    <input type="submit" class="btn btn-default" value="Rafraichir">
			</div>
		</form>
	</div>	    
  	<div class="page-header">
  		<h2>Observations Terrain <small>Les CVT avec le code <?php echo $_GET['code'];?></small></h2>
	</div>

<!-- /.row -->
	<div class="row">
	    <div class="col-lg-3">
			<?php 
	        $title="Nb CVT - ".$_GET['code'];
	        $id="nbCVT";
	        $data_url="CVTparCodeTrim.php?code=".$_GET['code'];
	        $datafield="trim";
	        $datafield_Header="Trimestre";
	        include 'temp/tableComplete.php';?>
		</div>
		<div class="col-lg-3">
	        <?php 
	        $title="Nb CVT - ".$_GET['code'];
	        $id="graphCode";
	        include 'temp/lineChart.php';?>
		</div>
	    <div class="col-lg-3">
	        <?php 
	        $title=$_GET['code']." - Services &eacute;metteurs";
	        $id="graphCodeEmet";
	        include 'temp/barGraph.php';?>
		</div>
		<div class="col-lg-3">
			<?php 
	        $title=$_GET['code']." - Services concern&eacute;s";
	        $id="graphCodeConc";
	        include 'temp/barGraph.php';?>	    	
	     </div>       
	</div>
	<!-- /.row -->
	<div class="row">
	    <div class="col-lg-3">
	      	<a class="btn btn-default" href="<?php echo "afficheTableConstats.php?code=".$_GET['code']."&nature=0"; ?>"> D&eacute;tails CVT N&eacute;gatifs</a>
		</div>

	    <div class="col-lg-3">
	    	<a class="btn btn-default" href="<?php echo "afficheTableConstats.php?code=".$_GET['code']."&nature=0"; ?>"> D&eacute;tails CVT Positifs</a>
	    </div>
    </div>
	<!-- /.row -->
	  <div class="page-header">
  		<h2>REX Interne <small>Les Firex BLA avec le code <?php echo $convert[$_GET['code']];?></small></h2>
	</div>

	<div class="row">
	    <div class="col-lg-3">
	        <?php 
	        $title=$convert[$_GET['code']];
	        $id="graphCodeFrx";
	        include 'temp/barGraph.php';?>
		</div>
		<div class="col-lg-9">
			<table id="tableCVT" data-toggle="table" 
		       	data-url=<?php echo '"jsonFrx.php?code='.$convert[$_GET['code']]."\"";?>
		       	data-toolbar="#toolbar"    
			    data-search="false"
			    data-show-refresh="false"
			    data-show-toggle="false"
			    data-show-columns="false"
			    data-show-export="false"
			    data-detail-view="false"
			    data-minimum-count-columns="2"
			    data-show-pagination-switch="false"
			    data-pagination="true"
			    data-id-field="id"    
			    data-page-list="[10, 25, 50, 100, ALL]"
			    data-show-footer="false"
			    data-click-to-select="false"
			    >
		
			    <thead>
				    <tr>
				        <th data-field="titre" data-align="left">Titre</th>
				        <th data-field="service" data-align="center">Service</th>
				        <th data-formatter="actionFormatter" data-events="actionEvents">Reference</th>
				    </tr>
			    </thead>
		</table>
		</div>
	</div>
	 <div class="page-header">
  		<h2>REX Externe <small>Les Firex CID avec le code <?php echo $convert[$_GET['code']];?></small></h2>
	</div>
<!-- /.row -->
<div class="row">
	    <div class="col-lg-3">
			<?php
			$title=$convert[$_GET['code']];
			$id="graphCodeCid";
			include 'temp/barGraph.php';?>
		</div>
		<div class="col-lg-9">
			<table id="tableCVT" data-toggle="table" 
		       	data-url=<?php echo '"jsonCid.php?code='.$convert[$_GET['code']]."\"";?>
		       	data-toolbar="#toolbar"    
			    data-search="false"
			    data-show-refresh="false"
			    data-show-toggle="false"
			    data-show-columns="false"
			    data-show-export="false"
			    data-detail-view="false"
			    data-minimum-count-columns="2"
			    data-show-pagination-switch="false"
			    data-pagination="true"
			    data-id-field="id"    
			    data-page-list="[10, 25, 50, 100, ALL]"
			    data-show-footer="false"
			    data-click-to-select="false"
			    >
		
			    <thead>
				    <tr>
				        <th data-field="titre" data-align="left">Titre</th>
				        <th data-field="service" data-align="center">Site</th>
				        <th data-formatter="actionFormatter" data-events="actionEvents">Reference</th>
				    </tr>
			    </thead>
		</table>
		</div>
	</div>
</div>

<?php include 'footer.php';?>

<script>		
	var code=getQuerystring('code');	
	barGraph('serviceparCode.php?code='+code+'&sens=emet', "graphCodeEmet");
	barGraph('serviceparCode.php?code='+code+'&sens=conc', "graphCodeConc");
	barGraph('frxParCodeTrim.php?code='+code, "graphCodeFrx");
	barGraph('cidParCodeTrim.php?code='+code, "graphCodeCid");
	lineGraph('CVTparCode.php?code='+code, "graphCode", code);

	$(function() 
			 {  
			 $(".tooltip-link").tooltip(); 
			 }); 
				
</script>
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
        '<a>'+row[0]+'</a>'
    ].join('');
	} else
	{	return [
		'<a href="'+row[6]+'">'+row[0]+'</a>'
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
