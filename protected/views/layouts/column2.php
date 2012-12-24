<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
            <!-- lang menu -->
            <?php 
            $this->widget('LanguageSelector');
            ?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>