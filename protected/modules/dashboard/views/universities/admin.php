<?php
$this->breadcrumbs=array(
	'Universities'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Universities', 'url'=>array('index')),
	array('label'=>'Create Universities', 'url'=>array('create')),
        array('label'=>'Import from CSV', 'url'=>array('importCsv')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('universities-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<p class="lead well well-small">Manage Universities</p>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'universities-grid',
        'itemsCssClass'=>'table',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'title_short',
		'description',
                array(
                    'name'=>'location_id',
                    'value'=>'$data->location->city',
                ),
                array(
                    'name'=>'featured',
                    'value'=>'($data->featured)?"YES":"NO"',
                ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
