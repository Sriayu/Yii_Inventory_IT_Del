<?php
/* @var $this TypeController */
/* @var $model Type */

$this->breadcrumbs=array(
	'Types'=>array('index'),
	'Manage',
);

//$this->menu=array(
//	array('label'=>'List Type', 'url'=>array('index')),
//	array('label'=>'Create Type', 'url'=>array('create')),
//);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#type-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div id="tabel">
<h1>Daftar Tipe</h1>

<div id ="button">
<a href="<?php echo $this->createURL('Type/Create');?>">
<button>Tambah Tipe</button>
</a>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
				'header'=>'No',
				'value'=>'$row+1'
				),
		array(
				'header'=>'Nama Kategori',
				'value'=>'$data->name'
				), array(
			'class'=>'CButtonColumn',
                        'header'=>'',
			'template'=>'{Detail}',
			'buttons'=>array
			(
				'Detail' => array(
                                   
				 'label'=>'Detail',
				 'url'=>'Yii::app()->createUrl("type/view", array("id"=>$data->id))',
				 ),
                            
			),
		),
             array(
			'class'=>'CButtonColumn',
                        'header'=>'',
			'template'=>'{Detail}',
			'buttons'=>array
			(
				'Detail' => array(
                                   
				 'label'=>'Update',
				 'url'=>'Yii::app()->createUrl("type/update", array("id"=>$data->id))',
				 ),
                            
			),
		),
	),
)); ?>
</div>