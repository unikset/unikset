<?php
$this->breadcrumbs=array(
	'Profile Universities',
);

$this->menu=array(
	array('label'=>'Create ProfileUniversity', 'url'=>array('create')),
	array('label'=>'Manage ProfileUniversity', 'url'=>array('admin')),
);
?>

<h1>Profile Universities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
