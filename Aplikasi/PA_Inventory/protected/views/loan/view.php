<?php
/* @var $this LoanController */
/* @var $model Loan */

$this->breadcrumbs=array(
	'Loans'=>array('index'),
	$model->id,
);

//$this->menu=array(
//	array('label'=>'List Loan', 'url'=>array('index')),
//	array('label'=>'Create Loan', 'url'=>array('create')),
//	array('label'=>'Update Loan', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete Loan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage Loan', 'url'=>array('admin')),
//);
//?>
<div id="tabel">
<h1>Detail Loan </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		//'id_user',
//		'code_inventory',
		'id_location',
		'date_loan',
		'date_return',
		'quantity_loan',
		//'status_apporval',
		'status_loan',
	),
)); ?>
</div>