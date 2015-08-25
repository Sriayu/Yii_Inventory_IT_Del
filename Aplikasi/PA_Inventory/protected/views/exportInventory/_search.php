<?php
/* @var $this ExportInventoryController */
/* @var $model ExportInventory */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'code_inventory'); ?>
		<?php echo $form->textField($model,'code_inventory'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_locationFirst'); ?>
		<?php echo $form->textField($model,'id_locationFirst'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_locationLast'); ?>
		<?php echo $form->textField($model,'id_locationLast'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_export'); ?>
		<?php echo $form->textField($model,'date_export'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->