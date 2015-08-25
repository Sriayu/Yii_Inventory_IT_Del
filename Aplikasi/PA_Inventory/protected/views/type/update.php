<?php
/* @var $this TypeController */
/* @var $model Type */

$this->breadcrumbs=array(
	'Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

//$this->menu=array(
//	array('label'=>'List Type', 'url'=>array('index')),
//	array('label'=>'Create Type', 'url'=>array('create')),
//	array('label'=>'View Type', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage Type', 'url'=>array('admin')),
//);
//?>

<h1>Update Tipe  <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_formNewType', array('model'=>$model)); ?>