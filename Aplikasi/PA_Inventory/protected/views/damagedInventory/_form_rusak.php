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

<!--	<div class="row">
		<?php echo $form->labelEx($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user'); ?>
		<?php echo $form->error($model,'id_user'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($inventory,'name_inventory'); ?>
		<?php echo $form->textField($inventory,'name_inventory'); ?>
		<?php echo $form->error($inventory,'name_inventory'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'Quantity_demage'); ?>
		<?php echo $form->textField($model,'Quantity_demage'); ?>
		<?php echo $form->error($model,'Quantity_demage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deskripsi kerusakan'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'status_repair'); ?>
		<?php echo $form->textField($model,'status_repair'); ?>
		<?php echo $form->error($model,'status_repair'); ?>
	</div>-->

	

<div>
		<?php echo $form->labelEx($model,'Gambar'); ?>
		<?php echo $form->fileField($model,'image',array('size'=>20,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'date_submition'); ?>
		<?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model'=>$model,
			'attribute'=>'date_submition',
            'value'=>date("Y-M-D"),
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
				'changeMonth'=>'true',
				'changeYear'=>'true',
            ),
        )); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->