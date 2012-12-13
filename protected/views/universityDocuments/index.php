<?php
$this->breadcrumbs=array(
	'University Documents',
);

$this->menu=array(
	array('label'=>'Create UniversityDocuments', 'url'=>array('create')),
	array('label'=>'Manage UniversityDocuments', 'url'=>array('admin')),
);
?>

<h1>University Documents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
