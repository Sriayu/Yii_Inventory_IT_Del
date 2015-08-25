<?php
/* @var $this ImportInventoryController */
/* @var $model ImportInventory */

$this->breadcrumbs=array(
	'Import Inventories'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List ImportInventory', 'url'=>array('index')),
//	array('label'=>'Entri Pemasukan', 'url'=>array('create')),
//	//array('label'=>'Update ImportInventory', 'url'=>array('update', 'id'=>$model->id)),
//	//array('label'=>'Delete ImportInventory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Kelola Pemasukan', 'url'=>array('admin')),
);
?>
<div id="tabel">
<h1>Lihat Detail Barang <?php echo $model->name_inventory; ?></h1>

<?php 
        echo CHtml::image(Yii::app()->request->baseUrl.'/images/'.$model->image, 'No Image', array("width"=>300));

?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name_inventory',
		'supplier',
		'quantity',
		'price',
                'total_price',
		'date_import',
		'description',
	),
)); ?>
</div>