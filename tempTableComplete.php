<div class="panel panel-default">
<div class="panel-heading">
<i class="fa fa-table fa-fw"></i> <?php echo $title; ?>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
<div >
<table id="<?php echo $id; ?>" data-toggle="table" class="table table-striped text-center" 	data-url='<?php echo $data_url; ?>' >
<thead>
<tr>
<th data-field="<?php echo $datafield; ?>"><?php echo $datafield_Header; ?></th>
<th data-field="nbTot">Total</th>
<th data-field="nbPos">(+)</th>
<th data-field="nbNeg">(-)</th>
</tr>
</thead>
</table>
</div>
</div>
<!-- /.panel-body -->
</div>
<!-- /.panel -->