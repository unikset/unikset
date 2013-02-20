<?php
$this->breadcrumbs=array(
	'Universities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Universities', 'url'=>array('index')),
	array('label'=>'Manage Universities', 'url'=>array('admin')),
        array('label'=>'Import from CSV', 'url'=>array('importCsv')),
);
?>

<p class="lead well well-small">Create Universities</p>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'country'=>$country,)); ?>