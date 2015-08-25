<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
<?php
	$model = Loan::model()->findAllByAttributes(array('status_apporval'=>null));
	$count=count($model);	
?>

<!DOCTYPE html>
<html>
<head>
<script> 
$(document).ready(function(){
  $("#flip").click(function(){
    $("#panel").slideToggle("slow");
  });
});
</script>
 
<style type="text/css"> 
#flip
{
	border:solid 1px #c0d4ea;
	height:25px;
	text-align:center;
	margin-bottom:5px;
	background:#6a9ff3;
}
#panel,#flip
{


}
#panel
{
display:none;
padding-left:4px;
padding-right:4px;
text-align:left;
}
</style>
</head>
<body>
 
<div id="flip"><center><p><font size=3>Notifikasi (<?php echo $count;?>)</font></p><center></div>
<div id="panel">

<?php
	foreach($model as $a)
	{
		$user=  Account::model()->findByAttributes(array('id'=>$a->id));
		$barang= Loan::model()->findByAttributes(array('id'=>$a->id));
	?>
		<div class="kotak">
		<a href = "<?php echo $this->createURL('loan/approve',array('id'=>$a->id));?>">
	<?php
		echo $user->username." merequest barang...";
	?></a>
		</div>
	<?php
		echo "<br/>";
	}
?>
</div>

</body>
</html>
