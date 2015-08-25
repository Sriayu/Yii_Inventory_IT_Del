<?php
/* @var $this LoanController */
/* @var $model Loan */

$this->breadcrumbs=array(
	'Loans'=>array('index'),

);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#loan-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div id="tabel">
<h1>Daftar Peminjaman</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'damaged-inventory-form',
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
  <?php echo CHtml::beginForm(array('Loan/exportExcel')); 
  
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'loan-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
				'header'=>'No',
				'value'=>'$row+1'
				),
            array(
			'header'=>'Nama Peminjam',
			'value'=>'$data->listUser($data->id_user)',
			),
		 array(
				'header'=>'Inventory',
				'value'=>'$data->listInventory($data->code_inventory)'
				),
//                                'code_inventory',
		 array(
				'header'=>'Tanggal Pinjam',
				'value'=>'$data->date_loan'
				),
//            'date_loan',
		 array(
				'header'=>'Tanggal Kembali',
				'value'=>'$data->date_return'
				),
//            'date_return',
		 array(
				'header'=>'Jumlah Pinjaman',
				'value'=>'$data->quantity_loan'
				),
//            'quantity_loan',
		
            array(
                'header' => 'Status Persetujuan', 'type' => 'raw',
                'value' => '($data->status_apporval ? "Sudah Disetujui" : CHtml::link("Setujui", Array(\'loan/Approve\', \'id\'=>$data->id)))'),
            array('header'=>'Status Penolakan', 'type' => 'raw',
                'value' => '($data->status_apporval == 1 ? "Sudah Diterima" : CHtml::link("Tolak", Array(\'loan/Tolak\', \'id\'=>$data->id)))'),
            array(
                'header' => 'Status Pengembalian', 'type' => 'raw',
                'value' => '($data->status_loan || !$data->status_apporval? "Kembali" : CHtml::link("Kembalikan", Array(\'Loan/ReturnInventory\', \'id\'=>$data->id)))'),
	),
)); ?>
<?php echo CHtml::submitButton('Export'); ?>
	<?php echo CHtml::endForm(); ?>
</div>