<?php

/**
 * This is the model class for table "documents".
 *
 * The followings are the available columns in table 'documents':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $file_name
 * @property string $author_name
 * @property string $link
 * @property string $insert_date
 * @property string $user_ip
 * @property integer $is_university_document
 * @property integer $status
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property DisciplineDocuments[] $disciplineDocuments
 * @property DocumentComments[] $documentComments
 * @property DocumentLecturers[] $documentLecturers
 * @property DocumentRaitings[] $documentRaitings
 * @property DocumentTags[] $documentTags
 * @property UniversityDocuments[] $universityDocuments
 */
class Documents extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Documents the static model class
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
		return 'documents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description, author_name, user_ip', 'required'),
                        array('file_name', 'file', 'types' => 'pdf', 'allowEmpty'=>true),
			array('is_university_document, status, user_id', 'numerical', 'integerOnly'=>true),
			array('title, author_name, user_ip', 'length', 'max'=>255),
			array('description, link', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, filne_name, author_name, link, insert_date, user_ip, is_university_document, status, user_id', 'safe', 'on'=>'search'),
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
			'disciplineDocuments'  => array(
                            self::HAS_MANY, 'DisciplineDocuments', 'document_id', 'joinType'=>'INNER JOIN'),
                        'discipline'           => array(self::HAS_MANY, 'Discipline', array('discipline_id'=>'id'), 'through'=>'disciplineDocuments', 'joinType'=>'INNER JOIN'),
                    
                        'documentLecturers'    => array(self::HAS_MANY, 'DocumentLecturers', 'document_id', 'joinType'=>'INNER JOIN'),
                        //'lecturer'             => array(self::HAS_MANY, 'Lecturers', array('lecturer_id'=>'id'), 'through'=>'disciplineLecturers', 'joinType'=>'INNER JOIN'),
                        'lecturer'             => array(self::HAS_MANY, 'Lecturers', array('lecturer_id'=>'id'), 'through'=>'documentLecturers', 'joinType'=>'INNER JOIN'),
                    
			'documentComments'     => array(self::HAS_MANY, 'DocumentComments', 'document_id'),
			'documentRaitings'     => array(self::HAS_MANY, 'DocumentRaitings', 'document_id'),
			'documentTags'         => array(self::HAS_MANY, 'DocumentTags', 'document_id'),
			'fileInfo'             => array(self::BELONGS_TO, 'FileInfos', 'file_info_id'),
                    
			'universityDocument'   => array(self::HAS_MANY, 'UniversityDocuments', 'document_id', 'joinType'=>'INNER JOIN'),
                        'university'           => array(self::HAS_MANY, 'Universities', array('university_id'=>'id') ,'through'=>'universityDocument', 'joinType'=>'INNER JOIN'),
                        'location'             => array(self::HAS_MANY, 'Cities', array('location_id'=>'id') ,'through'=>'university', 'joinType'=>'INNER JOIN'),
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
			'description' => 'Description',
                        'file_name' => 'File Name',
			'author_name' => 'Author Name',
			'file_info_id' => 'File Info',
			'insert_date' => 'Insert Date',
			'user_ip' => 'User Ip',
			'is_university_document' => 'Is University Document',
			'status' => 'Status',
		);
	}

	/**
         * Метод поиска документа в таблице Documents
         * @param type $country_id - ID страны
         * @param type $region_id  - ID региона
         * @param type $city_id    - ID города
         * @param type $uni_id     - ID университета
         * @param type $lec_id     - ID лекции
         * @param type $dis_id     - ID дисциплины
         * @return \CActiveDataProvider
         */
	public function search($country_id, $region_id, $city_id, $uni_id, $dis_id, $lec_id)
	{
		$criteria=new CDbCriteria;
                
                if($dis_id != -1)
                {
                    /**
                     * Если передан id дисциплины, добавляем в выборку дисциплину
                     */
                    $criteria->with=array('discipline'=>array(
                            'select'=>'',
                            'condition'=>'discipline.id=:dis',
                            'params'=>array(':dis'=>$dis_id),
                            'together'=>true,
                    ));
                }
                
                if($lec_id != -1)
                {
                    /**
                     * Если передан id лекции, добавляем в выборку лекцию
                     */
                    $criteria->with=array('lecturer'=>array(
                            'select'=>'',
                            'condition'=>'lecturer.id=:lec',
                            'params'=>array(':lec'=>$lec_id),
                            'together'=>true,
                    ));
                }
                
                if ($uni_id != -1)
                {
                    /**
                     * Если передан id университета, добавляем в выборку университет
                     */
                    $criteria->with=array('university'=>array(
                            'select'=>'',
                            'condition'=>'university.id=:uni',
                            'params'=>array(':uni'=>$uni_id),
                            'together'=>true,
                    ));
                }
                else 
                {
                    /**
                     * Если университет не передан в запросе
                     * добавляем в выборку город
                     */
                    if ($city_id != -1)
                    {
                        $criteria->with=array('location'=>array(
                                'select'=>'',
                                'condition'=>'cities.id=:city',
                                'params'=>array(':city'=>$city_id),
                                'together'=>true,
                        ));   
                    }
                    elseif ($region_id !=-1)
                    {
                        /**
                         * Если города нет в зпросе, но есть регион
                         * Добавляем в выборку регион
                         */
                        $criteria->with=array('location'=>array(
                                'select'=>'',
                                'condition'=>'cities.region_id=:region',
                                'params'=>array(':region'=>$region_id),
                                'together'=>true,
                        ));  
                    }
                    else 
                    {
                        /**
                         * Если нет ни города ни региона в запросе, но есть страна
                         * Добавляем в выборку страну
                         */
                        $criteria->with=array('location'=>array(
                                'select'=>'',
                                'condition'=>'location.country_id=:country',
                                'params'=>array(':country'=>$country_id),
                                'together'=>true,
                        )); 
                    }
                }
                /**
                 * Добавляем условия отбора
                 */
		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('author_name',$this->author_name,true);
		$criteria->compare('link',$this->link);
		$criteria->compare('insert_date',$this->insert_date,true);
		$criteria->compare('user_ip',$this->user_ip,true);
		$criteria->compare('is_university_document',$this->is_university_document);
		$criteria->compare('status',$this->status);
                $criteria->compare('user_id',$this->user_id);
                
                $criteria->compare('t.status', 2);
                
                

                return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function searchAdmin()
        {
            // Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('author_name',$this->author_name,true);
		$criteria->compare('link',$this->link);
		$criteria->compare('insert_date',$this->insert_date,true);
		$criteria->compare('user_ip',$this->user_ip,true);
		$criteria->compare('is_university_document',$this->is_university_document);
		$criteria->compare('status',$this->status);
                $criteria->compare('user_id',$this->user_id);
                
                //$criteria->compare('status', 2);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
        }
        
        public function replaceStatus($status)
        {
            switch ($status)
            {
                case 0:
                    $text = 'pre-moderation';
                    break;
                 case 1:
                    $text = 'post-moderation';
                    break;
                 case 2:
                    $text = 'approved';
                    break;
                 case 3:
                    $text = 'deleted';
                    break;

                default: $text = 'untitled';
                    break;
            }
            return $text;
        }
}