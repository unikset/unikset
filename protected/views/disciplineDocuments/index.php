<?php
$this->breadcrumbs=array(
	'Discipline Documents',
);

$this->menu=array(
	array('label'=>'Create DisciplineDocuments', 'url'=>array('create')),
	array('label'=>'Manage DisciplineDocuments', 'url'=>array('admin')),
);
?>

<h1>Discipline Documents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
