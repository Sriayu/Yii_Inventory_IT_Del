<?php
/* @var $this DamagedInventoryController */
/* @var $model DamagedInventory */

$this->breadcrumbs=array(
	'Damaged Inventories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DamagedInventory', 'url'=>array('index')),
	array('label'=>'Create DamagedInventory', 'url'=>array('create')),
	array('label'=>'View DamagedInventory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DamagedInventory', 'url'=>array('admin')),
);
?>

<h1>Update DamagedInventory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>