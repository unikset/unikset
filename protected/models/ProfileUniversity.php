<?php

/**
 * This is the model class for table "profile_university".
 *
 * The followings are the available columns in table 'profile_university':
 * @property integer $id_profile
 * @property integer $university_id
 * @property string $address
 *
 * The followings are the available model relations:
 * @property Faculties[] $faculties
 * @property Universities $university
 * @property ProfileUniversityInfo[] $profileUniversityInfos
 * @property ProfileVisibility[] $profileVisibilities
 */
class ProfileUniversity extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProfileUniversity the static model class
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
		return 'profile_university';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('university_id', 'numerical', 'integerOnly'=>true),
			array('address', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_profile, university_id, address', 'safe', 'on'=>'search'),
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
			'faculties' => array(self::HAS_MANY, 'Faculties', 'profile_univesity_id'),
			'university' => array(self::BELONGS_TO, 'Universities', 'university_id'),
			'profileUniversityInfos' => array(self::HAS_MANY, 'ProfileUniversityInfo', 'profile_id'),
			'profileVisibilities' => array(self::HAS_MANY, 'ProfileVisibility', 'profile_university_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_profile' => 'Id Profile',
			'university_id' => 'University',
			'address' => 'Address',
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

		$criteria->compare('id_profile',$this->id_profile);
		$criteria->compare('university_id',$this->university_id);
		$criteria->compare('address',$this->address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}