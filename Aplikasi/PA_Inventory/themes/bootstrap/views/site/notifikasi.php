<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
<?php
	$model = Inventory::model()->findAllByAttributes(array('quantity'=>6));
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
	border:solid 1px #000000;
	height:25px;
/*	text-align:center;*/
/*	margin-bottom:5px;*/
	background:#c4fdfc;
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
		$barang=  Inventory::model()->findByAttributes(array('quantity'=>$a->quantity));
	?>
		<div class="kotak">
		<a href = "<?php echo $this->createURL('inventory/view',array('id'=>$a->code_inventory));?>">
	<?php
		echo $a->name_inventory." sudah hampir habis";
	?></a>
		</div>
	<?php
		echo "<br/>";
	}
?>
</div>

</body>
</html>
