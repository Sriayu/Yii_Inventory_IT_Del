<?php
/* @var $this TypeController */
/* @var $model Type */

$this->breadcrumbs=array(
	'Types'=>array('index'),
	'Create',
);
//
//$this->menu=array(
//	array('label'=>'List Type', 'url'=>array('index')),
//	array('label'=>'Manage Type', 'url'=>array('admin')),
//);
//?>

<h1>Form Penambahan Tipe Baru</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>