<?php
$this->breadcrumbs=array(
	'Locations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Locations', 'url'=>array('index')),
	array('label'=>'Create Locations', 'url'=>array('create')),
        array('label'=>'Import from CSV', 'url'=>array('importCsv')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('locations-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Locations</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
	//'cuntries'=>$countries,
//)); ?>
</div><!-- search-form -->
<?php //echo CVarDumper::dump($countries->search(),10,TRUE);exit;?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'countries-grid',
	'dataProvider'=>$countries->search(),
	'filter'=>$countries,
	'columns'=>array(
		'id',
		'country',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'regions-grid',
	'dataProvider'=>$regions->search(),
	'filter'=>$regions,
	'columns'=>array(
		'id',
		'region',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cities-grid',
	'dataProvider'=>$cities->search(),
	'filter'=>$cities,
	'columns'=>array(
		'id',
		'city',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
