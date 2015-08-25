<?php
/* @var $this AccountController */
/* @var $model Account */

$items = array(
	10=>array(
        'name' => 'Daftar Barang',
        'link' => array('/site/index'),
        'icon' => 'google',
        'active' => 'dashboard'
		),
);
?>

<div id ="formulir">
<h1>Silahkan Ubah Password Anda : <?php echo $model->username; ?></h1>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>