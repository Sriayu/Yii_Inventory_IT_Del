<?php
/* @var $this InventoryController */
/* @var $model Inventory */

$this->breadcrumbs=array(
	'Inventories'=>array('index'),
	'Manage',
);

//$this->menu=array(
//	array('label'=>'List Inventory', 'url'=>array('index')),
//	array('label'=>'Create Inventory', 'url'=>array('importInventory/create')),
//);

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
<div id="tabel">
    
<h1>Daftar Barang Inventory</h1>

<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
        'keyword'=>$keyword,
)); ?>
</div><!-- search-form -->
    
<p>
Berikut Daftar Inventory yang tersedia .
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'inventory-grid',
	'dataProvider'=>$model->cariNamaBarang($keyword),
	'filter'=>$model,
	'columns'=>array(
		//'id',
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
<?php
$url1 = CController::createUrl('inventory/ajaxUpdateNama');
$js = <<< JSCRIPT

function tes(kode_inventori){
 
$('#editData').dialog('open');
var label = $('#label_'+row+'').text();
$('editNama').val(label);
$('kodeinventoriNya').val(kode_inventori);
 
}

function update(){
var nama  = $('editNama').val();
var kode_inventori = $('kodeinventoriNya').val();
$('#editData').dialog('close');
$.post("${url1}", { code_inventory:kode_inventori,name_inventory:nama},
        function(data){
           $('#label_'+row+'').text(data.nama);
           alert('Nama Pegawai telah diupdate menjdi '+data.nama+' ');
        }, "json");
 
}
 
JSCRIPT;
Yii::app()->clientScript->registerScript('disable_keluar', $js, CClientScript::POS_BEGIN);
?>

<?php
// ----- Dialog EditData ----------------------
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'editData',
        'options' => array(
                'title' => 'Update Nama',
                'autoOpen' => false,
                'minWidth' => 300,
                'minHeight' => 100,
                'resizable' => true,
                'modal' => true,
                'show' => 'blind',
                'hide'=>'explode',
        ),
        )
);
?>
<div class="row" id="sidebar-right1">
<?php
echo CHtml::label('Nama :', 'nama');
echo CHtml::textField('editNama', '');
echo CHtml::hiddenField('kodeinventoriNya','');
//echo '&nbsp;';
echo CHtml::button('Simpan', array("onClick"=>"update()"));
?>
</div>
 
<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');
// ----- End dialog Edit Data ----------------------
?>
</div>