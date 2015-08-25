<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
<?php
/* @var $this BarangController */
/* @var $model Barang */
?>
<div id="operation">
<?php
$items = array(
	10=>array(
        'name' => 'Daftar Barang',
        'link' => array('/site/index'),
        'icon' => 'google',
        'active' => 'dashboard'
		),
);

//$this->widget('ext.menu.EMenu', array('items' => $items));
?>
</div>
<h1>Peminjaman Barang</h1>

<?php echo $this->renderPartial('_form_pengeluaran', array('model' => $model, 'inventory' => $inventory)); ?>