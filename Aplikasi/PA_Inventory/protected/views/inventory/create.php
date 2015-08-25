<?php
/* @var $this InventoryController */
/* @var $model Inventory */

$this->breadcrumbs=array(
	'Inventories'=>array('index'),
	'Create',
);
?>

<h1>Create Inventory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>