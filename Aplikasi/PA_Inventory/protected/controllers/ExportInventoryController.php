<?php

class ExportInventoryController extends Controller
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
				'actions'=>array('admin','delete','Export','KeluarBarang','searchDemaged','ExportToExcel'),
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
        
        public function actionKeluar($id)
        {   
              $loanid = Loan::model()->findByPk($id);
              $loan = Loan::model()->findByAttributes(array('id'=>$id));
              
              $inventory= Inventory::model()->findByAttributes(array ('code_inventory'=>$loan->code_inventory));
              
              $dateLoan = new DateTime;
              if ($inventory->quantity < $loan->quantity){
                  $this->render('gagal_approve',array(
			'model'=>$this->loadModel($id),
		));
              }else {
                  $loan->status_apporval = 1;
                  $stock = $inventory->quantity - $loan->quantity;
                  $loan->date_loan = date ("Y-m-d");
                   $inventory->quantity = $stock;
              
              }
                if($loan->save() && $inventory->save()){
                    $this->redirect(array('view','id'=>$loan->id));
            }
        }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ExportInventory;
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ExportInventory']))
		{
			$model->attributes=$_POST['ExportInventory'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
         public function actionExportToExcel ()
        {
            $model = new ExportInventory();
          
        $this->widget('ext.EExcelView', array(
            'grid_mode' => 'export',
            'title' => 'Laporan Kerusakan Inventory',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => array(
		'code_inventory',
		'id_locationFirst',
                'id_locationLast',
		'date_export',
		'quantity',
            ),
        ));
        }
        
        public function actionKeluarBarang($id) {
        
        $inventory = Inventory::model()->findByAttributes(array('id'=>$id));
        $model = new ExportInventory;

        if (isset($_POST['ExportInventory'])) {
            
            $model->attributes = $_POST['ExportInventory'];
            $model->code_inventory = $inventory->code_inventory;
            
            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('KeluarBarang', array(
            'model' => $model, 'inventory' => $inventory,
        ));
    }

    public function actionExport($id){
         $inventory = Inventory::model()->findByPk($id);
         //echo $inventory->name_inventory;
        $model = new ExportInventory;

        if (isset($_POST['ExportInventory'])) {
            $model->attributes = $_POST['ExportInventory'];
            $model->code_inventory = $id;
            $model->id_locationFirst = $inventory->id_location;

            if ($model->save()){
                $inventory = Inventory::model()->findByAttributes (array('code_inventory'=>$model->code_inventory));
                $stock = $inventory->quantity - $model->quantity;
                if ($model->quantity <= $inventory->quantity){
                Inventory::model()->updateByPk($inventory->code_inventory,array('quantity'=>$stock));
                $this->redirect(array('view','id'=>$model->id));
                }else
                    {
                         if ($model->delete()){
                    throw new CHttpException(
                    ': Pengeluaran lebih banyak dari stock barang'
                    );
                }
                    }
                
            }
        }

        $this->render('create', array(
            'model' => $model, 
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

		if(isset($_POST['ExportInventory']))
		{
			$model->attributes=$_POST['ExportInventory'];
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
		$dataProvider=new CActiveDataProvider('ExportInventory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

        public function actionsearchDemaged()
        {
            if (!empty ($_GET['bulan'])&& !empty ($_GET['tahun'])){
                    $counter="SELECT COUNT(*) FROM export_inventory WHERE YEAR(date_export)='".$_GET['tahun']."'AND MONTH(date_export)='".$_GET['bulan']."'";
                    $sql="SELECT export_inventory.id, inventory.name_inventory, date_export,
                        export_inventory.quantity, location.name 
                        FROM export_inventory
                        INNER JOIN inventory 
                        ON inventory.code_inventory = export_inventory.code_inventory
                        INNER JOIN location
                        ON location.id = export_inventory.id_locationFirst
                        WHERE YEAR(date_export)='".$_GET['tahun']."'AND MONTH(date_export)='".$_GET['bulan']."'";

                    $count=Yii::app()->db->createCommand($counter)->queryScalar();
//                    date("Y")
                   $barang = new CSqlDataProvider($sql,array(
						'totalItemCount'=>$count,
						'keyField'=>'id',
						'sort'=>array(
							'attributes'=>array(
								'date_export',
							),
						),
						'pagination'=>array(
							'pageSize'=>10
						),
					
					));
                   $this->render('searchDemaged',array(
                                    'model'=>$barang,
				));

                }
                //else if (empty ($_GET['bulan']) && !empty ($_GET['tahun'])){
                    
               // }
                else{
                    echo "test";
                      
                }		
        }
	/**}
	 * Manages all models.
	 */
	public function actionAdmin()
	{                
                if (empty ($_GET['bulan']) && empty ($_GET['tahun'])){
                    $model=new ExportInventory('search');
                    $model->unsetAttributes();  // clear any default values
                    if(isset($_GET['ExportInventory']))
                        
			$model->attributes=$_GET['ExportInventory'];
                    $this->render('admin',array(
			'model'=>$model,
		));
                }else if (!empty ($_GET['bulan']) || !empty ($_GET['tahun'])){
                    $counter="SELECT COUNT(*) FROM export_inventory WHERE YEAR(date_export)='".$_GET['tahun']."'AND MONTH(date_export)='".$_GET['bulan']."'";
                    $sql="SELECT export_inventory.id, inventory.name_inventory, date_export,
                        export_inventory.quantity, location.name 
                        FROM export_inventory
                        INNER JOIN inventory 
                        ON inventory.code_inventory = export_inventory.code_inventory
                        INNER JOIN location
                        ON location.id = export_inventory.id_locationFirst
                        WHERE YEAR(date_export)='".$_GET['tahun']."'AND MONTH(date_export)='".$_GET['bulan']."'";

                    $count=Yii::app()->db->createCommand($counter)->queryScalar();
//                    date("Y")
                   $barang = new CSqlDataProvider($sql,array(
						'totalItemCount'=>$count,
						'keyField'=>'id',
						'sort'=>array(
							'attributes'=>array(
								'date_export',
							),
						),
						'pagination'=>array(
							'pageSize'=>10
						),
					
					));
                   $this->render('searchDemaged',array(
                                    'model'=>$barang,
				));

                }
                //else if (empty ($_GET['bulan']) && !empty ($_GET['tahun'])){
                    
               // }
                else{
                    echo "test";
                      
                }		
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ExportInventory the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ExportInventory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ExportInventory $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='export-inventory-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
