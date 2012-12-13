<?php
/**
 * Базовый контроллер модуля администрирования
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class DashController extends CController
{
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
        
        public function init() 
        {
            $this->layout = 'column2';
            //Yii::app()->getClientScript()->registerCoreScript('jquery');
            //Yii::app()->getClientScript()->registerCssFile('/css/admin/menu.css',  CClientScript::POS_HEAD);
            parent::init();
        }


        
}