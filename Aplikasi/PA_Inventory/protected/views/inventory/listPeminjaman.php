<?php
/* @var $this ImportInventoryController */
/* @var $model ImportInventory */

$this->breadcrumbs=array(
	'Import Inventories'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#import-inventory-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<div id="tabel">
<h1>Laporan Pemasukan Inventori</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'loan-grid',
			'dataProvider'=>$dataProvider,
			'summaryText'=>Yii::t('app','Menampilkan {start}-{end} dari {count} barang.'),
			'emptyText'=>'Tidak ada transaksi yang ditemukan',
			'pager'=>array(
				'header'=>'',
				'prevPageLabel'=>'&lt; Sebelumnya',
				'nextPageLabel'=>'Selanjutnya &gt;',
			),
		)); ?>
</div>