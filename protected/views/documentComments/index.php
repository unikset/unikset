<?php
$this->breadcrumbs=array(
	'Document Comments',
);

$this->menu=array(
	array('label'=>'Create DocumentComments', 'url'=>array('create')),
	array('label'=>'Manage DocumentComments', 'url'=>array('admin')),
);
?>

<h1>Document Comments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
