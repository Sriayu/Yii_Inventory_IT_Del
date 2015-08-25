<?php

class DamagedInventoryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('rusak','admin','PrintPdf','view','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','update','viewAdmin','ExportToExcel','perbaiki'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function actionPrintPdf($id) {
        //$user = Account::model()->findByAttributes(array('username'=>Yii::app()->user->id));
        //  $model->id_user == 
        //$user=User::model()->findByAttributes(array('nkey'=>Yii::app()->user->id));
        $model = $this->loadModel($id);


        $config = dirname(__FILE__) . '/protected/extensions/tcpdf/tcpdf.php';
        require_once('C:\xampp\htdocs\PA\septika\PA_bisa\protected\extensions\tcpdf\config\tcpdf_config.php');
        require_once('C:\xampp\htdocs\PA\septika\PA_bisa\protected\extensions\tcpdf\tcpdf.php');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor("Nicola Asuni");
        $pdf->SetTitle("TCPDF Example 002");
        $pdf->SetSubject("TCPDF Tutorial");
        $pdf->SetKeywords("TCPDF, PDF, example, test, guide");


// set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' Institut Teknologi Del', PDF_HEADER_STRING, array(5, 64, 255), array(100, 64, 128));
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetFont('dejavusans', '', 10);

// add a page
        $pdf->AddPage();

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        //$pdf->AliasNbPages();

        $pdf->Ln(5);
        //$pdf->AddPage();
        $pdf->SetFont("times", "B", 20);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(127, 31, 0);
        $pdf->Cell(0, 15, "Laporan Kerusakan Inventory ", 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->SetFont("times", "B", 10);
        $pemohon = Account::model()->findByAttributes(array('id'=>$model->id_user));
        $inventory = Inventory::model()->findByAttributes(array('code_inventory'=>$model->code_inventory));
// create some HTM
        $html = '<h2>Diisi oleh pemohon:</h2>
    <table border="1" cellspacing="1" cellpadding="2">
	
	<tr>
                <td>Nama Pemohon</td>
                <td width="20">:</td>
		<td width = "316">  ' . $pemohon->name . '</td>
	</tr>
	<tr>
		<td>Code Inventory</td>
                <td width="20">:</td>
		<td width = "316">  ' . $inventory->name_inventory . '</td>
	</tr>
	<tr>
		<td>Jumlah Inventory yang Rusak</td>
                <td width="20">:</td>
		<td width = "316">  ' . $model->Quantity_demage . '</td>
	</tr>
	<tr>
		<td>Tanggal Permohonan</td>
                <td width="20">:</td>
		<td width = "316">  ' . $model->date_submition . '</td>
                
	</tr>
	<tr>
		<td>Deskripsi</td>
                <td width="20">:</td>
		<td width = "316">  ' . $model->description . '</td> 
	</tr>
</table>';
        $pdf->writeHTML($html, true, false, true, false, '');



        $html1 = '<h2>Diisi oleh maintenance:</h2>
    <table border="1" cellspacing="1" cellpadding="2">
	
	<tr>
                <td>Tanggal Perbaikan</td>
                <td width="20">:</td>
		<td width = "316"></td>
	</tr>
	<tr>
		<td>Diperbaiki oleh</td>
                <td width="20">:</td>
		<td width = "316"></td>
	</tr>
        
        <tr>
		<td>Status Inventory yang diperbaiki</td>
                <td width="20">:</td>
		<td width = "316">Sudah dapat diperbaiki <br>Belum dapat diperbaiki <br>Alasannya :<br><br><br><br></td>
	</tr>

</table>';
        $pdf->writeHTML($html1, true, false, true, false, '');


        $html1 = '
    <table border="1" cellspacing="1" cellpadding="2">
	
	<tr>
                <td height="70">Pemohon</td>
                <td>Maintenance yang Memperbaiki</td>
		<td>Bagian Inventory</td>
	</tr>
</table>';
        $pdf->writeHTML($html1, true, false, true, false, '');

        $pdf->Ln(40);
        $pdf->SetFont("times", "B", 10);
        $html1 = 'Institut Teknologi Del <BR>Jl. Sisingamangaraja Sitoluama-Laguboti <br>Toba Samosir 22381<br>Telp. (0632)331234<br>Fax (0632)331116';

        $pdf->writeHTML($html1, true, false, true, false, '');
        //$public2 = Yii::app()->request->baseUrl . "/images/bird.jpg";
        // $pdf->Image($public2, 0, 0, 111, 111, 'jpg', '', '', false, 300, '', false, false, 0, 0, false, false);


        $pdf->Output("Data Kerusakan Inventory $model->code_inventory.pdf", "I");
    }


        public function actionPerbaiki($id)
        {     
              $damaged = DamagedInventory::model()->findByAttributes(array ('id'=>$id));
              $damaged->status_repair = 1;  

              $inventory = Inventory::model()->findByAttributes(array('code_inventory'=>$damaged->code_inventory));
              
              $stock = $inventory->quantity + $damaged->Quantity_demage;
              $jumlah_rusak = $inventory->quantity_demaged - $damaged->Quantity_demage;
              Inventory::model()->updateByPk($inventory->code_inventory, array('quantity'=>$stock));
              Inventory::model()->updateByPk($inventory->code_inventory, array('quantity_demaged'=>$jumlah_rusak));
              
               if($damaged->save()){
                    $this->redirect(array('viewAdmin','id'=>$damaged->id));
            }
        }
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
        public function actionViewAdmin($id)
	{
		$this->render('viewAdmin',array(
			'model'=>$this->loadModel($id),
		));
	}
        
        public function actionExportToExcel ()
        {
            $model = new DamagedInventory();
          
        $this->widget('ext.EExcelView', array(
            'grid_mode' => 'export',
            'title' => 'Laporan Kerusakan Inventory',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => array(
		'code_inventory',
                //'name_inventory',
               // 'date_loan',
                //'date_return',
		'description',
                'status_repair',
                //'quantity_loan',
		'Quantity_demage',
		'date_submition',
                //'status_apporval',
                //'status_loan',
            ),
        ));
        }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new DamagedInventory;
                $rusak = new DamagedInventory;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                 $temp = CUploadedFile::getInstance($model, 'image');
                 
		if(isset($_POST['DamagedInventory']))
		{       
                        $quantity = $_POST['Quantity_demage'];
                        $rusak = $_POST['DamagedInventory'];
                        $loan = Loan::model()->findByAttributes (array('code_inventory'=>$_POST['code_inventory']));
                        if ($rusak->Quantity_demage <= $loan->quantity_loan){
//                            $model->attributes=$_POST['DamagedInventory'];
//                        $model->image = $temp;
//			if($model->save()){
//				$this->redirect(array('view','id'=>$model->id));
                        
                        $temp->SaveAs(Yii::app()->basePath . '/../images/' . $model->image->getName());
                 Yii::app()->user->setFlash('success','Data saved successfully');
                $this->redirect(array('view', 'id' => $model->id));
//                        }
                        }else {
                            
                            $this->redirect(array('inventory/view', 'id' => $model->code_inventory));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DamagedInventory']))
		{
			$model->attributes=$_POST['DamagedInventory'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
        
        
        public function actionRusak($id) {
        $loan = Loan::model()->findByAttributes(array('id'=>$id));
        $model = new DamagedInventory;
        $inventory = Inventory::model()->findByAttributes(array('code_inventory'=>$loan->code_inventory));
        if (isset($_POST['DamagedInventory'])) {
            $iduser = Yii::app()->user->id;
            $user = Account::model()->findByAttributes(array('username'=>$iduser));
            $model->attributes = $_POST['DamagedInventory'];
            
            $model->id_user = $iduser;
            $model->code_inventory = $inventory->code_inventory;
            $model->date_submition = date("Y-m-d");
            
            
            if ($model->save() ){                
                $loan->quantity_demaged = $model->Quantity_demage;
                
                $jumlah_Rusak = $model->Quantity_demage + $inventory->quantity_demaged;
                
                if ($loan->quantity_loan >= $model->Quantity_demage){
               Inventory::model()->updateByPk($inventory->code_inventory, array('quantity_demaged'=>$jumlah_Rusak));
                $this->redirect(array('view','id'=>$model->id));
                 }
            else {
                if ($model->delete()){
                    throw new CHttpException(
                    ': Kerusakan terlalu banyak dari peminjaman'
                    );
                }
            }
            }
           
        }

        $this->render('rusak', array(
            'model' => $model, 'inventory' => $inventory,
        ));
    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('DamagedInventory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
        
        public function actionSearchDemagedInventory()
        {
            $counter="SELECT COUNT(*) FROM damaged_inventory WHERE YEAR(date_submition)='".$_GET['tahun']."'AND MONTH(date_submition)='".$_GET['bulan']."'";
                        $sql="SELECT  damaged_inventory.id, account.name, inventory.name_inventory, damaged_inventory.Quantity_demage, damaged_inventory.description, date_submition
                            FROM damaged_inventory
                            INNER JOIN inventory 
                            ON damaged_inventory.code_inventory = inventory.code_inventory
                            INNER JOIN account
                            ON account.id = damaged_inventory.id_user
                            WHERE YEAR(date_submition)='".$_GET['tahun']."'AND MONTH(date_submition)='".$_GET['bulan']."'";

                    $count=Yii::app()->db->createCommand($counter)->queryScalar();
//                    date("Y")
                   $barang = new CSqlDataProvider($sql,array(
						'totalItemCount'=>$count,
						'keyField'=>'id',
						'sort'=>array(
							'attributes'=>array(
								'date_submition',
							),
						),
						'pagination'=>array(
							'pageSize'=>10
						),
					
					));
                   $this->render('searchDemagedInventory',array(
                                    'model'=>$barang,
				));
                
        }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
            if (empty ($_GET['bulan']) || empty ($_GET['tahun']))
            {
		$model=new DamagedInventory('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DamagedInventory']))
			$model->attributes=$_GET['DamagedInventory'];

		$this->render('admin',array(
			'model'=>$model,
		));
            }else
                {
                    $counter="SELECT COUNT(*) FROM damaged_inventory WHERE YEAR(date_submition)='".$_GET['tahun']."'AND MONTH(date_submition)='".$_GET['bulan']."'";
                        $sql="SELECT  damaged_inventory.id, account.name, inventory.name_inventory, damaged_inventory.Quantity_demage, damaged_inventory.description, date_submition
                            FROM damaged_inventory
                            INNER JOIN inventory 
                            ON damaged_inventory.code_inventory = inventory.code_inventory
                            INNER JOIN account
                            ON account.id = damaged_inventory.id_user
                            WHERE YEAR(date_submition)='".$_GET['tahun']."'AND MONTH(date_submition)='".$_GET['bulan']."'";

                    $count=Yii::app()->db->createCommand($counter)->queryScalar();
//                    date("Y")
                   $barang = new CSqlDataProvider($sql,array(
						'totalItemCount'=>$count,
						'keyField'=>'id',
						'sort'=>array(
							'attributes'=>array(
								'date_submition',
							),
						),
						'pagination'=>array(
							'pageSize'=>10
						),
					
					));
                   $this->render('searchDemagedInventory',array(
                                    'model'=>$barang,
				));
                }
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DamagedInventory the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DamagedInventory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DamagedInventory $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='damaged-inventory-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
