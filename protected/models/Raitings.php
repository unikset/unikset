<?php

/**
 * This is the model class for table "raitings".
 *
 * The followings are the available columns in table 'raitings':
 * @property integer $id
 * @property integer $raiting_value
 * @property string $insert_date
 * @property string $author_ip
 *
 * The followings are the available model relations:
 * @property DocumentRaitings[] $documentRaitings
 * @property UniversityRaitings[] $universityRaitings
 */
class Raitings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Raitings the static model class
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
		return 'raitings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('raiting_value, insert_date, author_ip', 'required'),
			array('raiting_value', 'numerical', 'integerOnly'=>true),
			array('author_ip', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, raiting_value, insert_date, author_ip', 'safe', 'on'=>'search'),
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
			'documentRaitings' => array(self::HAS_MANY, 'DocumentRaitings', 'raiting_id'),
			'universityRaitings' => array(self::HAS_MANY, 'UniversityRaitings', 'raiting_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'raiting_value' => 'Raiting Value',
			'insert_date' => 'Insert Date',
			'author_ip' => 'Author Ip',
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
		$criteria->compare('raiting_value',$this->raiting_value);
		$criteria->compare('insert_date',$this->insert_date,true);
		$criteria->compare('author_ip',$this->author_ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}