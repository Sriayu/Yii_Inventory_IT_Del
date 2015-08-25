<?php
/* @var $this ExportInventoryController */
/* @var $model ExportInventory */

$this->breadcrumbs=array(
	'Export Inventories'=>array('index'),
	$model->id,
);

//$this->menu=array(
//	array('label'=>'List ExportInventory', 'url'=>array('index')),
//	array('label'=>'Create ExportInventory', 'url'=>array('create')),
//	array('label'=>'Update ExportInventory', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete ExportInventory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage ExportInventory', 'url'=>array('admin')),
//);
?>

<div id="tabel">
<h1>Detail Barang <?php echo $model->listInventory($model->code_inventory); ?> yang dikeluarkan</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code_inventory',
		'id_locationFirst',
		'id_locationLast',
		'date_export',
		'quantity',
	),
)); ?>
</div>