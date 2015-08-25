<?php
/* @var $this DamagedInventoryController */
/* @var $model DamagedInventory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'damaged-inventory-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user'); ?>
		<?php echo $form->error($model,'id_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'code_inventory'); ?>
		<?php echo $form->textField($model,'code_inventory',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'code_inventory'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_repair'); ?>
		<?php echo $form->textField($model,'status_repair'); ?>
		<?php echo $form->error($model,'status_repair'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Quantity_demage'); ?>
		<?php echo $form->textField($model,'Quantity_demage'); ?>
		<?php echo $form->error($model,'Quantity_demage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_submition'); ?>
		<?php echo $form->textField($model,'date_submition'); ?>
		<?php echo $form->error($model,'date_submition'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->