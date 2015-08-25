<?php
/* @var $this DamagedInventoryController */
/* @var $model DamagedInventory */

$this->breadcrumbs=array(
	'Damaged Inventories'=>array('index'),
	$model->id,
);

$this->menu=array(
//	array('label'=>'List DamagedInventory', 'url'=>array('index')),
//	array('label'=>'Create DamagedInventory', 'url'=>array('create')),
//	array('label'=>'Update DamagedInventory', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete DamagedInventory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage DamagedInventory', 'url'=>array('admin')),
//	 array('label'=>'Cetak DamagedInventory', 'url'=>array('PrintPDF','id'=> $model-> id)),
);
?>
<div id="tabel">
<h1>Detail Barang Rusak</h1>
<div id ="button">
<a href="<?php echo $this->createURL('DamagedInventory/PrintPDF',array('id'=>$model->id));?>">
<button>Cetak</button>
</a>
</div>

<?php 
    echo CHtml::image(Yii::app()->request->baseUrl.'/images/'.$model->image, 'No Image', array("width"=>300));
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_user',
		'code_inventory',
//		'id_type',
//		'id_category',
		'description',
		'status_repair',
		'Quantity_demage',
//		'image',
		'date_submition',
	),
)); ?>
</div>