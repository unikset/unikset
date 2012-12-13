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
<div class="wide form">

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
    </div>

    <div id="side_l" style="width:300px">
        <?php //Выбор флага - университетский документ или нет?>
        <div class="row">
            <?php echo $form->label($doc, 'is_university_document'); ?>
            <?php
            echo $form->dropDownList($doc, 'is_university_document', array(''=>'- is university -', 0 => 'keine', 1 => 'eine'), array('ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('dynamicuniflag'),
                    'data' => array('uni_flag' => 'js:$(this).val()',
                    'discipline' => 'js:exist_id("Discipline_id")',),
                    'dataType' => 'json',
                    'success' => "function(data){
                                                   if (data.loc2 == 1) $('#loc_2').show();
                                                   else $('#loc_2').hide();
                                                   
                                                   $('#Locations_4_id').html('<option value= >select city</option>');
                                                   $('#Universities_id').html('<option value= >select university</option>');
                                                   $('#loc_4').hide();
                                                   $('#univer').hide();
                                                   
                                                   $('#Locations_2_id').html(data.loc1); 
                                                   $('#Lecturers_id').html(data.lect1);
                                                }")
            ));
            ?>
        </div>
        
        <?php //Выбор страны ?>
        <div class="row" id="loc_2" style="display:none">
            <?php $country = new Locations();
            echo $form->label($country, 'title');
            ?>
            <?php
            echo $form->dropDownList($country, '[2]id', array(), array('prompt' => '- select country -',
                'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('dynamiccat'),
                    'data' => array('uplevel_id' => 'js:exist_id("Locations_2_id")',
                        'downlevel' => '0',
                        'downlevel_id' => 'js:exist_id("Documents_is_university_document")',
                        'discipline' => 'js:exist_id("Discipline_id")',),
                    'dataType' => 'json',
                    'success' => "function(data){
                           if (data.loc2 == 1) $('#loc_3').show();
                           else $('#loc_3').hide(); 

                           $('#Universities_id').html('<option value= >select university</option>');
                           $('#univer').hide();

                           $('#Locations_3_id').html(data.loc1); 
                           $('#Lecturers_id').html(data.lect1);
                        }"
                )
            ));
            ?>
        </div>
        
        <?php //выбор региона  ?>
        <div class="row" id="loc_3" style="display:none">
            <?php $region = new Locations();
            echo $form->label($region, 'title');
            ?>
            <?php
            echo $form->dropDownList($region, '[3]id', array(), array('prompt' => '- select region -',
                'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('dynamiccat'),
                    'data' => array('uplevel_id' => 'js:exist_id("Locations_3_id")',
                    'downlevel' => '1',
                    'downlevel_id' => 'js:exist_id("Locations_2_id")',
                    'discipline' => 'js:exist_id("Discipline_id")',),
                    'dataType' => 'json',
                    'success' => "function(data){
                               if (data.loc2 == 1) $('#loc_4').show();
                               else $('#loc_4').hide();

                               $('#Universities_id').html('<option value= >select university</option>');
                               $('#univer').hide();

                               $('#Locations_4_id').html(data.loc1); 
                               $('#Lecturers_id').html(data.lect1);
                            }"
                )
            ));
            ?>
        </div>
        
        <?php //выбор города  ?>
        <div class="row" id="loc_4" style="display:none">
            <?php $city = new Locations();
            echo $form->label($city, 'title');
            ?>
            <?php
            echo $form->dropDownList($city, '[4]id', array(), array('prompt' => '- select city -',
                'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('dynamiccat'),
                    'data' => array('uplevel_id' => 'js:exist_id("Locations_4_id")',
                        'downlevel' => '2',
                        'downlevel_id' => 'js:exist_id("Locations_2_id")',
                        'discipline' => 'js:exist_id("Discipline_id")',),
                    'dataType' => 'json',
                    'success' => "function(data){
                                   if (data.loc2 == 1) $('#univer').show();
                                   else $('#univer').hide();

                                   $('#Universities_id').html(data.loc1); 
                                   $('#Lecturers_id').html(data.lect1);
                                }"
                )
            ));
            ?>
        </div>

        <?php //Выбор университета ?>
        <div class="row" id="univer" style="display:none">
            <?php $uni = new Universities();
            echo $form->label($uni, 'title');
            ?>
            <?php
            echo $form->dropDownList($uni, 'id', array(), array('prompt' => '- select university -',
                'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('dynamicuniver'),
                    'data' => array('uni' => 'js:exist_id("Universities_id")',
                    'city' => 'js:exist_id("Locations_4_id")',
                    'discipline' => 'js:exist_id("Discipline_id")',),
                    'dataType' => 'json',
                    'success' => "function(data){
                                   $('#Lecturers_id').html(data.lect1);
                                }"
                )
            ));
            ?>
        </div>

    </div>

    <div class="side_2">

        <?php //Выбор дисциплины ?>
        <div class="row">
            <?php $dis = new Discipline();
            echo $form->label($dis, 'title');
            ?>
            <?php
            //echo 'a';
            echo $form->dropDownList($dis, 'id', CHtml::listData(Discipline::model()->findAll(), 'id', 'title'), array('empty' => '- select discipline -',
                'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('dynamiclecturer'),
                    'data' => array('discipline' => 'js:exist_id("Discipline_id")',
                    'uni' => 'js:exist_id("Universities_id")',
                    'city' => 'js:exist_id("Locations_4_id")',
                    'country' => 'js:exist_id("Locations_2_id")',
                    'uni_flag' => 'js:exist_id("Documents_is_university_document")',),
                    'dataType' => 'json',
                    'success' => "function(data){
                               if (data.lect2 == 1) { $('#lecturer').show();}
                               else { $('#lecturer').hide(); }
                               $('#Lecturers_id').html(data.lect1);
                            }")
            ));
            ?>
        </div>

        <?php //Выбор лекции ?>
        <div class="row" id="lecturer" style="display:none">
            <?php $lect = new Lecturers();?>
            <?php echo $form->label($lect, 'name');?>
            <?php echo $form->dropDownList($lect, 'id', array(), array('empty' => '- select lecture -',));?>
        </div>

    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div> 

<?php $this->endWidget(); ?>

</div><!-- search-form -->