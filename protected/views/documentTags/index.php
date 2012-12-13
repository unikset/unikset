<?php
$this->breadcrumbs=array(
	'Document Tags',
);

$this->menu=array(
	array('label'=>'Create DocumentTags', 'url'=>array('create')),
	array('label'=>'Manage DocumentTags', 'url'=>array('admin')),
);
?>

<h1>Document Tags</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
