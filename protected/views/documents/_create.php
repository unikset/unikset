<script type="text/javascript">
    function exist_id(str){
        var ttt = document.getElementById(str);
        if (ttt == null)
            return -1;
        else {
            if(ttt.value == "") return -2;
            else return document.getElementById(str).value;
        }
    }
</script>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documents-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data')
)); ?>

	<p class="note"><?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
                <?php echo $form->labelEx($model, 'title'); 
		      echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class'=>'validate[required]')); 
		      echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>1000, 'class'=>'validate[required]')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
        
        <div class="row">
                <?php echo $form->labelEx($model, 'file_name'); 
                      echo $form->fileField($model, 'file_name', array('size'=>60,'maxlength'=>255,'class'=>'validate[required]')); 
		      echo $form->error($model,'file_name'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>1000,'class'=>'validate[required]')); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author_name'); ?>
		<?php echo $form->textField($model,'author_name',array('size'=>60,'maxlength'=>255, 'class'=>'validate[required]')); ?>
		<?php echo $form->error($model,'author_name'); ?>
	</div>
        
        
        <div class="select-box">
            
  
        <div id="side_l" style="width:300px">


            <div class="row">
		<?php  echo $form->label($model,'is_university_document'); ?>
                <?php  echo $form->dropDownList($model,'is_university_document', array(0=>'keine',1=>'eine'),
                        array('ajax'=>array(
                                               'type'=>'POST',
                                               'url'=>CController::createUrl('dynamicuniflag'),
                                               'data' => array('uni_flag' => 'js:$(this).val()',
                                                               'discipline' => 'js:exist_id("Discipline_id")',
                                                               'todo' => 'create',),
                                               'dataType' => 'json',
                                               'success'=> "function(data){
                                                   if (data.loc2 == 1) $('#loc_2').show();
                                                   else $('#loc_2').hide();
                                                   
                                                   $('#Cities_4_id').html('<option value= >select city</option>');
                                                   $('#Universities_id').html('<option value= >select university</option>');
                                                   $('#loc_4').hide();
                                                   $('#univer').hide();
                                                   
                                                   $('#Countries_2_id').html(data.loc1); 
                                                   $('#Lecturers_id').html(data.lect1);
                                                }")
                             ));?>
            </div>
            <?php //----------------страны ---------------------?>
            <div class="row" id="loc_2" style="display:none">
		<?php  $country = new Countries();
                       echo $form->label($country,'country'); ?>
                <?php  echo $form->dropDownList($country,'[2]id', array(),
                        array('prompt' => 'select country',
                              'ajax'=>array(
                                   'type'=>'POST',
                                   'url'=>CController::createUrl('getRegions'),
                                   'data' => array('country_id' => 'js:exist_id("Countries_2_id")',
                                                   'is_university' => 'js:exist_id("Documents_is_university_document")',
                                                   'discipline' => 'js:exist_id("Discipline_id")',
                                                   'todo' => 'create',),
                                   'dataType' => 'json',
                                   'success'=> "function(data){
                                       if (data.loc2 == 1) $('#loc_3').show();
                                       else $('#loc_3').hide(); 

                                       $('#Universities_id').html('<option value= >select university</option>');
                                       $('#univer').hide();

                                       $('#Regions_3_id').html(data.loc1); 
                                       $('#Lecturers_id').html(data.lect1);
                                    }"
                               ),'class'=>'validate[required]'
                             ));?>
            </div>
            <?php //----------------регионы---------------------?>
            <div class="row" id="loc_3" style="display:none">
		<?php  $region = new Regions();
                       echo $form->label($region,'region'); ?>
                <?php  echo $form->dropDownList($region,'[3]id', array(),
                        array('prompt' => 'select region',
                              'ajax'=>array(
                                   'type'=>'POST',
                                   'url'=>CController::createUrl('getCities'),
                                   'data' => array('region_id' => 'js:exist_id("Regions_3_id")',
                                                   'is_university' => 'js:exist_id("Documents_is_university_document")',
                                                   'discipline' => 'js:exist_id("Discipline_id")',
                                                   'todo' => 'create',),
                                   'dataType' => 'json',
                                   'success'=> "function(data){
                                       if (data.loc2 == 1) $('#loc_4').show();
                                       else $('#loc_4').hide(); 

                                       $('#Universities_id').html('<option value= >select university</option>');
                                       $('#univer').hide();

                                       $('#Cities_4_id').html(data.loc1); 
                                       $('#Lecturers_id').html(data.lect1);
                                    }"
                               ),'class'=>'validate[required]'
                             ));?>
            </div>
            <?php //----------------------города-----------------------?>
            <div class="row" id="loc_4" style="display:none">
		<?php  $city = new Cities();
                       echo $form->label($city,'city'); ?>
                <?php  echo $form->dropDownList($city,'[4]id', array(),
                        array('prompt' => 'select city',
                              'ajax'=>array(
                                   'type'=>'POST',
                                   'url'=>CController::createUrl('getUniversity'),
                                   'data' => array('city_id' => 'js:exist_id("Cities_4_id")',
                                                   'downlevel_id' => 'js:exist_id("Cities_2_id")',
                                                   'discipline' => 'js:exist_id("Discipline_id")',
                                                   'todo' => 'create',),
                                   'dataType' => 'json',
                                   'success'=> "function(data){
                                       if (data.loc2 == 1) $('#univer').show();
                                       else $('#univer').hide();

                                       $('#Universities_id').html(data.loc1); 
                                       $('#Lecturers_id').html(data.lect1);
                                    }"
                                ),'class'=>'validate[required]'
                             ));?>
            </div>
            <?php //---------------Университеты --------------------?>
            <div class="row" id="univer" style="display:none">
		<?php  $uni = new Universities();
                       echo $form->label($uni,'title'); ?>
                <?php  echo $form->dropDownList($uni,'id', array(),
                        array('prompt' => 'select university',
                              'ajax'=>array(
                                       'type'=>'POST',
                                       'url'=>CController::createUrl('dynamicuniver'),
                                       'data' => array('uni' => 'js:exist_id("Universities_id")',
                                                       'city' => 'js:exist_id("Cities_4_id")',
                                                       'discipline' => 'js:exist_id("Discipline_id")',
                                                       'todo' => 'create',),
                                       'dataType' => 'json',
                                       'success'=> "function(data){
                                           $('#Lecturers_id').html(data.lect1);
                                        }"
                                     ),'class'=>'validate[required]'
                             ));?>
            </div>
    
        </div>
    
        <div id="side_2">
            <?php //---------------Дисциплины -------------------------?>
            <div class="row">
		<?php $dis = new Discipline();
                      echo $form->label($dis,'title'); ?>
                <?php //echo 'a';
                      echo $form->dropDownList($dis,'id', CHtml::listData(Discipline::model()->findAll(), 'id', 'title'),
                        array(  'empty'=>'select discipline',
                                'ajax'=>array(
                                       'type'=>'POST',
                                       'url'=>CController::createUrl('dynamiclecturer'),
                                       'data' => array('discipline' => 'js:exist_id("Discipline_id")',
                                                       'uni' => 'js:exist_id("Universities_id")',
                                                       'city' => 'js:exist_id("Cities_4_id")',
                                                       'country' => 'js:exist_id("Countries_2_id")',
                                                       'uni_flag' => 'js:exist_id("Documents_is_university_document")',
                                                       'todo' => 'create',),
                                       'dataType' => 'json',
                                       'success'=> "function(data){
                                           if (data.lect2 == 1) { $('#lecturer').show();}
                                           else { $('#lecturer').hide(); }
                                           $('#Lecturers_id').html(data.lect1);
                                        }"
                                    ),'class'=>'validate[required]'
                             )); ?>
            </div>
            <?php //-------------------Лекции ---------------------?>
            <div class="row" id="lecturer" style="display:none; active:">
		<?php $lect = new Lecturers();
                      echo $form->label($lect,'name'); ?>
                <?php echo $form->dropDownList($lect,'id', array(),
                        array(  'empty'=>'select discipline',
                                'class'=>'validate[required]'
                            )); ?>
                
            </div>
            
        </div>
            
        </div>
        
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'), array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(document).ready(function(){
        $('#Documents_link').keyup(function(){
            var link = $('#Documents_link').val();
            if(link.length > 0)
            {
                $('#Documents_file_name').attr('disabled', 'disabled');
                $('#Documents_file_name').removeClass('validate[required]');
                $('.Documents_file_nameformError').remove();
            }
            else
            {
                $('#Documents_file_name').removeAttr('disabled');
                $('#Documents_file_name').addClass('validate[required]');
            }
        });
        $('#Documents_file_name').change(function(){
            var filename = $(this).val();
            if(filename.length > 0)
            {
                $('#Documents_link').attr('disabled', 'disabled');
                $('#Documents_link').removeClass('validate[required]');
                $('.Documents_linkformError').remove();
                
            }
            else
            {
                $('#Documents_link').removeAttr('disabled');
                $('#Documents_link').addClass('validate[required]');
            }
        });
        
        $("#documents-form").validationEngine();
    });
</script>