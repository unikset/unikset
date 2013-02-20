<?php $this->beginContent('/layouts/main'); ?>
<div class="row-fluid">
<div class="span3 well">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'nav nav-list'),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>

<div class="span9">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
</div>
<?php $this->endContent(); ?>