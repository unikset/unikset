<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/bootstrap.min.css" rel="stylesheet" media="screen">
	
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/bootstrap.min.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title> 
</head>

<body>

<div class="container-fluid">
     <div class="row-fluid">
         
         <div class="navbar navbar-inverse navbar-fixed-top">
             <div class="navbar-inner">
                 <a class="brand" href="/dashboard">Dashboard <?php echo CHtml::encode(Yii::app()->name); ?></a>
                 <?php $this->widget('zii.widgets.CMenu',array(
                        'encodeLabel'=>false,
                        'id'=>'nav',
			'items'=>array(
				array('label'=>'Manage Users <b class="caret"></b>', 'url'=>array(''), 'items'=>array(
                                        array('label'=>'Users', 'url'=>array('user/')),
                                        array('label'=>'Roles', 'url'=>array('role/admin')),
                                    ),
                                    
                                    'itemOptions'=>array('class'=>'dropdown'),
                                    'linkOptions'=>array('class'=>"dropdown-toggle", 'data-toggle'=>"dropdown"),
                                    'submenuOptions'=>array('class'=>'dropdown-menu','role'=>"menu", 'aria-labelledby'=>"dLabel"),
                                ),
                                array('label'=>'Locations <b class="caret"></b>', 'url'=>array(''), 'items'=>array(
                                    array('label'=>'Countries', 'url'=>array('countries/')),
                                    array('label'=>'Regions', 'url'=>array('regions/')),
                                    array('label'=>'Cities', 'url'=>array('cities/')),
                                    ),
                                    'itemOptions'=>array('class'=>'dropdown'),
                                    'linkOptions'=>array('class'=>"dropdown-toggle", 'data-toggle'=>"dropdown"),
                                    'submenuOptions'=>array('class'=>'dropdown-menu','role'=>"menu", 'aria-labelledby'=>"dLabel"),
                                ),
                                array('label'=>'Discipline', 'url'=>array('discipline/')),
                                array('label'=>'Universities', 'url'=>array('universities/')),
                                array('label'=>'Lecturers', 'url'=>array('lecturers/')),
                                array('label'=>'Documents', 'url'=>array('documents/')),
				array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
                                array('label'=>'Registration', 'url'=>array('/user/registration'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
                        'htmlOptions'=>array('class'=>'nav'),
		)); ?>
             </div>
             
         </div>
	
	<div style="height: 40px;"></div><!-- распорка -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div class="navbar navbar-bottom">
            <div class="navbar-inner">
                Copyright &copy; <?php echo date('Y'); ?> by My Company.  
		All Rights Reserved.  
		<?php echo Yii::powered(); ?>
            </div>	
	</div><!-- footer -->
        
     </div><!-- end row-fluid -->

</div><!-- page -->
<script>
    $(document).ready(function(){
        $('.dropdown-toggle').dropdown();
    });
</script>
</body>
</html>
