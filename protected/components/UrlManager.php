<?php
/**
 * Перегруженный класс UrlManager
 * Добавлена возможность подставления в url языкового кода
 * Переопределен метод creteUrl()
 */
class UrlManager extends CUrlManager
{
    public $languages;
    public $langParam;

    /**
     * Переопределенный метод класса CUrlManager
     * @param string $route
     * @param array $params
     * @param string $ampersand
     * @return string
     */
    public function createUrl($route,$params=array(),$ampersand='&')
    {
        /**
         * Если в параметрах нет языка
         */
        if (!isset($params['language'])) 
        {
            /**
             * Если в сессии есть элемент language, устанавливаем язык приложения из сессии
             */
            if (Yii::app()->user->hasState('language'))
            {
                Yii::app()->language = Yii::app()->user->getState('language');
            }  
            /**
             * Если есть в куках елемент language, берем язык приложения из куки
             */
            else if(isset(Yii::app()->request->cookies['language']))
            {
                 Yii::app()->language = Yii::app()->request->cookies['language']->value;
            } 
            /**
             * Берем язык приложения из конфига
             */
            $params['language']=Yii::app()->language;
        }
        
        return parent::createUrl($route, $params, $ampersand);
    }

}
