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
        echo CHtml::beginForm(array('documents/tagSearch'), 'post', array('style'=> 'inline'));
        echo CHtml::textField('query', '', array('placeholder'=> 'search...','style'=>'width:140px;'));
        echo CHtml::submitButton('Search tag');
        echo CHtml::endForm('');
    }
}
