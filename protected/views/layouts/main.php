<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/jquery-ui-1.8.16.ie.css" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/jquery-ui-1.8.16.custom.css" />
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
        
        <!--<script type="text/javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>-->

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div class="container" id="page">
            <div id="header">
                
                <div id="logo">
                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->defaultController);?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.jpg" alt="Unikset"/>
                    </a>
                </div>
                <div id="mainmenu">
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            //array('label' => Yii::t('app', 'Home'), 'url' => array('/site/index')),
                            //array('label' => Yii::t('app', 'About'), 'url' => array('/site/page', 'view' => 'about')),
                            //array('label' => Yii::t('app', 'Contact'), 'url' => array('/site/contact')),
                            array('label' => Yii::t('app', 'Search'), 'url' => array('/documents/search')),
                            array('label' => Yii::t('app', 'Create'), 'url' => array('/documents/create')),
                            array('label' => Yii::t('app', 'Login'), 'url' => array('/user/login'), 'visible' => Yii::app()->user->isGuest),
                            //array('label' => Yii::t('app', 'Registration'), 'url' => array('/user/registration'), 'visible' => Yii::app()->user->isGuest),
                            array('label' => Yii::t('app', 'Logout'), 'url' => array('/user/logout'), 'visible' => !Yii::app()->user->isGuest)
                        ),
                    ));
                    ?>
                </div>
            </div>
            <!--
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?>
            <?php endif ?>
            -->
            <?php if (Yii::app()->user->hasFlash('message')): ?>
                <div class="message"><?php echo Yii::app()->user->getFlash('message'); ?></div>
            <?php endif; ?>

            <?php echo $content; ?>

            <div class="clear"></div>

            <div id="footer">
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
