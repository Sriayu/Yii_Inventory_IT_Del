<?php

/**
 * This is the model class for table "loan".
 *
 * The followings are the available columns in table 'loan':
 * @property integer $id
 * @property integer $id_user
 * @property string $code_inventory
 * @property integer $id_location
 * @property string $date_loan
 * @property string $date_return
 * @property integer $quantity
 * @property integer $status_apporval
 * @property integer $status_loan
 *
 * The followings are the available model relations:
 * @property Inventory $codeInventory
 * @property Location $idLocation
 * @property Account $idUser
 */
class Loan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Loan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'loan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code_inventory,quantity_loan', 'required'),
			array('id_user, id_location, quantity_loan,quantity_demaged, status_apporval, status_loan', 'numerical', 'integerOnly'=>true),
			array('code_inventory', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_user, code_inventory, id_location, date_loan, date_return, quantity_loan, quantity_demaged, status_apporval, status_loan', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'codeInventory' => array(self::BELONGS_TO, 'Inventory', 'code_inventory'),
			'idLocation' => array(self::BELONGS_TO, 'Location', 'id_location'),
			'idUser' => array(self::BELONGS_TO, 'Account', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_user' => 'Id User',
			'code_inventory' => 'Kode Inventory',
			'id_location' => 'Lokasi',
			'date_loan' => 'Tanggal Pinjam',
			'date_return' => 'Tanggal Kembali',
			'quantity_loan' => 'Jumlah Pinjam',
                        'quantity_demaged'=> 'Jumlah Rusak',
			'status_apporval' => 'Status Persetujuan',
			'status_loan' => 'Status Peminjaman',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('code_inventory',$this->code_inventory);
		$criteria->compare('id_location',$this->id_location);
		$criteria->compare('date_loan',$this->date_loan);
		$criteria->compare('date_return',$this->date_return);
		$criteria->compare('quantity_loan',$this->quantity_loan);
		$criteria->compare('status_apporval',$this->status_apporval);
		$criteria->compare('status_loan',$this->status_loan);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
         public function listUser($id)
	{
		$user = Account::model()->findByPk($id);

		return $user->name;
	}
        
         public function listLocation($id)
	{
		$lokasi = Location::model()->findByPk($id);

		return $lokasi->name;
	}
        
        public function listInventory($id)
	{
		$inventory = Inventory::model()->findByPk($id);

		return $inventory->name_inventory;
	}
        
        public function cariNamaBarang($keyword='')
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		$codeBarang = Inventory::model()->findByAttributes(array('name_inventory'=>$keyword));
                
		$criteria->compare('code_inventory',$codeBarang->code_inventory,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function searchinventory($_inventory_id) { 
        $criteria = new CDbCriteria; 
 
        $criteria->compare('code_inventory', $_inventory_id, true); 
 
        return new CActiveDataProvider($this, array( 
            'criteria' => $criteria, 
        )); 
    } 
}