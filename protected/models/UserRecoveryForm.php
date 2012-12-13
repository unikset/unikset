<?php

/**
 * UserRecoveryForm class.
 * UserRecoveryForm is the data structure for keeping
 * user recovery form data. It is used by the 'recovery' action of 'UserController'.
 */
class UserRecoveryForm extends CFormModel
{

    public $username, $id;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('username', 'required'),
            // password needs to be authenticated
            array('username', 'checkexists'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'username' => "username or email",
        );
    }

    public function checkexists($attribute, $params)
    {
        if (!$this->hasErrors())  // we only want to authenticate when no input errors
        {
            if (strpos($this->username, "@"))
            {
                $user = User::model()->findByAttributes(array('email' => $this->username));
                if ($user)
                {
                    $this->id = $user->id;
                }
                    
            }
            else
            {
                $user = User::model()->findByAttributes(array('username' => $this->username));
                if ($user)
                {
                    $this->id = $user->id;
                }
                    
            }

            if ($user === null)
            {
                if (strpos($this->username, "@"))
                {
                    $this->addError("username", "Email is incorrect.");
                }
                else
                {
                    $this->addError("username", "Username is incorrect.");
                }
            }
                
        }
    }

}