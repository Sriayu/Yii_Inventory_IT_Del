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
		<?php echo $form->labelEx($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user'); ?>
		<?php echo $form->error($model,'id_user'); ?>
	</div>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'code_inventory'); ?>
		<?php echo $form->textField($model,'code_inventory',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'code_inventory'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'id_location'); ?>
		<?php echo $form->textField($model,'id_location'); ?>
		<?php echo $form->error($model,'id_location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_loan'); ?>
		<?php echo $form->textField($model,'date_loan'); ?>
		<?php echo $form->error($model,'date_loan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_return'); ?>
		<?php echo $form->textField($model,'date_return'); ?>
		<?php echo $form->error($model,'date_return'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantity_loan'); ?>
		<?php echo $form->textField($model,'quantity_loan'); ?>
		<?php echo $form->error($model,'quantity_loan'); ?>
	</div>


<!--	<div class="row">
		<?php echo $form->labelEx($model,'status_apporval'); ?>
		<?php echo $form->textField($model,'status_apporval'); ?>
		<?php echo $form->error($model,'status_apporval'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_loan'); ?>
		<?php echo $form->textField($model,'status_loan'); ?>
		<?php echo $form->error($model,'status_loan'); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->