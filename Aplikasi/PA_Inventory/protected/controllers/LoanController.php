<?php

class LoanController extends Controller
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
				'actions'=>array('create','update','view','Peminjamindex','Batal','Rusak_inventory','pinjam','admin','SearchLoan'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','index','delete','Pinjaminventory','BelumKembali','Rusak_inventory','SudahSetuju','ReturnInventory','Approve','gagal_approve','Tolak','exportExcel','sudahKembali','SudahSetuju','BelumSetuju'),
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
        
        public function actionExport(){
    //$barang = new DamagedInventory('search');
//        $barang->unsetAttributes();  // clear any default values
//        if (isset($_GET['DamagedInventory']))
//            $barang->attributes = $_GET['DamagedInventory'];
//
      $pinjam = new Loan();
        //$barang->attributes = $_POST['DamagedInventory'];
    $this->widget('ext.EExcelView', array(
        'grid_mode'=>'export',
        'title' => 'Daftar Peminjaman',
	'dataProvider' => $barang->search(),
	//'filter' =>$barang,
	'columns' => array(
		'id',
                'id_user',
                'code_inventory',
                'date_loan',
                'date_return',
                'quantity_loan',
                'quantity_demaged',
               	),
));
    }

        public function actionExportToExcel ()
        {
            $model = new Loan();
          
        $this->widget('ext.EExcelView', array(
            'grid_mode' => 'export',
            'title' => 'Laporan Peminjaman',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => array(
		'id_user',
		'code_inventory',
		'date_loan',
                'date_return',
		'quantity_loan',
            ),
        ));
        }
        
	public function actionCreate()
	{
		$model=new Loan;
//                $inventory = Inventory::model()->findByAttributes(array('code_inventory' => $id));
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Loan']))
		{
			$model->attributes=$_POST['Loan'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        public function actionTolak($id){
            $loan = Loan::model()->findByAttributes(array('id' => $id));
            if ($loan->status_apporval){
                $this->redirect(array('loan/admin'));
            }else{
                if ($loan->delete()) {
                $this->redirect(array('loan/admin'));
            }
            }
        }
        
        public function actionRusak_inventory($id)
	{
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Loan']))
		{
			$model->attributes=$_POST['Loan'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->code_inventory));
		}

		$this->render('rusak_inventory',array(
			'model'=>$model,
		));
	}
        
        public function actionPinjam($id) {
        $inventory = Inventory::model()->findByAttributes(array('id'=>$id));
        $model = new Loan;

        if (isset($_POST['Loan'])) {
            $iduser = Yii::app()->user->id;
            $user = Account::model()->findByAttributes(array('username'=>$iduser));
            $model->attributes = $_POST['Loan'];
            $model->id_user = $iduser;
            $model->code_inventory = $inventory->code_inventory;
            $model->id_location = $inventory->id_location;

            if ($model->save())
                $this->redirect(array('peminjamindex'));
               
//$this->refresh();
        }

        $this->render('pinjam', array(
            'model' => $model, 'inventory' => $inventory,
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

		if(isset($_POST['Loan']))
		{
			$model->attributes=$_POST['Loan'];
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
		$dataProvider=new CActiveDataProvider('Loan');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
        
        public function actionBatal($id) {
        $member = Account::model()->findByAttributes(array('username' => Yii::app()->user->id));
        $loan = Loan::model()->findByAttributes(array('id_user' => Yii::app()->user->id, 'id' => $id));
        if ($loan) {
            if ($loan->delete()) {
                $this->redirect(array('loan/peminjamindex'));
            }
        } else {
            throw new CHttpException(
                    404, 'Ini bukan buku pesanan Anda'
                    );
        }
    }

	/**
	 * Manages all models.
	 */
         public function actionSearchLoan(){
             $counter="SELECT COUNT(*) FROM loan WHERE YEAR(date_loan)='".$_GET['tahun']."'AND MONTH(date_loan)='".$_GET['bulan']."'";
                        $sql="SELECT loan.id, account.name, inventory.name_inventory, date_loan, date_return
                            FROM loan
                            INNER JOIN inventory 
                            ON inventory.code_inventory = loan.code_inventory
                            INNER JOIN account
                            ON account.id = loan.id_user
                            WHERE YEAR(date_loan)='".$_GET['tahun']."'AND MONTH(date_loan)='".$_GET['bulan']."'";

                    $count=Yii::app()->db->createCommand($counter)->queryScalar();
                   $barang = new CSqlDataProvider($sql,array(
						'totalItemCount'=>$count,
						'keyField'=>'id',
						'sort'=>array(
							'attributes'=>array(
								'date_loan',
							),
						),
						'pagination'=>array(
							'pageSize'=>10
						),
					
					));
                   $this->render('searchLoan',array(
                                    'model'=>$barang,
				));
         }
         
        
         public function actionAdmin()
	{    
             if (empty ($_GET['bulan']) && empty ($_GET['tahun'])){
                    $model=new Loan('search');
                    $model->unsetAttributes();  // clear any default values
                    if(isset($_GET['Loan']))
                            $model->attributes=$_GET['Loan'];

                    $this->render('admin',array(
                            'model'=>$model,
                    ));
                }else if (!empty ($_GET['bulan'])&& !empty ($_GET['tahun']))
                    {
                         $counter="SELECT COUNT(*) FROM loan WHERE YEAR(date_loan)='".$_GET['tahun']."'AND MONTH(date_loan)='".$_GET['bulan']."'";
                        $sql="SELECT loan.id, account.name, inventory.name_inventory, date_loan, date_return
                            FROM loan
                            INNER JOIN inventory 
                            ON inventory.code_inventory = loan.code_inventory
                            INNER JOIN account
                            ON account.id = loan.id_user
                            WHERE YEAR(date_loan)='".$_GET['tahun']."'AND MONTH(date_loan)='".$_GET['bulan']."'";

                    $count=Yii::app()->db->createCommand($counter)->queryScalar();
//                    date("Y")
                   $barang = new CSqlDataProvider($sql,array(
						'totalItemCount'=>$count,
						'keyField'=>'id',
						'sort'=>array(
							'attributes'=>array(
								'date_loan',
							),
						),
						'pagination'=>array(
							'pageSize'=>10
						),
					
					));
                   $this->render('searchLoan',array(
                                    'model'=>$barang,
				));
                    }
	}
        
        
        public function actionSudahKembali()
	{
        $dataProvider = new CActiveDataProvider('Loan', array(
            'criteria' => array(
                'select' => array(
                    '`t`.*'
                ),
                'condition' => 'status_loan = 1 and status_apporval = 1',
            )
        ));
                $this->render('sudahKembali', array('dataProvider' => $dataProvider));
        }
        
        public function actionBelumKembali()
	{
            $nol = 0;
        $dataProvider = new CActiveDataProvider('Loan', array(
            'criteria' => array(
                'select' => array(
                    '`t`.*'
                ),
                'condition' => 'status_apporval = 1 AND status_loan = '.$nol.'',
            )
        ));
                $this->render('BelumKembali', array('dataProvider' => $dataProvider));
            }
            
            public function actionSudahSetuju()
	{
        $dataProvider = new CActiveDataProvider('Loan', array(
            'criteria' => array(
                'select' => array(
                    '`t`.*'
                ),
                'condition' => 'status_apporval = 1',
            )
        ));
                $this->render('SudahSetuju', array('dataProvider' => $dataProvider));
            }
            
        
        public function actionBelumSetuju()
	{
            $nol = 0;
        $dataProvider = new CActiveDataProvider('Loan', array(
            'criteria' => array(
                'select' => array(
                    '`t`.*'
                ),
                'condition' => 'status_apporval = '.$nol.' AND status_loan = '.$nol.'',
            )
        ));
                $this->render('belumSetuju', array('dataProvider' => $dataProvider));
            }
        
         public function actionExportExcel ()
        {
            
            $model = new Loan();
          
        $this->widget('ext.EExcelView', array(
            'grid_mode' => 'export',
            'title' => 'Laporan Peminjaman Inventori',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => array(
		'code_inventory',
                //'name_inventory',
                'id_location',
                'date_loan',
                'date_return',
		//'description',
                'quantity_loan',
		'Quantity_demage',
		//'date_submition',
                'status_apporval',
                'status_loan',
            ),
        ));
        }
        
        public function actionPeminjamindex(){
            $userId = Yii::app()->user->id;

             $member = Account::model()->findByAttributes(array('id' => Yii::app()->user->id));
        $dataProvider = new CActiveDataProvider('Loan', array(
            'criteria' => array(
                'select' => array(
                    '`t`.*'
                ),
                'condition' => 'id_user=' . Yii::app()->user->id,
            )
        ));
                $this->render('peminjamindex', array('dataProvider' => $dataProvider));
        }

       public function actionGagal_approve($id)
	{
		$this->render('gagal_approve',array(
			'model'=>$this->loadModel($id),
		));
	}

        public function actionApprove($id)
        {   
              $loanid = Loan::model()->findByPk($id);
              $loan = Loan::model()->findByAttributes(array('id'=>$id));
              
              $inventory= Inventory::model()->findByAttributes(array ('code_inventory'=>$loan->code_inventory));
              $stock = $inventory->quantity - $loan->quantity_loan;
              $dateLoan = new DateTime;
              if ($stock <= 0){
                   //Yii::app()->user->setFlash('failed', 'Stock tidak mencukupi');
                  //  $this->redirect(array('admin','id'=>$loan->id)); // dirender ke file view
                   $this->redirect(array('gagal_approve','id'=>$loan->id));
              }else if ($stock > 0) {
                  $loan->status_apporval = 1;
                  $stock = $inventory->quantity - $loan->quantity_loan;
                  $loan->date_loan = date ("Y-m-d");
                   $inventory->quantity = $stock;
              
              }
                if($loan->save() && $inventory->save()){
                    $this->redirect(array('view','id'=>$loan->id));
            }
        }
        
        
        public function actionNot_Return($id)
	{
		$this->render('Not_Return',array(
			'model'=>$this->loadModel($id),
		));
	}
        public function actionReturnInventory($id)
        {   
              $loanid = Loan::model()->findByPk($id);
              $loan = Loan::model()->findByAttributes(array('id'=>$id));
              $inventory= Inventory::model()->findByAttributes(array ('code_inventory'=>$loan->code_inventory));
              if ($loan->status_apporval){
                  $loan->status_loan = 1;
                  $stock = $inventory->quantity + $loan->quantity_loan - $loan->quantity_demaged;
                  $loan->date_return = date ("Y-m-d");
            Inventory::model()->updateByPk($inventory->code_inventory,array('quantity'=>$stock));
              }else {
                 $this->redirect(array('Not_Return','id'=>$loan->id));
              }
                   
                if($loan->save()){

                    $this->redirect(array('view','id'=>$loan->id));
            }
        }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Loan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Loan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Loan $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='loan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
