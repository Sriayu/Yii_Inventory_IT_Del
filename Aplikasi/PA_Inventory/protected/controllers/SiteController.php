<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
                        {
                            Yii::app()->session->add('username',$model->username);
                            $staff=$this->actionIs_staff($model->username);
                            Yii::app()->session->add('is_staff',$staff);
                               $this->redirect(array('/site/index'));
                        }
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
        
        public function actionIs_staff($username)
        {
            $accounts = Yii::app()->db->createCommand()
                    ->select('is_staff')
                    ->from('account')
                    ->where('username=:username1', array(':username1'=>$username))
                    ->queryRow();
            
            return $accounts['is_staff'];
        }

        /**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
//        public function actionBuildAuthItems() { 
//        try { 
//            $auth = Yii::app()->authManager; 
//        
//            
//            // operations for importInventory
//             $auth->createOperation('create_importInventory','-');
//             $auth->createOperation('view_importInventory','-');
//             $auth->createOperation('update_importInventory','-');
//             $auth->createOperation('admin_importInventory','-');
//             $auth->createOperation('delete_importInventory','-');
//             $auth->createOperation('index_importInventory','-');
//             
//             //operation for inventory
//            $auth->createOperation('view_inventory', '-'); 
//            $auth->createOperation('update_inventory', '-');
//            $auth->createOperation('admin_inventory', '-');
//            $auth->createOperation('delete_inventory', '-'); 
//            $auth->createOperation('index_inventory', '-'); 
//            $auth->createOperation('Index_Staff', '-'); 
//           
//            //operation for loan
//            $auth->createOperation('view_loan', 'to view the detail of a specified loan'); 
//            //$auth->createOperation('index_loan', 'to list all loans'); 
//            //$auth->createOperation('create_loan','-');
//            $auth->createOperation('Rusak_inventory','-');
//            $auth->createOperation('pinjam','-');
//            $auth->createOperation('update_loan','-');
//            $auth->createOperation('delete_loan','-');
//            $auth->createOperation('Batal','-');
//            $auth->createOperation('admin_loan','-');
//            $auth->createOperation('Peminjamanindex','-');
//            $auth->createOperation('Gagal_approve','-');
//            $auth->createOperation('Approve','-');
//            $auth->createOperation('Not_Return','-');
//            $auth->createOperation('ReturnInventory','-');
//            
//            //create operation for damaged
//            $auth->createOperation('Keluar','-');
//            $auth->createOperation('admin_exportInventory','-');
//            
//            //create operation for Damaged
//            $auth->createOperation('create_DamagedInventory','-');
//            $auth->createOperation('view_DamagedInventory','-');
//            $auth->createOperation('admin_DamagedInventory','-');
//            $auth->createOperation('index_DamagedInventory','-');
//            $auth->createOperation('Rusak','-');
//            
//            //create operation for kategori
//            $auth->createOperation('create_Categorie','-');
//            $auth->createOperation('update_Categorie','-');
//            $auth->createOperation('view_Categorie','-');
//            
//            //create operation for lokasi
//            $auth->createOperation('create_Location','-');
//            $auth->createOperation('update_Location','-');
//            $auth->createOperation('view_Location','-');
//            
//             //create operation for Tipe
//            $auth->createOperation('create_Type','-');
//            $auth->createOperation('update_Type','-');
//            $auth->createOperation('view_Type','-');
//            
//            $auth->createOperation('update_account', 'to update his/her profile (member\'s information)'); 
//            $auth->createOperation('cetak_laporan','-');
//            $auth->createOperation('lihat_laporan');
//            
//            
//            //task untuk user
//            $browse_task = $auth->createTask('browse', 'a group of browsing operations'); 
//            $browse_task->addChild('peminjamanindex'); 
//            $browse_task->addChild('admin_inventory');
//            $browse_task->addChild('view_inventory');
//            $browse_task->addChild('Rusak');
//            $browse_task->addChild('Pinjam');
//            $browse_task->addChild('Batal');
//            $browse_task->addChild('update_account');
//            $browse_task->addChild('cetak_laporan');
//            
//            //task untuk staff
//            $manage_import = $auth->createTask('manage_importInventory','a group of managing operation');
//            $manage_import->addChild('create_importInventory');
//            $manage_import->addChild('view_importInventory');
//            $manage_import->addChild('admin_importInventory');
//            $manage_import->addChild('cetak_laporan');
//            
//            $manage_inventory = $auth->createTask('manage_inventory','-');
//            $manage_inventory->addChild('Index_Staff','--');
//            
//            $manage_kategori = $auth->createTask('manage_categorie','-');
//            $manage_kategori->addChild('update_categorie');
//            $manage_kategori->addChild('view_categorie');
//            $manage_kategori->addChild('create_categorie');
//            
//            $manage_lokasi=$auth->createTask('manage_location','--');
//            $manage_lokasi->addChild('update_location');
//            $manage_lokasi->addChild('view_location');
//            $manage_lokasi->addChild('create_location');
//            
//            $manage_tipe = $auth->createTask('manage_type','--');
//            $manage_tipe->addChild('update_type');
//            $manage_tipe->addChild('view_type');
//            $manage_tipe->addChild('create_type');
//            
//            $manage_pinjam = $auth->createTask('manage_loan','-');
//            $manage_pinjam->addChild('admin_loan','-');
//            $manage_pinjam->addChild('Rusak_inventory','-');
//            $manage_pinjam->addChild('Gagal_approve','-');
//            $manage_pinjam->addChild('ReturnInventory','-');
//            $manage_pinjam->addChild('Not_Return','-');
//            $manage_pinjam->addChild('Approve','-');
//
//
//            
//            $staff_role = $auth->createRole('staff','Staff can manage all the stuff inside this application');
//            $user_role = $auth->createRole ('user','User can see all the inventories and borrow it');
//            $staff_role->addChild('manage_loan'); 
//            $staff_role->addChild('manage_type'); 
//            $staff_role->addChild('manage_categorie');
//            $staff_role->addChild('manage_location'); 
//            $staff_role->addChild('manage_inventory');
//            $staff_role->addChild('manage_importInventory'); 
//            
//            $user_role->addChild('browse');
//            
//            
//            //$user_role->addChild('browse'); 
//            //$staff_role->addChild('manage');
//            $staff_role->addChild('index_Staff');
//            $user_role->addChild('peminjamanIndex');
//            // 1 is the account id to whom the 'member' role is given 
//            $auth->assign('staff', 3); 
//            $auth->assign('user',4);
//            
//            echo('Built successfully. This is a one-time execution. Please remove or comment this action.'); 
//            } 
//            catch (CDbException $cdbe) { 
//                        throw new CException('You already have  the auth items declared. 
//                        Please remove or comment this action.'); 
//                        } 
//            } 
        
}