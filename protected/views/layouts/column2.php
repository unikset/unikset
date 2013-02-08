<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
            <?php echo $content; ?>
            <div id="sidebar">
            <!-- lang menu -->
            <?php 
            $this->widget('LanguageSelector');
            ?>
	</div><!-- sidebar -->
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>