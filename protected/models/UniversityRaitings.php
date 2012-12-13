<?php

/**
 * This is the model class for table "university_raitings".
 *
 * The followings are the available columns in table 'university_raitings':
 * @property integer $id
 * @property integer $raiting_id
 * @property integer $university_id
 *
 * The followings are the available model relations:
 * @property Raitings $raiting
 * @property Universities $university
 */
class UniversityRaitings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UniversityRaitings the static model class
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
		return 'university_raitings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('raiting_id, university_id', 'required'),
			array('raiting_id, university_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, raiting_id, university_id', 'safe', 'on'=>'search'),
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
			'raiting' => array(self::BELONGS_TO, 'Raitings', 'raiting_id'),
			'university' => array(self::BELONGS_TO, 'Universities', 'university_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'raiting_id' => 'Raiting',
			'university_id' => 'University',
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
		$criteria->compare('raiting_id',$this->raiting_id);
		$criteria->compare('university_id',$this->university_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}