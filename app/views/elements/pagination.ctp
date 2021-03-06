<?php $paginator->options(array('url' => $this->passedArgs)); ?>
<div class="paginate">
	<p class="fRight light em"><?php echo $paginator->counter(array('format' => "Displaying page %page% of %pages%")); ?></p>
	<?php if($paginator->first()): ?>
		<?php echo $paginator->first("First"); ?>
	<?php else: ?>
		<span class="disabled">
			First
		</span>
	<?php endif; ?>
	<span><?php echo $paginator->prev("&laquo; Prev", array("class" => "prev", "escape" => false)); ?></span>
	<?php echo $paginator->numbers(array("separator" => null)); ?>
	<span><?php echo $paginator->next("Next &raquo;", array("class" => "next", "escape" => false)); ?></span>
	<?php if($paginator->last()): ?>
		<?php echo $paginator->last("Last", array("class" => "last")); ?>
	<?php else: ?>
		<span class="disabled">Last</span>
	<?php endif; ?>
</div>