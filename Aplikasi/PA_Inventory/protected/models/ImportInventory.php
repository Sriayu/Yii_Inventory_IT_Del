<?php

/**
 * This is the model class for table "import_inventory".
 *
 * The followings are the available columns in table 'import_inventory':
 * @property integer $id
 * @property string $code_inventory
 * @property string $name_inventory
 * @property integer $id_location
 * @property integer $id_category
 * @property integer $id_type
 * @property string $unit
 * @property string $supplier
 * @property integer $quantity
 * @property integer $price
  * @property integer $total_price
 * @property string $image
 * @property string $date_import
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Categorie $idCategory
 * @property Location $idLocation
 * @property Type $idType
 */
class ImportInventory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ImportInventory the static model class
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
		return 'import_inventory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_location, id_category, id_type, unit, quantity, price, date_import', 'required'),
			array('id_location, id_category, id_type, quantity, price, total_price', 'numerical', 'integerOnly'=>true),
			array('code_inventory', 'length', 'max'=>100),
			array('name_inventory', 'length', 'max'=>200),
                        array('image', 'file', 'types' => 'jpg, gif, png'),

			array('unit, supplier', 'length', 'max'=>32),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, code_inventory, name_inventory, id_location, id_category, id_type, unit, supplier, quantity, price, image, date_import, description', 'safe', 'on'=>'search'),
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
			'idCategory' => array(self::BELONGS_TO, 'Categorie', 'id_category'),
			'idLocation' => array(self::BELONGS_TO, 'Location', 'id_location'),
			'idType' => array(self::BELONGS_TO, 'Type', 'id_type'),
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
			'name_inventory' => 'Nama Barang',
			'id_location' => 'Lokasi',
			'id_category' => 'Kategori',
			'id_type' => 'Tipe Barang',
			'unit' => 'Satuan',
			'supplier' => 'Distributor',
			'quantity' => 'Jumlah',
			'price' => 'Harga',
                        'total_price' => 'Total Harga',
			'image' => 'Gambar',
			'date_import' => 'Tanggal Pemasukan',
			'description' => 'Deskripsi',
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
		$criteria->compare('id_location',$this->id_location);
		$criteria->compare('id_category',$this->id_category);
		$criteria->compare('id_type',$this->id_type);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('supplier',$this->supplier,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('price',$this->price);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('date_import',$this->date_import,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function listKategori($id)
	{
		$categorie = Categorie::model()->findByPk($id);

		return $categorie->name;
	}
        
        public function listTipe($id)
	{
		$type = Type::model()->findByPk($id);

		return $type->name;
	}
        
        public function searchinventory($_inventory_id) { 
        $criteria = new CDbCriteria; 
 
        $criteria->compare('code_inventory', $_inventory_id, true); 
 
        return new CActiveDataProvider($this, array( 
            'criteria' => $criteria, 
        )); 
    } 
}