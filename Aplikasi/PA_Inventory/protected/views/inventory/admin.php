<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#inventory-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />

<div id="tabel">
<h1>Daftar Inventory</h1>

<p>
Berikut adalah seluruh daftar inventory yang tersedia.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
        'keyword'=>$keyword,
)); ?>
</div><!-- search-form -->
    
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'inventory-grid',
	'dataProvider'=>$model->cariNamaBarang($keyword),
	'filter'=>$model,
	'columns'=>array(
		array(
				'header'=>'No',
				'value'=>'$row+1'
				),
                array(
				'header'=>'Nama Inventory',
				'value'=>'$data->name_inventory'
				),
                array(
				'header'=>'Tipe Inventory',
				'value'=>'$data->listType($data->id_type)'
				),
		array(
			
			'header'=>'Kategori',
			'value'=>'$data->listCategory($data->id_category)',
			),
                array(
			
			'header'=>'Lokasi',
			'value'=>'$data->listLocation($data->id_location)',
			),
            array(
				'header'=>'Jumlah',
				'value'=>'$data->quantity'
				),
             array(
				'header'=>'Deksripsi',
				'value'=>'$data->description'
				),           
            array('header'=>'Operasi', 'type' => 'raw',
                'value' => '($data->id_category != 4 ? "Tidak bisa dipinjam" : CHtml::link("Pinjam", Array(\'Loan/pinjam\', \'id\'=>$data->id)))'),
             array(
                        'header'=>'Detail Inventory',
			'class'=>'CButtonColumn',
			'template'=>'{Detail}',
			'buttons'=>array
			(
				'Detail' => array(
				 'label'=>'Detail',
				 'url'=>'Yii::app()->createUrl("inventory/view", array("id"=>$data->code_inventory))',
				 ),
                            
			),
		),
	),
    
   
)); ?>
</div>
