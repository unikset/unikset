<?php

/**
 * This is the model class for table "locations".
 *
 * The followings are the available columns in table 'locations':
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property integer $type_id
 *
 * The followings are the available model relations:
 * @property Locations $parent
 * @property Locations[] $locations
 * @property LocationTypes $type
 * @property Universities[] $universities
 */
class Locations extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Locations the static model class
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
		return 'locations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, title, type_id', 'required'),
			array('parent_id, type_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, title, type_id', 'safe', 'on'=>'search'),
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
			'parent' => array(self::BELONGS_TO, 'Locations', 'parent_id'),
			'locations' => array(self::HAS_MANY, 'Locations', 'parent_id'),
			'type' => array(self::BELONGS_TO, 'LocationTypes', 'type_id'),
			'universities' => array(self::HAS_MANY, 'Universities', 'location_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Parent',
			'title' => 'Title',
			'type_id' => 'Type',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('type_id',$this->type_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getParent()
        {
                $criteria = new CDbCriteria;

		$criteria->compare('parent_id', -1);
		
//		return new CActiveDataProvider($this, array(
//			'criteria'=>$criteria,
//		));
                return $this->findAll($criteria);
        }
}