<?php
$this->breadcrumbs=array(
	'Universities',
);

$this->menu=array(
	array('label'=>'Create Universities', 'url'=>array('create')),
	array('label'=>'Manage Universities', 'url'=>array('admin')),
);
?>

<h1>Universities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
