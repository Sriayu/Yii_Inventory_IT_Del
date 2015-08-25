<?php
/* @var $this ImportInventoryController */
/* @var $model ImportInventory */

$this->breadcrumbs=array(
	'Import Inventories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ImportInventory', 'url'=>array('index')),
	array('label'=>'Create ImportInventory', 'url'=>array('create')),
	array('label'=>'View ImportInventory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ImportInventory', 'url'=>array('admin')),
);
?>

<h1>Update ImportInventory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>