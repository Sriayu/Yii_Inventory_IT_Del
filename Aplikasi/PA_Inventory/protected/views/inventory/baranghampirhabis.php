<?php
/* @var $this InventoryController */
/* @var $model Inventory */

$this->breadcrumbs=array(
	'Inventories'=>array('index'),
	$model->code_inventory,
);

$this->menu=array(
	array('label'=>'List Inventory', 'url'=>array('index_staff')),
	//array('label'=>'Create Inventory', 'url'=>array('create')),
	//array('label'=>'Update Inventory', 'url'=>array('update', 'id'=>$model->code_inventory)),
	//array('label'=>'Delete Inventory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->code_inventory),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Inventory', 'url'=>array('admin')),
);
?>

<h1>Detail Barang <?php echo $model->code_inventory; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'code_inventory',
		'name_inventory',
		//'id_type',
		//'id_category',
		'id_location',
		'unit',
		'quantity',
		'description',
		array(
                    'name'=>'image',
                    'type'=>'raw',
                    'value'=>CHtml::image(Yii::app()->request->baseUrl.'/images/'.$model->image, 'No Image', array("width"=>50)),
//                    'value'=>CHtml::image('a/../images/'.$model->image, 'No Image', array("width"=>50)),
                ),
		
	),
)); ?>
