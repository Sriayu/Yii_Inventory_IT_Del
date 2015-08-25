<?php
/* @var $this LoanController */
/* @var $data Loan */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_location')); ?>:</b>
	<?php echo CHtml::encode($data->id_location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_loan')); ?>:</b>
	<?php echo CHtml::encode($data->date_loan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_return')); ?>:</b>
	<?php echo CHtml::encode($data->date_return); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity_loan')); ?>:</b>
	<?php echo CHtml::encode($data->quantity_loan); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status_apporval')); ?>:</b>
	<?php echo CHtml::encode($data->status_apporval); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_loan')); ?>:</b>
	<?php echo CHtml::encode($data->status_loan); ?>
	<br />

	*/ ?>

</div>