<?php
/* @var $this ExportInventoryController */
/* @var $data ExportInventory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code_inventory')); ?>:</b>
	<?php echo CHtml::encode($data->code_inventory); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_locationFirst')); ?>:</b>
	<?php echo CHtml::encode($data->id_locationFirst); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_locationLast')); ?>:</b>
	<?php echo CHtml::encode($data->id_locationLast); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_export')); ?>:</b>
	<?php echo CHtml::encode($data->date_export); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?>:</b>
	<?php echo CHtml::encode($data->quantity); ?>
	<br />


</div>