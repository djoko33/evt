<?php 
include_once '../modele/count.php';
$serv=$_GET['serv'];
$lstCodes=lstCodesPA($pa);
$data=planAction($serv, $sens, $lstCodes)?>

<div class="panel panel-default">
<div class="panel-heading">
<i class="fa fa-file-text-o fa-fw"></i> <?php echo $title; ?>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
<div >
<table data-toggle="table">
    <thead>
    <tr>
        <th></th>
		<th>Total</th>
		<th>(+)</th>
		<th>(-)</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i = 1; $i < count($lstCodes)+1; $i++) {
    	echo '<tr id="tr-id-'.$i.'" class="tr-class-'.$i.'">
        <td id="td-id-'.$i.'" class="td-class-'.$i.'">'.$data[$i-1]["x"].'</td>
        <td>'.$data[$i-1]["nbTot"].'</td>
        <td><a href="../afficheTableConstatsServCode.php?serv_'.$sens.'='.$serv.'&nature=1&code='.$data[$i-1]["code"].'">'.$data[$i-1]["nbPos"].'</a></td>
        <td><a href="../afficheTableConstatsServCode.php?serv_'.$sens.'='.$serv.'&nature=0&code='.$data[$i-1]["code"].'">'.$data[$i-1]["nbNeg"].'</a></td>
    </tr>';
    }
    
    ?>
    </tbody>
</table>
</div>
</div>
<!-- /.panel-body -->
</div>
<!-- /.panel -->