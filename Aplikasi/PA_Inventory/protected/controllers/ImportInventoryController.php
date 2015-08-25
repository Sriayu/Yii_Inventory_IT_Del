<?php

class ImportInventoryController extends Controller
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','create','update','admin','SearchImportInventory','ExportToExcel'),
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ImportInventory;
                 $temp = CUploadedFile::getInstance($model, 'image');
                $model->image = $temp;
                $dataProvider=new CActiveDataProvider('ImportInventory');
		
		if(isset($_POST['ImportInventory']))
		{
			$model->attributes=$_POST['ImportInventory'];
                        $model->date_import = date ("Y-m-d");
                        $total_harga = $model->quantity * $model->price;
                        $model->total_price = $total_harga;
                        
                        $kode_location = Location::model()->findByAttributes (array('id'=>$model->id_location));
                        $kode_tipe = Type::model()->findByAttributes (array('id'=>$model->id_type));
                        $bulan = date("d");
                        $tahun = date ("y");
                        
                        $chars = array_merge(range(0,9));
                        shuffle($chars);
                        $code = implode(array_slice($chars, 0,3));
                        
                        $model->code_inventory = "Del/".$kode_location->code_location.".".$kode_tipe->code_type.".".$code."/".$bulan."/".$tahun;
                        $old2 = Inventory::model()->findByAttributes(array('code_inventory'=>$model->code_inventory));
                        if($old2){
                            $old2->quantity = $old2->quantity + $model->quantity;
                            
                            if($old2->save() && $model->save())
                            {   
                                $temp->SaveAs(Yii::app()->basePath . '/../images/' . $model->image->getName());
                 Yii::app()->user->setFlash('success','Data saved successfully');
                $this->redirect(array('view', 'id' => $model->id));
                            }
                        } else {
//                            Inventory::model()->updateByPk($inventory->code_inventory,array('quantity'=>$stock));
//                            $bulan = date(d);
//                            $tahun = date(y);
                            
                            $newInventory = new Inventory();
                            $newInventory->code_inventory = $model->code_inventory;
                            $newInventory->name_inventory = $model->name_inventory;
                            $newInventory->id_type = $model->id_type;
                            $newInventory->id_category = $model->id_category;
                            $newInventory->id_location = $model->id_location;
                            $newInventory->unit= $model->unit;
                            $newInventory->quantity = $model->quantity;
                            $newInventory->image = $model->image;
                            $newInventory->description = $model->description;
                            if($newInventory->save() && $model->save())
                            {
                                   $temp->SaveAs(Yii::app()->basePath . '/../images/' . $model->image->getName());
                 Yii::app()->user->setFlash('success','Data saved successfully');
                $this->redirect(array('view', 'id' => $model->id));
                            }
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

		if(isset($_POST['ImportInventory']))
		{
			$model->attributes=$_POST['ImportInventory'];
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            if (empty ($_GET['bulan']) && empty ($_GET['tahun'])){
                    $model=new ImportInventory('search');
                    $model->unsetAttributes();  // clear any default values
                    if(isset($_GET['ImportInventory']))
                            $model->attributes=$_GET['ImportInventory'];

                    $this->render('admin',array(
                            'model'=>$model,
                    ));
            }
            else {
                $counter="SELECT COUNT(*) FROM import_inventory WHERE YEAR(date_import)='".$_GET['tahun']."'AND MONTH(date_import)='".$_GET['bulan']."'";
                        $sql="SELECT import_inventory.id, name_inventory, categorie.name, type.name, supplier, quantity, price, date_import
                            FROM import_inventory
                            INNER JOIN categorie 
                            ON categorie.id = import_inventory.id_category
                            INNER JOIN type
                            ON type.id = import_inventory.id_type
                            WHERE YEAR(date_import)='".$_GET['tahun']."'AND MONTH(date_import)='".$_GET['bulan']."'";

                    $count=Yii::app()->db->createCommand($counter)->queryScalar();
//                    date("Y")
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
                   $this->render('searchImportInventory',array(
                                    'model'=>$barang,
				));
            }
	}

        public function actionExportToExcel ()
        {
            $model = new ImportInventory();
          
        $this->widget('ext.EExcelView', array(
            'grid_mode' => 'export',
            'title' => 'Laporan Pemasukan Inventory',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => array(
                'code_invenory',
		'name_inventory',
                'id_location',
                'id_category',
                'id_type',
		'unit',
		'supplier',
		'quantity',
                'price',
                'total_price',
                'date_import',
                'description',
            ),
        ));
        }
        
        public function actionSearchImportInventory(){
                           $counter="SELECT COUNT(*) FROM import_inventory WHERE YEAR(date_import)='".$_GET['tahun']."'AND MONTH(date_import)='".$_GET['bulan']."'";
                        $sql="SELECT import_inventory.id, name_inventory, categorie.name, type.name, supplier, quantity, price, date_import
                            FROM import_inventory
                            INNER JOIN categorie 
                            ON categorie.id = import_inventory.id_category
                            INNER JOIN type
                            ON type.id = import_inventory.id_type
                            WHERE YEAR(date_import)='".$_GET['tahun']."'AND MONTH(date_import)='".$_GET['bulan']."'";

                    $count=Yii::app()->db->createCommand($counter)->queryScalar();
//                    date("Y")
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
                   $this->render('searchImportInventory',array(
                                    'model'=>$barang,
				));
        }


        public function actionAdmin()
	{
            if (empty ($_GET['bulan']) && empty ($_GET['tahun'])){
                    $model=new ImportInventory('search');
                    $model->unsetAttributes();  // clear any default values
                    if(isset($_GET['ImportInventory']))
                            $model->attributes=$_GET['ImportInventory'];

                    $this->render('admin',array(
                            'model'=>$model,
                    ));
            }
            else {
                $counter="SELECT COUNT(*) FROM import_inventory WHERE YEAR(date_import)='".$_GET['tahun']."'AND MONTH(date_import)='".$_GET['bulan']."'";
                        $sql="SELECT import_inventory.id, name_inventory, categorie.name, type.name, supplier, quantity, price, date_import
                            FROM import_inventory
                            INNER JOIN categorie 
                            ON categorie.id = import_inventory.id_category
                            INNER JOIN type
                            ON type.id = import_inventory.id_type
                            WHERE YEAR(date_import)='".$_GET['tahun']."'AND MONTH(date_import)='".$_GET['bulan']."'";

                    $count=Yii::app()->db->createCommand($counter)->queryScalar();
//                    date("Y")
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
                   $this->render('searchImportInventory',array(
                                    'model'=>$barang,
				));
            }
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ImportInventory the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ImportInventory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ImportInventory $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='import-inventory-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
