<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SearchWidget
 *
 * @author admin
 */
class SearchWidget extends CWidget
{
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
        echo CHtml::beginForm(array('documents/textSearch'), 'get', array('style'=> 'inline'));
        echo CHtml::textField('q', '', array('placeholder'=> 'search...','style'=>'width:140px;'));
        echo CHtml::submitButton('Search');
        echo CHtml::endForm('');
    }
}

