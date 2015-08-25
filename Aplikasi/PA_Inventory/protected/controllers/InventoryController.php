<?php

class InventoryController extends Controller
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
                    
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin','Notifikasi','view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete','index_Staff','update','Notifikasi','penyusutan','AjaxUpdateNama'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
        
          public function actionPenyusutan()
	{
                
             $ImportInventory = new ImportInventory;
		$model=new Inventory('search');
		$model->unsetAttributes();  // clear any default values

                
                $date = date ("Y");
                 $counter="SELECT COUNT(*) FROM import_inventory WHERE ($date - YEAR(date_import)) >= 3 ";
                        $sql="SELECT import_inventory.id, name_inventory, categorie.name, type.name, supplier, quantity, price, date_import
                            FROM import_inventory
                            INNER JOIN categorie 
                            ON categorie.id = import_inventory.id_category
                            INNER JOIN type
                            ON type.id = import_inventory.id_type
                                WHERE ($date - YEAR(date_import)) >= 3";

                    $count=Yii::app()->db->createCommand($counter)->queryScalar();
                   $barang = new CSqlDataProvider($sql,array(
						'totalItemCount'=>$count,
						'keyField'=>'id',
						'sort'=>array(
							'attributes'=>array(
								'date_import',
							),
						),
						'pagination'=>array(
							'pageSize'=>10
						),
					
					));
                   $this->render('penyusutan',array(
                                    'model'=>$barang,
				));
            }
            
	public function actionView($id)
	{
//                $loan = Loan::model()->findByAttributes (array('code_inventory'=>$id));
		 $loan = new Loan('search'); 
                $loan->unsetAttributes(); 
         
                if(isset($_GET['Loan'])){ 
           
            $loan->attributes = $_GET['Loan']; 
        } 
        $this->render('view', array( 
            
            'model'  => Inventory::model()->with('loans')->findByPk($id), 
            'loan' => $loan 
        ));
                
               
	}
        
        public function actionNotifikasi()
        {
            $model = Inventory::model()->findAllByAttributes(array('quantity'=>6));
//            $this->render('approve',array('model'=>$model)); 
        }

        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Inventory;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Inventory']))
		{
			$model->attributes=$_POST['Inventory'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->code_inventory));
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

		if(isset($_POST['Inventory']))
		{
			$model->attributes=$_POST['Inventory'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->code_inventory));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        

                public function actionAjaxUpdateNama(){
                        $nama = $_POST['nama'];
                        $kode_inventori = $_POST['code_inventory'];
                       

                        $model = Inventory::model()->findByPk($kode_inventori);
                        Inventory::model()->updateByPk($model->code_inventory,array('name_inventory'=>$nama));

//                        $model->nama = $nama;
                        if($model->update()){
                        $data['nama']=$model->nama;
                        }
                        else{
                        $model = Inventory::model()->findByPk($kode_inventori);
                        $data['nama']=$model->nama;
                        }
                        echo json_encode($data);
                        Yii::app()->end();
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Inventory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
        

        public function actionAdmin()
	{
		$model=new Inventory('search');
		$model->unsetAttributes();  
		if(isset($_GET['Inventory']))
			$model->attributes=$_GET['Inventory'];
                $keyword='';
		if(isset($_GET['cari']))
			$keyword=$_GET['cari'];

		$this->render('admin',array(
			'model'=>$model,
                        'keyword'=>$keyword,
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionIndex_Staff()
	{
		$model=new Inventory('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Inventory']))
			$model->attributes=$_GET['Inventory'];
                $keyword='';
		if(isset($_GET['cari']))
			$keyword=$_GET['cari'];

		$this->render('index_Staff',array(
			'model'=>$model,
                        'keyword'=>$keyword,
		));
	}

        public function actionBarangKeluar($id)
	{
		$model=$this->loadModel($id);
		$pengeluaran = new ExportInventory;
		$gudang = new Inventory;

		if(isset($_POST['ExportInventory']))
		{
			$pengeluaran->attributes=$_POST['ExportInventory'];
			
			$outbarang = $this->loadGudang($model->id,$_POST['locate']);

			if ($outbarang===null)
			{
				throw new CHttpException(404,'Tidak tersedia barang di gudang');
			}
			else
			{
				$username = Yii::app()->user->name;
				$user=User::model()->findByAttributes(
					array('nkey'=>$username));

				$pengeluaran->id_pengeluaran_user=$user->id;
				$pengeluaran->id_pengeluaran_barang=$model->id;
				$pengeluaran->id_pengeluaran_gudang=$_POST['locate'];
				$pengeluaran->jumlah=$_POST['jumlah_baik']+$_POST['jumlah_buruk'];

				$model->jumlah_baik = $model->jumlah_baik - $_POST['jumlah_baik'];
				$model->jumlah_buruk = $model->jumlah_buruk - $_POST['jumlah_buruk'];
				$model->jumlah = $model->jumlah - $pengeluaran->jumlah;
				$outbarang->jumlah=$outbarang->jumlah-$pengeluaran->jumlah;

				$addbarang = $this->loadGudang($model->id,$_POST['lokasi']);

				if ($addbarang===null)
				{
					$newbarang=new BarangGudang;
					$newbarang->id_gudang=$_POST['lokasi'];
					$newbarang->id_barang=$model->id;
					$newbarang->jumlah=$pengeluaran->jumlah;
					
				}
				else
				{
					$addbarang->jumlah = $addbarang->jumlah + $pengeluaran->jumlah;
				}

				$outbarang->jumlah = $outbarang->jumlah - $pengeluaran->jumlah;

				if($pengeluaran->save() && $model->save() && $outbarang->save() && ($addbarang===null ? $newbarang->save(): $addbarang->save()))
				{
					$this->redirect(array('index'));
				}
			}
		}

		$this->render('pengeluaran',array(
			'model'=>$model,'pengeluaran'=>$pengeluaran,'gudang'=>$gudang,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Inventory the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Inventory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Inventory $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='inventory-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
