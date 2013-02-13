<?php
$this->breadcrumbs=array(
	Yii::t('app','Documents')=>array('index'),
	$model->title,
);

?>
<div class="pagetitle">
    <h1><?php echo Yii::t('app','Documents');?> &rarr; <?php echo $model->title; ?></h1>
</div>

<div class="details">
    <?php if($model->link):?>
    <div class="link">
        <b><?php echo Yii::t('app','Link');?>:</b>
        <a href="#"><?php echo $model->link;?></a>
    </div>
    <?php endif;?>
    
    <div class="description">
         <b><?php echo Yii::t('app','Description');?>:</b>
        <?php echo CHtml::encode($model->description);?>
    </div>
    
    <div class="author">
         <b><?php echo Yii::t('app','Author');?>:</b>
        <?php echo CHtml::encode($model->author_name);?>
    </div>
    
    <?php if($model->discipline[0]->title):?>
    <div class="discipline-title">
         <b><?php echo Yii::t('app','Discipline');?>:</b>
        <?php echo $model->discipline[0]->title;?>
    </div>
    <?php endif;?>
    
    <?php if($model->lecturer[0]->name):?>
    <div class="discipline-title">
         <b><?php echo Yii::t('app','Lecture');?>:</b>
        <?php echo $model->lecturer[0]->name;?>
    </div>
    <?php endif;?>
    
    <br><br>
<?php /*$this->widget('zii.widgets.CDetailView', array(
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
));*/ ?>
<?php if($model->file_name):?>
    <iframe src="<?php echo Yii::app()->baseUrl;?>/files/<?php echo $model->file_name ?>" height="600" width="700" allowfullscreen></iframe>
<?php elseif($model->link):?>
    <iframe src="<?php echo $model->link;?>" height="600" width="700" allowfullscreen></iframe>
<?php endif; ?>
</div>


