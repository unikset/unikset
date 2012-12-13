<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property integer $id_role
 *
 * The followings are the available model relations:
 * @property Roles $idRole
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, salt, email, id_role', 'required'),
			array('id_role', 'numerical', 'integerOnly'=>true),
			array('username, password, salt, email', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, salt, email, id_role', 'safe', 'on'=>'search'),
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
			'Role' => array(self::BELONGS_TO, 'Role', 'id_role'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'salt' => 'Salt',
			'email' => 'Email',
			'id_role' => 'Id Role',
		);
	}
        
        /**
	 * Generates the password hash.
	 * @param string password
	 * @param string salt
	 * @return string hash
	 */
	public function hashPassword($password,$salt)
	{
		return md5($salt.$password);
	}

	/**
	 * Generates a salt that can be used to generate a password hash.
	 * @return string the salt
	 */
	protected function generateSalt()
	{
		return uniqid('',true);
	}
        
        /**
	 * Генерация случайной строки
	 * @return string the salt
	 */
	public static function encrypting()
	{
		return uniqid('',true);
	}
        
        /**
	 * Отправка почтового сообщения
	 * Send mail method
	 */
	public static function sendMail($email,$subject,$message) 
        {
            /**
             * Получить опбратный почтовый адрес из конфига
             */
            $adminEmail = Yii::app()->params['adminEmail'];
            /**
             * Заголовки письма
             */
	    $headers = "MIME-Version: 1.0\r\nFrom: $adminEmail\r\nReply-To: $adminEmail\r\nContent-Type: text/html; charset=utf-8";
	    /**
             * Обрезаем длинные слова
             */
            $message = wordwrap($message, 70);
            /**
             * Заиеняем символы переноса строк
             */
	    $message = str_replace("\n.", "\n..", $message);
            /**
             * Отправляем письмо
             */
	    return mail($email,'=?UTF-8?B?'.base64_encode($subject).'?=',$message,$headers);
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_role',$this->id_role);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}