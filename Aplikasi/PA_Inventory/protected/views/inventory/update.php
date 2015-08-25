<?php
/* @var $this InventoryController */
/* @var $model Inventory */

$this->breadcrumbs=array(
	'Inventories'=>array('index'),
	$model->code_inventory=>array('view','id'=>$model->code_inventory),
	'Update',
);

$this->menu=array(
	array('label'=>'List Inventory', 'url'=>array('index')),
	array('label'=>'Create Inventory', 'url'=>array('create')),
	array('label'=>'View Inventory', 'url'=>array('view', 'id'=>$model->code_inventory)),
	array('label'=>'Manage Inventory', 'url'=>array('admin')),
);
?>

<h1>Update Inventory <?php echo $model->code_inventory; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>