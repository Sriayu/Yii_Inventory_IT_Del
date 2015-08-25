<?php
/* @var $this CategorieController */
/* @var $model Categorie */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	'Manage',
);

//$this->menu=array(
//	array('label'=>'List Categorie', 'url'=>array('index')),
//	array('label'=>'Create Categorie', 'url'=>array('create')),
//);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#categorie-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div id ="tabel">
<h1>Daftar Kategori</h1>

<div id ="button">
<a href="<?php echo $this->createURL('Categorie/Create');?>">
<button>Tambah Kategori</button>
</a>
</div>

<?php 
//echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<!--<div class="search-form" style="display:none">-->
<?php 
//$this->renderPartial('_search',array(
//	'model'=>$model,
//)); ?>
<!--</div> search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'categorie-grid',
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
				),
            array(
			'class'=>'CButtonColumn',
                        'header'=>'',
			'template'=>'{Detail}',
			'buttons'=>array
			(
				'Detail' => array(
                                   
				 'label'=>'Detail',
				 'url'=>'Yii::app()->createUrl("categorie/view", array("id"=>$data->id))',
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
                                   
				 'label'=>'update',
				 'url'=>'Yii::app()->createUrl("categorie/update", array("id"=>$data->id))',
				 ),
                            
			),
		),
//		array(
//			'class'=>'CButtonColumn',
//		),
	),
)); ?>
</div>
