<?php

/**
 * This is the model class for table "export_inventory".
 *
 * The followings are the available columns in table 'export_inventory':
 * @property integer $id
 * @property integer $code_inventory
 * @property integer $id_locationFirst
 * @property integer $id_locationLast
 * @property string $date_export
 * @property integer $quantity
 *
 * The followings are the available model relations:
 * @property Inventory $codeInventory
 * @property Location $idLocationFirst
 * @property Location $idLocationLast
 */
class ExportInventory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ExportInventory the static model class
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
		return 'export_inventory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code_inventory, id_locationFirst, id_locationLast, date_export, quantity', 'required'),
			array('id_locationFirst, id_locationLast, quantity', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, code_inventory, id_locationFirst, id_locationLast, date_export, quantity', 'safe', 'on'=>'search'),
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
			'idLocationFirst' => array(self::BELONGS_TO, 'Location', 'id_locationFirst'),
			'idLocationLast' => array(self::BELONGS_TO, 'Location', 'id_locationLast'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code_inventory' => 'Code Inventory',
			'id_locationFirst' => 'Id Location First',
			'id_locationLast' => 'Id Location Last',
			'date_export' => 'Date Export',
			'quantity' => 'Quantity',
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
		$criteria->compare('code_inventory',$this->code_inventory);
		$criteria->compare('id_locationFirst',$this->id_locationFirst);
		$criteria->compare('id_locationLast',$this->id_locationLast);
		$criteria->compare('date_export',$this->date_export,true);
		$criteria->compare('quantity',$this->quantity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function listInventory($id)
	{
		$inventory = Inventory::model()->findByAttributes(array('code_inventory'=>$id));

		return $inventory->name_inventory;
	}
        
        public function listLocation($id)
	{
		$lokasi = Location::model()->findByPk($id);

		return $lokasi->name;
	}
        
        public function searchinventory($_inventory_id) { 
        $criteria = new CDbCriteria; 
 
        $criteria->compare('code_inventory', $_inventory_id, true); 
 
        return new CActiveDataProvider($this, array( 
            'criteria' => $criteria, 
        )); 
    } 
}