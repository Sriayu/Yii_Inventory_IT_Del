<?php
/* @var $this LoanController */
/* @var $model Loan */

$this->breadcrumbs=array(
	'Loans'=>array('index'),
	$model->id,
);

?>

<h1>Gagal.</h1>
<h2>Peminjaman ini belum disetujui.</h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_user',
		'code_inventory',
		'id_location',
		'date_loan',
		'date_return',
		'quantity_loan',
		'status_apporval',
		'status_loan',
	),
)); ?>
