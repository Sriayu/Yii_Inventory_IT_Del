<?php
/* @var $this ImportInventoryController */
/* @var $model ImportInventory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'import-inventory-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<font color="red"><p class="note">Kolom dengan label  <span class="required">*</span> harus diisi.</p></font>

	<?php echo $form->errorSummary($model); ?>
       <table>
        
<!--	<tr>
            <td><?php echo $form->labelEx($model,'Kode Barang'); ?></td>
		<td><?php echo $form->textField($model,'code_inventory',array('size'=>11,'maxlength'=>100)); ?></td>
		<td><?php echo $form->error($model,'code_inventory'); ?></td>
           </tr>-->
	<tr>
		<td><?php echo $form->labelEx($model,'Nama Barang'); ?></td>
		<td><?php echo $form->textField($model,'name_inventory',array('size'=>60,'maxlength'=>200)); ?></td>
		<td><?php echo $form->error($model,'name_inventory'); ?></td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'Lokasi Barang'); ?></td>
		<td><?php echo $form->dropDownList($model,'id_location', CHtml::listData(Location::model()->findAll(array('order' => 'id')),'id','name')); ?></td>
		
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'Kategori Barang'); ?></td>
		<td><?php echo $form->dropDownList($model,'id_category', CHtml::listData(Categorie::model()->findAll(array('order' => 'id')),'id','name')); ?><td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'Tipe Barang'); ?></td>
		<td><?php echo $form->dropDownList($model,'id_type', CHtml::listData(Type::model()->findAll(array('order' => 'id')),'id','name')); ?></td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'Satuan'); ?></td>
		<td><?php echo $form->textField($model,'unit',array('size'=>32,'maxlength'=>32)); ?></td>
		<td><?php echo $form->error($model,'unit'); ?></td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'Distributor'); ?></td>
		<td><?php echo $form->textField($model,'supplier',array('size'=>32,'maxlength'=>32)); ?></td>
		<td><?php echo $form->error($model,'supplier'); ?></td>
        </tr>

	<tr>
		<td><?php echo $form->labelEx($model,'Jumlah'); ?></td>
		<td><?php echo $form->textField($model,'quantity'); ?></td>
		<td><?php echo $form->error($model,'quantity'); ?></td>
        </tr>

	<tr>
		<td><?php echo $form->labelEx($model,'Harga'); ?></td>
		<td><?php echo $form->textField($model,'price'); ?></td>
		<td><?php echo $form->error($model,'price'); ?></td>
        </tr>

	<tr>
		<td><?php echo $form->labelEx($model,'Gambar'); ?></td>
		<td><?php echo $form->fileField($model,'image',array('size'=>20,'maxlength'=>200)); ?></td>
		<td><?php echo $form->error($model,'image'); ?></td>
	</tr>

<!--	<tr>
            <td><?php echo $form->label($model,'Tanggal Pemasukan'); ?></td>
       
<td><?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'model'=>$model,
        'attribute'=>'date_import',
            'value'=>$model->date_import,
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
                'changeMonth'=>'true',
                'changeYear'=>'true',
            ),
        ));
        ?></td>

	<td><?php echo $form->error($model,'date_import'); ?></td>
            
 </tr>-->


	<tr>
		<td><?php echo $form->labelEx($model,'description'); ?></td>
		<td><?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?></td>
		<td><?php echo $form->error($model,'description'); ?></td>
        </tr>

	<tr>
		<td><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?></td>
        </tr>
        </table>
<?php $this->endWidget(); ?>

</div><!-- form -->