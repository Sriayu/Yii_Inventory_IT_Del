<?php
/* @var $this TypeController */
/* @var $model Type */

$this->breadcrumbs=array(
	'Types'=>array('index'),
	$model->name,
);

//$this->menu=array(
//	array('label'=>'List Type', 'url'=>array('index')),
//	array('label'=>'Create Type', 'url'=>array('create')),
//	array('label'=>'Update Type', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete Type', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage Type', 'url'=>array('admin')),
//);
//?>
<div id="tabel">
<h1>Detail Tipe : <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>

<div id="tabel2">
 <h4>Barang-Barang Bertipe <?php echo $model->name; ?></h4>
<?php 
$this->widget('zii.widgets.grid.CGridView', array( 
    'id' => 'inventory-grid', 
    // set the method handling the search action & pass the author's id 
    'dataProvider' => $inventory->searchtype($model->id), 
    // the object which stores filter criteria 
    'filter' => $inventory, 
    // disable ajax, a normal request-response is used 
    'ajaxUpdate' => false, 
    'columns' => array( 
         array(
				'header'=>'No',
				'value'=>'$row+1'
				),
                array(
                'header' => 'Nama Inventory ',
                'id'=>'code_inventory',
                'type' => 'raw',
                'value'=>'CHtml::label($data->name_inventory,"",array("onClick"=>"tes(\'$data->code_inventory\')","id"=>"label_$row"));'
                 ),
		array(
				'header'=>'Tipe Inventory',
				'value'=>'$data->listType($data->id_type)'
				),
		array(
			
			'header'=>'Kategori',
			'value'=>'$data->listCategory($data->id_category)',
			),
            
//		'id_location',
                 
                array(
			
			'header'=>'Lokasi',
			'value'=>'$data->listLocation($data->id_location)',
			),
            array(
			
			'header'=>'Jumlah Seluruh',
			'value'=>'$data->quantity',
			),
            array(
			
			'header'=>'Jumlah Rusak',
			'value'=>'$data->quantity_demaged',
			),
	
            array(
			'class'=>'CButtonColumn',
                        'header'=>'Aksi',
			'template'=>'{Detail}',
			'buttons'=>array
			(
				'Detail' => array(
                                   
				 'label'=>'Detail',
				 'url'=>'Yii::app()->createUrl("inventory/view", array("id"=>$data->code_inventory))',
				 ),
                            
			),
		),
            
             array(
			'class'=>'CButtonColumn',
                        'header'=>'Aksi',
			'template'=>'{Detail}',
			'buttons'=>array
			(
				'Detail' => array(
                                   
				 'label'=>'Keluarkan Barang',
				 'url'=>'Yii::app()->createUrl("exportInventory/Export", array("id"=>$data->code_inventory))',
				 ),
                            
			),
		),
    ), 
)); 
?>
 </div>
</div>