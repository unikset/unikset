<div class="form well">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'universities-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="rows">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="rows">
		<?php echo $form->labelEx($model,'title_short'); ?>
		<?php echo $form->textField($model,'title_short',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title_short'); ?>
	</div>

	<div class="rows">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
        
        <?php //Выпадающие списки расположения университета?>
	<div class="rows" id="country-block">
		<?php echo CHtml::label('Country', 'country'); ?>
		<?php echo CHtml::dropDownList('Country_id', $model->location->country_id , CHtml::listData($country, 'id', 'country'), array(
                                'prompt'=>'Select country...',
                                'onchange'=> CHtml::ajax(array(
                                            'type'=>'POST',
                                            'dataType'=>'json',  
                                            'url'=>CController::createUrl('getRegions'),
                                            'success'=>'function(data) { 
                                                if (data.dropdownRegion) {   
                                                    $("#region-block").show(); 
                                                    $("#country-block-input").hide();
                                                    $("#region-block-input").show();
                                                    $("#city-block-input").hide(); 
                                                    $("#Region_id").html(data.dropdownRegion); 
                                                } 
                                                else { 
                                                    $("#region-block").hide(); 
                                                    $("#city-block").hide(); 
                                                    $("#country-block-input").hide();
                                                    $("#region-block-input").show(); 
                                                    $("#city-block-input").show(); 
                                                } 
                                             }',
                                            'data' => array('Country_id' => 'js:$(this).val()'),
                                            //'update'=> '#subcat_0'          
                                        )
                                    ),
                            )
                        ); 
                ?>
		<?php //echo CHtml::error($country,'id'); ?>
	</div>
        <?php //Если Станы еще нет в бд выводим поле ввода?>
        <div class="rows" id="country-block-input">
		<?php echo CHtml::label('Country','Country'); ?>
		<?php echo CHtml::textField('Country'); ?>
		<?php //echo CHtml::error($country,'id'); ?>
	</div>
        <script>
            $('#Country').click(function(){
                $('#country-block').hide();
                $("#region-block").hide(); 
                $("#city-block").hide();
                $("#region-block-input").show(); 
                $("#city-block-input").show(); 
            });
        </script>
        
        
        <?php //регионы подтягиваются аяксом?>
        <div class="rows" id="region-block">
		<?php echo CHtml::label('Region','Region_id'); ?>
		<?php echo CHtml::dropDownList('Region_id', $model->location->region_id , CHtml::listData(Regions::model()->findAllByAttributes(array('country_id'=>$model->location->country_id)), 'id', 'region'), array(
                                'prompt'=>'Select region...',
                                'onchange'=> CHtml::ajax(array(
                                            'type'=>'POST',
                                            'dataType'=>'json',  
                                            'url'=>CController::createUrl('getCities'),
                                            'success'=>'function(data) { 
                                                if (data.dropdownCity) {   
                                                    $("#city-block").show(); 
                                                    $("#city-block-input").show(); 
                                                    $("#region-block-input").hide(); 
                                                    $("#Universities_location_id").html(data.dropdownCity); 
                                                } 
                                                else {  
                                                    $("#city-block").hide();  
                                                    $("#city-block-input").show(); 
                                                } 
                                             }',
                                            'data' => array('Region_id' => 'js:$(this).val()'),
                                            //'update'=> '#subcat_0'          
                                        )
                                    ),
                                )
                        ); ?>
		<?php //echo CHtml::error($country,'id'); ?>
	</div>
        <?php //Если региона еще нет в бд выводим поле ввода?>
        <div class="rows" id="region-block-input">
		<?php echo CHtml::label('Region','Region'); ?>
		<?php echo CHtml::textField('Region'); ?>
		<?php //echo CHtml::error($country,'id'); ?>
	</div>
        <script>
            $('#Region').click(function(){
                $('#region-block').hide();
                $('#city-block').hide();
                $('#city-block-input').show();
            });
        </script>
        
        <?php //Города подтягиваются аяксом?>
        <div class="rows" id="city-block">
		<?php echo CHtml::label('City','location_id'); ?>
		<?php echo CHtml::DropDownList('Universities[location_id]', $model->location_id, CHtml::listData(Cities::model()->findAllByAttributes(array('region_id'=>$model->location->region_id)), 'id', 'city'), array('empty'=>'Select city...')); ?>
		<?php echo CHtml::error($model,'Universities_location_id'); ?>
	</div> 
        <script>
            $('#Universities_location_id').click(function(){
                $('#city-block-input').hide();
            });
        </script>
        <?php //Если города еще нет в бд выводим поле ввода?>
        <div class="rows" id="city-block-input">
		<?php echo CHtml::label('City','City'); ?>
		<?php echo CHtml::textField('City'); ?>
		<?php //echo CHtml::error($country,'id'); ?>
	</div>
        
        <div class="rows">
            <?php echo $form->labelEx($model,'featured'); ?>
            <?php echo $form->radioButtonList($model,'featured', array('0'=>'NO','1'=>'YES')); ?>
            <?php echo $form->error($model,'featured'); ?>
        </div>

	<div class="rows buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
