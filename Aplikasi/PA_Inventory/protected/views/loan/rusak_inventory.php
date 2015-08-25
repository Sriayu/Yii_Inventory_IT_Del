<?php
/* @var $this DamagedInventoryController */
/* @var $model DamagedInventory */

$this->breadcrumbs=array(
	'Loan'=>array('index'),
	$model->code_inventory=>array('view','id'=>$model->id),
	'Rusak_inventory',
);

//$this->menu=array(
//	array('label'=>'List DamagedInventory', 'url'=>array('index')),
//	array('label'=>'Manage DamagedInventory', 'url'=>array('admin')),
//);
//?>

<h1>Create DamagedInventory</h1>

<?php echo $this->renderPartial('_form_kerusakan', array('model'=>$model)); ?>