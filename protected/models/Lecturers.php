<?php

/**
 * This is the model class for table "lecturers".
 *
 * The followings are the available columns in table 'lecturers':
 * @property integer $id
 * @property string $name
 * @property int $status
 * @property int $discipline_id
 *
 * The followings are the available model relations:
 * @property DocumentLecturers[] $documentLecturers
 */
class Lecturers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Lecturers the static model class
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
		return 'lecturers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, status, discipline_id', 'required'),
			array('name', 'length', 'max'=>1000),
                        array('status', 'numerical', 'integerOnly'=>TRUE, 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, status, discipline_id', 'safe', 'on'=>'search'),
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
			
                        'document' => array(self::BELONGS_TO, 'Documents', 'lecture_id'),
                        'discipline' => array(self::BELONGS_TO, 'Discipline', 'discipline_id'),
                        'universityDocument' => array(self::HAS_MANY, 'UniversityDocuments', array('id'=>'document_id'), 'through'=>'document', 'joinType'=>'INNER JOIN'),
                        'university' => array(self::HAS_MANY, 'Universities', array('university_id'=>'id'), 'through'=>'universityDocument', 'joinType'=>'INNER JOIN'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID lecture',
			'name' => 'Name lecture',
                        'discipline_id'=>'Discinlines'
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
		$criteria->compare('name',$this->name,true);
                $criteria->compare('discipline_id',$this->discipline_id,true);

		return new CActiveDataProvider($this, array());
	}
        
        /**
         * Получение лекций по флагам
         * @param int $dis идентификатор дисциплины
         * @param int $loc_type 
         * @param int $loc 
         * @return object
         */
        public function searchByFlag($discipline_id, $loc_type, $loc_id)
	{
            //echo CVarDumper::dump($dis, 10 ,TRUE);exit;
                /**
                 * 0 : uni_flag - университетский документ или нет. loc_type=0
                 * 2 : country  - страна
                 * 3 : region   - регион(не сделано)
                 * 4 : city     - город
                 * 10: uni      - университет
                 */
		$criteria=new CDbCriteria;
                
                
                
                /**
                 * джойним дисциплины
                 */
//                $criteria->with=array(
//                        'discipline'=>array(
//                            'select'=>'*',
//                            'condition'=>'discipline.id=:dis',
//                            'params'=>array(':dis'=>$discipline_id),
//                            'together'=>true,
//                        ),
//                    );
                //echo CVarDumper::dump($criteria, 10 ,TRUE);exit;
                
                if ($loc_type == 0)
                {
                    /**
                     * джойним документы(зачем?)
                     */
                    $criteria->with['document'] = array(
                        'select'=>'',
                        'condition'=>'document.is_university_document=:uni_flag',
                        'params'=>array(':uni_flag'=>$loc_id),
                        'together'=>true,
                    );
                }
//                if ($loc_type == '2')
//                {
//                    /**
//                     * джойним страну
//                     */
//                    $criteria->with['location'] = array(
//                        'select'=>'',
//                        'condition'=>'location.parent_id=:country',
//                        'params'=>array(':country'=>$loc_id),
//                        'together'=>true,
//                     );
//                }
//                if ($loc_type == '4')
//                {
//                    /**
//                     * джойним город
//                     */
//                    $criteria->with['location'] = array(
//                        'select'=>'',
//                        'condition'=>'location.id=:city',
//                        'params'=>array(':city'=>$loc_id),
//                        'together'=>true,
//                    );
//                }
                if ($loc_type == '10')
                {
                    /**
                     * джойним университет
                     */
                    $criteria->with['university'] = array(
                        'select'=>'',
                        'condition'=>'university.id=:uni',
                        'params'=>array(':uni'=>$loc_id),
                        'together'=>true,
                    );
                }
                
                $criteria->with=array(
                        'discipline'=>array(
                            'select'=>'*',
                            'condition'=>'discipline.id=:dis',
                            'params'=>array(':dis'=>$discipline_id),
                            'together'=>true,
                        ),
                    );
                    
                $criteria->condition='t.status = 2';
                
                
                
		return $this->findAll($criteria);
	}
        
        /**
         * Получение лекций по дисциплине
         * @param int $discipline_id идентификатор дисциплины
         * 
         * @return object
         */
        public function searchByDiscipline($discipline_id)
	{
		$criteria=new CDbCriteria;
                
                $criteria->compare('discipline_id', $discipline_id);
                
                /**
                 * джойним дисциплины
                 
                $criteria->with=array(
                        'discipline'=>array(
                            'select'=>'*',
                            'condition'=>'discipline.id=:dis',
                            'params'=>array(':dis'=>$discipline_id),
                            'together'=>true,
                        ),
                    );
                //echo CVarDumper::dump($criteria, 10 ,TRUE);exit;*/
   
                //$criteria->condition='t.status = 2';
                
                
                
		return $this->findAll($criteria);
	}
}