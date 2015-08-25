<?php
/* @var $this DamagedInventoryController */
/* @var $model DamagedInventory */

$this->breadcrumbs=array(
	'Damaged Inventories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DamagedInventory', 'url'=>array('index')),
	array('label'=>'Manage DamagedInventory', 'url'=>array('admin')),
);
?>

<h1>Create DamagedInventory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>