<?php
/* @var $this InventoryController */
/* @var $model Inventory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'inventory-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'code_inventory'); ?>
		<?php echo $form->textField($model,'code_inventory',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'code_inventory'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name_inventory'); ?>
		<?php echo $form->textField($model,'name_inventory',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name_inventory'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_type'); ?>
		<?php echo $form->dropDownList($model,'id_type', CHtml::listData(Type::model()->findAll(array('order' => 'id')),'id','name'));?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_category'); ?>
		<?php echo $form->dropDownList($model,'id_category', CHtml::listData(Categorie::model()->findAll(array('order' => 'id')),'id','name'));?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_location'); ?>
		<?php echo $form->dropDownList($model,'id_location', CHtml::listData(Location::model()->findAll(array('order' => 'id')),'id','name'));?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unit'); ?>
		<?php echo $form->textField($model,'unit',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'unit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity'); ?>
		<?php echo $form->error($model,'quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unit'); ?>
		<?php echo $form->textField($model,'unit',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'unit'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->