<?php
/* @var $this LoanController */
/* @var $model Loan */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'loan-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($inventory,'Nama Inventory'); ?>
		<?php echo $form->textField($inventory,'name_inventory',array('disabled'=>'true')); ?>
		<?php echo $form->error($inventory,'name_inventory'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantity_loan'); ?>
		<?php echo $form->textField($model,'quantity_loan'); ?>
		<?php echo $form->error($model,'quantity_loan'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Pinjam'); ?>
                
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->