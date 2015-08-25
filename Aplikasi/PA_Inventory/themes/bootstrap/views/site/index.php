<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<div id="content">
    <img src= "<?php echo Yii::app()->request->baseUrl;?>/images/20140619_080043.jpg"></img>
<?php
//$this->widget('bootstrap.widgets.TbCarousel', array(
//    'items'=>array(
////        array('image'=>'http://localhost/PA/Update/PA_bisa/images/Inventory.jpg', 'label'=>'Institut Teknologi Del', 'caption'=>'System Management Inventory'),
//        array('image'=>'http://localhost/PA/Update/PA_bisa/images/asset.jpg', 'label'=>'Inventory Institut Teknologi Del', 'caption'=>'System Management Inventory'),
//    ),
//)); 
//$this->widget('application.extensions.s3slider.S3Slider',
//        array(
//             'images' => array(
//                    array('images/Inventory.jpg', ''),
//                    array('images/asset.jpg', ''),
////                  array('news/3.jpg', ''),
////                  array('images/koperasi.jpg', ''),
//                  
//                   // array('news/5.jpg', 'Ini yang terakhir'),
//              ),
//              'width' => '1130',
//              'height' => '600',
//        )
//  );
?>
    
</div>
<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
if(Yii::app()->user->checkAccess('staff')){
$this->menu=array(
	
   // array('label' => 'Daftar Peminjaman', 'url' => array('loan/index')),
    array('label' => 'Daftar Tunda', 'url' => array('loan/ViewTunda')),
    array('label' => 'Daftar Belum Disetujui', 'url' => array('loan/ViewBelum')),
    array('label' => 'Daftar Sudah Jatuh Tempo', 'url' => array('loan/SJatuhTempo')),
    array('label' => 'Daftar Belum Jatuh Tempo', 'url' => array('loan/BJatuhTempo')),

);
}else if(Yii::app()->user->checkAccess('member')){
    $this->menu=array(
	// array('label' => 'Daftar Peminjaman', 'url' => array('loan/index'),'visible'=> !Yii::app()->user->isGuest),
         
                        
        );
}

?>




<?php 
//$this->widget('bootstrap.widgets.TbMenu', array(
     // null or 'inverse'
    
   
//    'items'=>array(
//       
//        '<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
//        
//    ),
//)); ?>
	
