<?php
/* @var $this ImportInventoryController */
/* @var $model ImportInventory */

$this->breadcrumbs=array(
	'Import Inventories'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#import-inventory-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<div id="tabel">
<h1>Laporan Pemasukan Inventori</h1>
<div id ="button">
<a href="<?php echo $this->createURL('importInventory/ExportToExcel');?>">
<button>Cetak Laporan</button>
</a>
</div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'importInventory-form',
	'enableAjaxValidation'=>false,
	'method'=>'get',
)); ?>

<tr>
	<td>Bulan</td>
	<td><select name='bulan'> 
		<option value='' selected >--</option>
		<option value='1'>Januari</option>
		<option value='2'>Februari</option>
		<option value='3'>Maret</option>
		<option value='4'>April</option>
		<option value='5'>Mei</option>
		<option value='6'>Juni</option>
		<option value='7'>Juli</option>
		<option value='8'>Agustus</option>
		<option value='9'>September</option>
		<option value='10'>Oktober</option>
		<option value='11'>November</option>
		<option value='12'>Desember</option>
	</select></td>
	&nbsp;
	<td>Tahun</td>
	<td><select name='tahun'> 
		<option value='' selected >--</option>
		<?php for($i=2010;$i<=date("Y");$i++)
		{
		?>
		<option value='<?php echo $i;?>' ><?php echo $i;?></option>
		<?php
		}
		?>
	</select></td>
	&nbsp;
	<td><?php echo CHtml::submitButton('Lihat'); ?></td>

	</tr>
                    
        <?php $this->endWidget(); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'import-inventory-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
            array(
				'header'=>'No',
				'value'=>'$row+1'
				),
            array(
                    'header'=>'Nama Inventory',
                    'value'=> '$data->name_inventory'
		),
            array(
                    'header'=>'Kategori',
                    'value'=> '$data->listKategori($data->id_category)'
		),
            array(
                    'header'=>'Tipe',
                    'value'=> '$data->listTipe($data->id_type)'
		),
            array(
                    'header'=>'Nama Suplier',
                    'value'=> '$data->supplier'
		),
            array(
                    'header'=>'Jumlah Pemasukan',
                    'value'=> '$data->quantity'
		),
            array(
                    'header'=>'Harga Barang',
                    'value'=> '$data->price'
		),
            array(
                    'header'=>'Tanggal Transaksi',
                    'value'=> '$data->date_import'
		),
	),
)); ?>
</div>