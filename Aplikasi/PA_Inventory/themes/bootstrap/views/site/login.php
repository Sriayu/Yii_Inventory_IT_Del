<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>



<center><font color="green"><h2>Selamat Datang di Sistem Inventori Del</font></h2></center>
<br>
<center><p><b><font color="black">Masukkan username dan password anda</font></b></p><center>


<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
    'type'=>'inline',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	

	<br><center><?php echo $form->textFieldRow($model,'username'); ?></center>
       
	<br><center><?php echo $form->passwordFieldRow($model,'password',array(
       
    )); ?></center>

	<br>
<!--        <center>-->
        <?php 
//        echo $form->checkBoxRow($model,'rememberMe'); ?>
<!--        </center>-->

	<center><div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Masuk',
        )); ?>
	</div></center>

<?php $this->endWidget(); ?>

</div><!-- form -->
