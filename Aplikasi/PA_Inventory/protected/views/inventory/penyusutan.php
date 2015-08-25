<h1> Inventory yang sudah berumur tiga tahun atau lebih <h1> 
<div id ="tabel">
<?php
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'import-inventory-grid',
			'dataProvider'=>$model,
			'summaryText'=>Yii::t('app','Menampilkan {start}-{end} dari {count} barang.'),
			'emptyText'=>'Tidak ada',
			'pager'=>array(
				'header'=>'',
				'prevPageLabel'=>'&lt; Sebelumnya',
				'nextPageLabel'=>'Selanjutnya &gt;',
			),
		));
	
?>
</div>	