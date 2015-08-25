<?php
/* @var $this LoanController */
/* @var $model Loan */

$this->breadcrumbs=array(
	'Loans'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#loan-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div id="tabel">

<h1>Barang yang sudah disetujui</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'loan-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
				'header'=>'No',
				'value'=>'$row+1'
				),
                array(
			
			'header'=>'Inventory',
			'value'=>'$data->listInventory($data->code_inventory)',
			),
		'date_loan',
		'date_return',
		'quantity_loan',
                 array(
				'header'=>'Jumlah Rusak',
				'value'=>'$data->quantity_demaged'
				),
                array('name' => 'status_apporval', 'header'=>'Persetujuan','type' => 'raw',
                'value' => '($data->status_apporval ? "Sudah Disetujui" : CHtml::link("Batalkan", Array(\'Loan/Batal\', \'id\'=>$data->id)))'),
            ),
)); ?>
</div>