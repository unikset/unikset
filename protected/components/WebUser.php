<?php
/**
 * Перегруженный класс WebUser
 * Добавлена возможность получения роли пользователя из бд
 */
class WebUser extends CWebUser
{

    private $_model = null;
    
//    public function init()
//    {
//            parent::init();
//            Yii::app()->getSession()->open();
//            if($this->getIsGuest() && $this->allowAutoLogin)
//                    $this->restoreFromCookie();
//            else if($this->autoRenewCookie && $this->allowAutoLogin)
//                    $this->renewCookie();
//            if($this->autoUpdateFlash)
//                    $this->updateFlash();
//
//            $this->updateAuthStatus();
//	}
//        
//    public function beforeLogin($id, $states, $fromCookie)
//    {
//        parent::beforeLogin($id, $states, $fromCookie);
//        die('WeUser::beforeLogin -> входим на основе куки ');
//        return true;
////        if($fromCookie)
////        {
////            if(empty($states['token']))
////            {
////                return false;
////            }
////            
////            $autoLoginKey = $states['token'];
////            
////            $user = User::model()->findByPk($id);
////            
////            $dbToken = $user->token;
////             
////            return !empty($dbToken) && $dbToken === $autoLoginKey;
////        }
////        return true;
//    }
//    protected function restoreFromCookie()
//    {
//        //parent::restoreFromCookie();
//        die('WeUser::restoreFromCookie -> входим на основе куки ');
//    }

    public function getRole()
    {
        if ($user = $this->getModel())
        {
            // Возвращаем имя роли пользователя из связанной таблицы Roles
            return $user->Role->role;
        }
    }

    private function getModel()
    {
        if (!$this->isGuest && $this->_model === null)
        {
            $this->_model = User::model()->findByPk($this->id);
        }
        return $this->_model;
    }

}
