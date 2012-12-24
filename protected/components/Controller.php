<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
        /**
         * расширяем конструктор класса и добавляем язык для приложения
         * язык приложения будет установлен явно на каждый запрос.
         * Если не установленYii::app()->language явно для каждого запроса в URL, 
         * он будет браться из конфигурационного файла приложения. 
         * @param type $id
         * @param type $module
         */
        public function __construct($id, $module = null)
        {
            parent::__construct($id, $module);
            // Если есть post-запрос, перенаправить приложение на адрес с выбранным языком
            if (isset($_POST['language']))
            {
                //Получаем код языка из пост запроса
                $lang = $_POST['language'];
                //Формирование returnUrl
                $MultilangReturnUrl = $_POST[$lang];
                $this->redirect($MultilangReturnUrl);
            }
            // Установить Язык приложения если предоставлен GET, сессии или куки
            if (isset($_GET['language']))
            {
                //Если вместо языка передано черт знает что, ставим язык по умолчанию
//                if(!preg_match('/[a-z]{2}/', $_GET['language']))
//                {
//                    $_GET['language'] = 'en';
//                }
                //Получаем язык приложения из гет запроса
                Yii::app()->language = $_GET['language'];
                //Устанавливаем язык в сессию
                Yii::app()->user->setState('language', $_GET['language']);
                //Устанавливаем язык в куку
                $cookie = new CHttpCookie('language', $_GET['language']);
                //Устанавливаем время жизни куки 1 год
                $cookie->expire = time() + (60 * 60 * 24 * 365); 
                Yii::app()->request->cookies['language'] = $cookie;
            }
            else if (Yii::app()->user->hasState('language'))
            {
                /**
                 * Если язык установлен в сессии, устанавливаем язык приложения из сессии
                 */
                Yii::app()->language = Yii::app()->user->getState('language');
            }     
            else if (isset(Yii::app()->request->cookies['language']))
            {
                /**
                 * Если язык установлен в куке, устанавливаем язык приложения из куки
                 */
                Yii::app()->language = Yii::app()->request->cookies['language']->value;
            }
                
        }

        /**
         * Формирование url с языковым параметром
         * @param string $lang
         * @return string
         */
        public function createMultilanguageReturnUrl($lang = 'en')
        {
            if (count($_GET) > 0)
            {
                $arr = $_GET;
                $arr['language'] = $lang;
            }
            else
            {
                $arr = array('language' => $lang);
            }
                
            return $this->createUrl('', $arr);
        }
}