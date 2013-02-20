<?php 
$this->breadcrumbs=array(
	'Universities'=>array('index'),
	'Import from CSV',
);

$this->menu=array(
	array('label'=>'List Universities', 'url'=>array('index')),
	array('label'=>'Manage Universities', 'url'=>array('admin')),
        array('label'=>'Import from CSV', 'url'=>array('importCsv')),
);
?>
<div class="form well">
<?php echo CHtml::form('', 'post', array('enctype'=>'multipart/form-data'));?>

<div class="rows">
     <?php echo CHtml::label('Select to file csv', 'csvfile'); ?> 
</div>
    
<div class="fileupload fileupload-new" data-provides="fileupload">
  <div class="input-append">
    <div class="uneditable-input span3">
        <i class="icon-file fileupload-exists"></i> 
        <span class="fileupload-preview"></span>
    </div>
      <span class="btn btn-file">
          <span class="fileupload-new">Select file</span>
          <span class="fileupload-exists">Change</span>     
            <?php echo CHtml::fileField('csvfile', 'Select your file...', array('size'=>60,'maxlength'=>255)); ?>
      </span>
      <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
  </div>
</div>
    
<div class="rows buttons">
      <?php echo CHtml::submitButton($model->isNewRecord ? 'Upload' : 'Upload', array('class'=>'btn btn-success')); ?>
</div>
    
    
<?php echo CHtml::endForm(); ?>

</div><!-- form -->
