<?php
$this->breadcrumbs=array(
	'University Raitings',
);

$this->menu=array(
	array('label'=>'Create UniversityRaitings', 'url'=>array('create')),
	array('label'=>'Manage UniversityRaitings', 'url'=>array('admin')),
);
?>

<h1>University Raitings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
