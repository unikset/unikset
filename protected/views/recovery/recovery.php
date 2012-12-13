<?php $this->pageTitle=Yii::app()->name . ' - '.Yii::t('user',"Restore");
$this->breadcrumbs=array(
	Yii::t('user',"Login") => array('/user/login'),
	Yii::t('user',"Restore"),
);
?>



<?php if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
    <div class="alert alert-success">
        <?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
    </div>
<?php else: ?>

<div class="form">
    <h1 class="header-login"><?php echo Yii::t('user',"Restore"); ?></h1>
    <?php echo CHtml::beginForm('','post',array('class'=>'well')); ?>

        <?php echo CHtml::errorSummary($form); ?>


            <?php echo CHtml::activeLabel($form,'username'); ?>
            <?php echo CHtml::activeTextField($form,'username') ?>
            <p class="hint"><?php echo Yii::t('user',"Please enter your login or email addres."); ?></p>


        <div class="submit">
            <?php echo CHtml::submitButton(Yii::t('user',"Restore"), array('class'=>'btn')); ?>
        </div>

    <?php echo CHtml::endForm(); ?>
</div><!-- form -->
<?php endif; ?>