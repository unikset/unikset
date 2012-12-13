<?php

/**
 * This is the model class for table "universities".
 *
 * The followings are the available columns in table 'universities':
 * @property integer $id
 * @property string $title
 * @property string $title_short
 * @property string $description
 * @property integer $location_id
 *
 * The followings are the available model relations:
 * @property Locations $location
 * @property UniversityComments[] $universityComments
 * @property UniversityDocuments[] $universityDocuments
 * @property UniversityRaitings[] $universityRaitings
 */
class Universities extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Universities the static model class
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
		return 'universities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, title_short, description', 'required'),
			array('location_id', 'numerical', 'integerOnly'=>true),
			array('title, title_short', 'length', 'max'=>255),
			array('description', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, title_short, description, location_id', 'safe', 'on'=>'search'),
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
			'location' => array(self::BELONGS_TO, 'Cities', 'location_id'),
			'universityComments' => array(self::HAS_MANY, 'UniversityComments', 'university_id'),
			'universityDocuments' => array(self::HAS_MANY, 'UniversityDocuments', 'university_id'),
			'universityRaitings' => array(self::HAS_MANY, 'UniversityRaitings', 'university_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'title_short' => 'Title Short',
			'description' => 'Description',
			'location_id' => 'Location',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('title_short',$this->title_short,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('location_id',$this->location_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}