<?php
/* @var $this ImportInventoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pemasukan Barang',
);

$this->menu=array(
	array('label'=>'Tambah Pemasukan', 'url'=>array('create')),
	array('label'=>'Kelola Pemasukan', 'url'=>array('admin')),
);
?>

<h1>Import Inventories</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'importInventory-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
//		'code_inventory',
		'name_inventory',
//                'id_location',
                'id_category',
		'id_type',
//		'unit',
		'supplier',
                'quantity',
                'price',
                'date_import',
	),
)); ?>
