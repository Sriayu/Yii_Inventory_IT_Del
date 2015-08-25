<?php
/* @var $this AccountController */
/* @var $model Account */

$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	$model->name,
);

$this->menu=array(
//	array('label'=>'List Account', 'url'=>array('index')),
//	array('label'=>'Create Account', 'url'=>array('create'),'visible' => Yii::app()->user->checkAccess('staff')),
//	array('label'=>'Update Account', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete Account', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage Account', 'url'=>array('admin')),
);
?>
<div id="tabel">
<h1>Detail Akun : <?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//		'id',
		'username',
//		'password',
		'name',
		'email',
		array(
                    'name'=>'image',
                    'type'=>'raw',
                    'value'=>CHtml::image(Yii::app()->request->baseUrl.'/images/'.$model->image, 'No Image', array("width"=>50)),
//                    'value'=>CHtml::image('a/../images/'.$model->image, 'No Image', array("width"=>50)),
                ),
	),
)); ?>
<div id ="tombol">
<a href = "<?php echo $this->createURL('account/update',array('id'=>$model->id));?>"><img src="<?php echo Yii::app()->request->baseUrl.'/images/update-button.png';?>"></img></a>
</div>
</div>
<!--<div class="row buttons">
<a href = "<?php 
//echo $this->createURL('account/update',array('id'=>$model->id));?>"><img src="<?php echo Yii::app()->request->baseUrl.'/images/update-button.png';?>"></img></a>
</div>-->