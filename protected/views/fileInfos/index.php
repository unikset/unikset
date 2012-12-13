<?php
$this->breadcrumbs=array(
	'File Infoses',
);

$this->menu=array(
	array('label'=>'Create FileInfos', 'url'=>array('create')),
	array('label'=>'Manage FileInfos', 'url'=>array('admin')),
);
?>

<h1>File Infoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
