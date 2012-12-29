<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<div class="pagetitle"><h1>Registration User</h1></div>
<div class="page-container">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>