<?php 
/**
 * Блок расшренного поиска документа
 * Опции поиска подгружаются аяксом
 */
?>
<script type="text/javascript">
    function exist_id(str)
    {
        var ttt = document.getElementById(str);
        if (ttt == null)
            return -1;
        else {
            if(ttt.value == "") return -2;
            else return document.getElementById(str).value;
        }
    }
</script>    
<!--<div class="wide form">-->
<div class="wide">
     <?php //$this->widget('SearchWidget');?>
    
    
    
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'post',
            ));
    ?>
    <?php //текстовое поле для полнотекстового поиска?>
    <div class="row">
       
        <?php //echo $form->label($doc, 'link'); ?>
        <?php //echo $form->textField($doc, 'link'); ?>
       <?php echo CHtml::hiddenField('is_university_document','0');?>
        <?php echo CHtml::hiddenField('country_id');?>
        <?php echo CHtml::hiddenField('region_id');?>
        <?php echo CHtml::hiddenField('city_id');?>
        <?php echo CHtml::hiddenField('university_id');?>
        <?php echo CHtml::hiddenField('discipline_id');?>
        <?php echo CHtml::hiddenField('lecture_id');?>
        
        <!-- Виджет текстового поля поиска -->
        <?php $this->widget('SearchTagWidget');?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->