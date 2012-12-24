<div id="language-select">
    <?php foreach ($languages as $key => $val):?>
    <?php echo CHtml::link($val, $this->getOwner()->createMultilanguageReturnUrl($key));?><br />
    <?php endforeach;?>
    
<?php
//        // Render options as dropDownList
//        echo CHtml::form();
//        foreach($languages as $key=>$lang) {
//            echo CHtml::hiddenField(
//                $key, 
//                $this->getOwner()->createMultilanguageReturnUrl($key));
//        }
//        echo CHtml::dropDownList('language', $currentLang, $languages,
//            array(
//                'submit'=>'',
//            )
//        ); 
       // echo CHtml::endForm();
?>
</div>