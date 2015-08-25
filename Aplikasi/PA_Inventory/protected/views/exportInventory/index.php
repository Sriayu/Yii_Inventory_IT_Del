<?php
/* @var $this ExportInventoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Export Inventories',
);

$this->menu=array(
	array('label'=>'Create ExportInventory', 'url'=>array('create')),
	array('label'=>'Manage ExportInventory', 'url'=>array('admin')),
);
?>

<h1>Export Inventories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
