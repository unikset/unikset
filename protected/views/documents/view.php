<?php
$this->breadcrumbs=array(
	Yii::t('app','Documents')=>array('index'),
	$model->title,
);

?>

<h1><?php echo Yii::t('app','View Documents');?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'author_name',
		'link',
		'insert_date',
		'user_ip',
		'is_university_document',
		'status',
	),
)); ?>
<?php if($model->file_name):?>
    <iframe src="<?php echo Yii::app()->baseUrl;?>/files/<?php echo $model->file_name ?>" height="600" width="700" allowfullscreen></iframe>
<?php elseif($model->link):?>
    <iframe src="<?php echo $model->link;?>" height="600" width="700" allowfullscreen></iframe>
<?php endif; ?>


