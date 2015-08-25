<?php
/* @var $this DamagedInventoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Damaged Inventories',
);

//$this->menu=array(
//	array('label'=>'Create DamagedInventory', 'url'=>array('create')),
//	array('label'=>'Manage DamagedInventory', 'url'=>array('admin')),
//);
?>
<div id="tabel">
<h1>Damaged Inventories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>