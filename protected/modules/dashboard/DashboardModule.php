<?php

class DashboardModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'dashboard.models.*',
			'dashboard.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
                    /**
                     * Устанавливаем путь к директории с макетами модуля
                     */
                    $this->layoutPath = "protected/modules/dashboard/views/layouts";
                    
                    /**
                     * Основной макет модуля
                     */
                    $this->layout = 'main';
                    
                    
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}