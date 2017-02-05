
<?php
function initComment($idComment)
{
	include('connexionPG.php');
	$comm=$bdd->prepare("SELECT contenu FROM comment WHERE id=?");
	$comm->execute(array($idComment));
	$c=$comm->fetchAll(pdo::FETCH_ASSOC);
	$content=$c[0]['contenu'];
	if ($content=='') {
		$content="[{ insert: 'Vide' }]";
	}
	return $idComment.'.setContents('.$content.');';
}

function initQuill($idComment)
{
	$js=$idComment."= new Quill('#".$idComment."',
{
	modules:
	{ 	toolbar: toolbarOptions},
	theme: 'snow'
});";
	return $js;
}

function initAjaxBtn($idComment) {
$js= "$(document).ready(function(){
	$('#save".$idComment."').click(function(){
		var comment = JSON.stringify(".$idComment.".getContents());
		$.ajax({
			type: 'POST',
			url: 'comment.php',
			data: 'comment='+comment+'&id=".$idComment."',
			cache: false,
			success: function(data){
				alert(data);		}
		});

	});
});";
return $js;
}

function initCommentPanel($idComment) {
	return initQuill($idComment)."\n".initComment($idComment)."\n".initAjaxBtn($idComment)."\n";
}
?>