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
<div class="form">
<?php echo CHtml::form('', 'post', array('enctype'=>'multipart/form-data'));?>

<div class="row">
      <?php echo CHtml::label('Select to file csv', 'csvfile'); ?>
      <?php echo CHtml::fileField('csvfile', 'Select your file...', array('size'=>60,'maxlength'=>255)); ?>
</div>
    
<div class="row buttons">
      <?php echo CHtml::submitButton($model->isNewRecord ? 'Upload' : 'Upload'); ?>
</div>
    
    
<?php echo CHtml::endForm(); ?>

</div><!-- form -->
