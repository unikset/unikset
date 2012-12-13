<?php
$this->breadcrumbs=array(
	'Document Raitings',
);

$this->menu=array(
	array('label'=>'Create DocumentRaitings', 'url'=>array('create')),
	array('label'=>'Manage DocumentRaitings', 'url'=>array('admin')),
);
?>

<h1>Document Raitings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
