<?php
/**
 * Виджет переключателя языков
 */
class LanguageSelector extends CWidget
{
    public function run()
    {
        /**
         * Текущий язык приложения
         */
        $currentLang = Yii::app()->language;
        /**
         * Массив языков из конфига
         */
        $languages = Yii::app()->params->languages;
        /**
         * Рендерим вид и передаем в него текущий язык и массив языков из конфига
         */
        $this->render('languageSelector', array('currentLang' => $currentLang, 'languages'=>$languages));
    }

}