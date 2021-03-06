<?php
$this->breadcrumbs=array(
	'Documents'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Documents', 'url'=>array('index')),
	array('label'=>'Create Documents', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('documents-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<p class="lead well well-small">Manage Documents</p>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php // $this->renderPartial('_search',array(
	//'model'=>$model,
//)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'documents-grid',
        'itemsCssClass'=>'table table-hover',
	'dataProvider'=>$model->searchAdmin(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'description',
		'author_name',
		'link',
		'insert_date',
		'user_ip',
		'is_university_document',
		array(         
                    'name'=>'status',
                    'value'=>'$data->replaceStatus($data->status)',
                ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
