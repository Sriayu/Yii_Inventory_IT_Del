<?php
/* @var $this ExportInventoryController */
/* @var $model ExportInventory */

$this->breadcrumbs=array(
	'Export Inventories'=>array('index'),
	'Create',
);

//$this->menu=array(
//	array('label'=>'List ExportInventory', 'url'=>array('index')),
//	array('label'=>'Manage ExportInventory', 'url'=>array('admin')),
//);
?>
<div id="tabel">
<h1>Form Pengajuan Pengeluaran Barang</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>