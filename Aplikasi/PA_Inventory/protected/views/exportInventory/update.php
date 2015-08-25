<?php
/* @var $this ExportInventoryController */
/* @var $model ExportInventory */

$this->breadcrumbs=array(
	'Export Inventories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ExportInventory', 'url'=>array('index')),
	array('label'=>'Create ExportInventory', 'url'=>array('create')),
	array('label'=>'View ExportInventory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ExportInventory', 'url'=>array('admin')),
);
?>

<h1>Update ExportInventory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>