<?php

/**
 * This is the model class for table "inventory".
 *
 * The followings are the available columns in table 'inventory':
 * @property integer $id
 * @property string $code_inventory
 * @property string $name_inventory
 * @property integer $id_type
 * @property integer $id_category
 * @property integer $id_location
 * @property string $unit
 * @property integer $quantity
 * @property string $description
 * @property string $image
 *
 * The followings are the available model relations:
 * @property DamagedInventory[] $damagedInventories
 * @property ImportInventory[] $importInventories
 * @property Categorie $idCategory
 * @property Location $idLocation
 * @property Type $idType
 * @property Loan[] $loans
 */
class Inventory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Inventory the static model class
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
		return 'inventory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code_inventory, name_inventory, id_type, id_category, id_location, unit, quantity', 'required'),
			array('id_type, id_category, id_location, quantity, quantity_demaged', 'numerical', 'integerOnly'=>true),
			array('code_inventory', 'length', 'max'=>100),
			array('name_inventory, image', 'length', 'max'=>200),
			array('unit', 'length', 'max'=>11),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, code_inventory, name_inventory, id_type, id_category, id_location, unit, quantity, quantity_demaged, description, image', 'safe', 'on'=>'search'),
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
			'damagedInventories' => array(self::HAS_MANY, 'DamagedInventory', 'code_inventory'),
			'importInventories' => array(self::HAS_MANY, 'ImportInventory', 'code_inventory'),
			'idCategory' => array(self::BELONGS_TO, 'Categorie', 'id_category'),
			'idLocation' => array(self::BELONGS_TO, 'Location', 'id_location'),
			'idType' => array(self::BELONGS_TO, 'Type', 'id_type'),
			'loans' => array(self::HAS_MANY, 'Loan', 'code_inventory'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code_inventory' => 'Kode Barang',
			'name_inventory' => 'Name Barang',
			'id_type' => 'Tipe Barang',
			'id_category' => 'Kategori',
			'id_location' => 'Lokasi ',
			'unit' => 'Satuan',
			'quantity' => 'Jumlah',
                        'quantity_demaged' => 'Jumlah Rusak',
			'description' => 'Deskripsi',
			'image' => 'Gambar',
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
		$criteria->compare('code_inventory',$this->code_inventory,true);
		$criteria->compare('name_inventory',$this->name_inventory,true);
		$criteria->compare('id_type',$this->id_type);
		$criteria->compare('id_category',$this->id_category);
		$criteria->compare('id_location',$this->id_location);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function cariNamaBarang($keyword='')
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		
		$criteria->compare('name_inventory',$keyword,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function listCategory($id)
	{
		$kate = Categorie::model()->findByPk($id);

		return $kate->name;
	}
        
        public function listType($id)
	{
		$type = Type::model()->findByPk($id);

		return $type->name;
	}
        
        public function listLocation($id)
	{
		$lokasi = Location::model()->findByPk($id);

		return $lokasi->name;
	}
        
        
        public function searchcategori($_categorie_id) { 
        $criteria = new CDbCriteria; 
 
        $criteria->compare('id_category', $_categorie_id, true); 

        return new CActiveDataProvider($this, array( 
            'criteria' => $criteria, 
        )); 
    } 
    
        public function searchlocation($_location_id) { 
        $criteria = new CDbCriteria; 
 
        $criteria->compare('id_location', $_location_id, true); 
 
        return new CActiveDataProvider($this, array( 
            'criteria' => $criteria, 
        )); 
    } 
    
        public function searchtype($_type_id) { 
        $criteria = new CDbCriteria; 
 
        $criteria->compare('id_type', $_type_id, true); 
 
        return new CActiveDataProvider($this, array( 
            'criteria' => $criteria, 
        )); 
    } 
}