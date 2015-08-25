<?php
/* @var $this ImportInventoryController */
/* @var $model ImportInventory */

$this->breadcrumbs=array(
	'Import Inventories'=>array('index'),
	'Create',
);

//$this->menu=array(
//	array('label'=>'Tambah Kategori', 'url'=>array('/Categorie/create')),
//	array('label'=>'Tambah Lokasi', 'url'=>array('/Location/create')),
//        array('label'=>'Tambah Tipe Inventory', 'url'=>array('/Type/create')),
//);
?>
<div id="formulir">
<h1>Tambah Pemasukan Barang</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>