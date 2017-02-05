
<form action=<?php echo $page; ?> method="post" enctype="multipart/form-data">
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