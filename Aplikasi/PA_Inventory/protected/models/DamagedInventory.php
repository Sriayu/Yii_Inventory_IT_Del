<?php

/**
 * This is the model class for table "damaged_inventory".
 *
 * The followings are the available columns in table 'damaged_inventory':
 * @property integer $id
 * @property integer $id_user
 * @property string $code_inventory
 * @property integer $id_type
 * @property integer $id_category
 * @property string $description
 * @property integer $status_repair
 * @property integer $Quantity_demage
 * @property string $image
 * @property string $date_submition
 *
 * The followings are the available model relations:
 * @property Categorie $idCategory
 * @property Inventory $codeInventory
 * @property Type $idType
 * @property Account $idUser
 */
class DamagedInventory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DamagedInventory the static model class
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
		return 'damaged_inventory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, code_inventory,Quantity_demage', 'required'),
			array('id_user, status_repair, Quantity_demage', 'numerical', 'integerOnly'=>true),
			array('code_inventory', 'length', 'max'=>32),
			array('description, image', 'length', 'max'=>200),
			array('date_submition', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_user, code_inventory, descriptions, status_repair, Quantity_demage, image, date_submition', 'safe', 'on'=>'search'),
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
//			'idCategory' => array(self::BELONGS_TO, 'Categorie', 'id_category'),
			'codeInventory' => array(self::BELONGS_TO, 'Inventory', 'code_inventory'),
//			'idType' => array(self::BELONGS_TO, 'Type', 'id_type'),
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
			'code_inventory' => 'Code Inventory',
//			'id_type' => 'Id Type',
//			'id_category' => 'Id Category',
			'description' => 'Description',
			'status_repair' => 'Status Repair',
			'Quantity_demage' => 'Quantity Demage',
			'image' => 'Image',
			'date_submition' => 'Date Submition',
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
		$criteria->compare('code_inventory',$this->code_inventory,true);
//		$criteria->compare('id_type',$this->id_type);
//		$criteria->compare('id_category',$this->id_category);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status_repair',$this->status_repair);
		$criteria->compare('Quantity_demage',$this->Quantity_demage);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('date_submition',$this->date_submition,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        public function listUser($id)
	{
		$user = Account::model()->findByPk($id);

		return $user->name;
	}
        
        public function listInventory($id)
	{
		$inventory = Inventory::model()->findByPk($id);

		return $inventory->name_inventory;
	}
        
        public function searchinventory($_inventory_id) { 
        $criteria = new CDbCriteria; 
 
        $criteria->compare('code_inventory', $_inventory_id, true); 
 
        return new CActiveDataProvider($this, array( 
            'criteria' => $criteria, 
        )); 
    } 
}