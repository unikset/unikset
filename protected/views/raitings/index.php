<?php
$this->breadcrumbs=array(
	'Raitings',
);

$this->menu=array(
	array('label'=>'Create Raitings', 'url'=>array('create')),
	array('label'=>'Manage Raitings', 'url'=>array('admin')),
);
?>

<h1>Raitings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
