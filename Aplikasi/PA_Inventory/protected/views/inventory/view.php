<?php

?>
<div id="tabel">
<h1>Detail Barang <?php echo $model->name_inventory; ?></h1>
<?php 
    echo CHtml::image(Yii::app()->request->baseUrl.'/images/'.$model->image, 'No Image', array("width"=>300));
?>
<div id="tabel2">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name_inventory',
		'id_location',
		'quantity',
                'quantity_demaged',
		'description',
	),
)); ?>
    <h4><?php echo $model->name_inventory; ?> yang dipinjam</h4>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'loan-grid',
	'dataProvider'=>$loan->searchinventory($model->code_inventory),
	'filter'=>$loan,
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
                'value' => '($data->status_loan ? "Sudah Kembali" : CHtml::link("Kembalikan", Array(\'Loan/ReturnInventory\', \'id\'=>$data->id)))'),
	),
)); ?>
</div>
</div>
