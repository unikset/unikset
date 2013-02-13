<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SearchTagWidget
 *
 * @author admin
 */
class SearchTagWidget extends CWidget
{
    public $query;
    
    public function init()
    {
        parent::init();
    }
    public function run()
    {
        $this->renderContent();
        parent::run();
    }
    public function renderContent()
    {
        //echo CHtml::label('Search on text', 'query');
       //echo CHtml::beginForm(array('documents/tagSearch'), 'post', array('style'=> 'inline'));
        echo '<div class="input-append">';
        echo CHtml::textField('query', '', array('placeholder'=> 'search...','class'=>'span9'));
        
        echo CHtml::submitButton(Yii::t('app','Search'), array('name'=>'Search', 'class'=>'btn srch'), array('class'=>'btn'));
        echo '</div>';
        //echo CHtml::submitButton('Search tag');
        //echo CHtml::endForm('');
    }
}

