<?php
/* @var $this DamagedInventoryController */
/* @var $data DamagedInventory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user')); ?>:</b>
	<?php echo CHtml::encode($data->id_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code_inventory')); ?>:</b>
	<?php echo CHtml::encode($data->code_inventory); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status_repair')); ?>:</b>
	<?php echo CHtml::encode($data->status_repair); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Quantity_demage')); ?>:</b>
	<?php echo CHtml::encode($data->Quantity_demage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_submition')); ?>:</b>
	<?php echo CHtml::encode($data->date_submition); ?>
	<br />

	*/ ?>

</div>