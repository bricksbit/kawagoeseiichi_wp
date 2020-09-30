<?php
/**
 * Template for displaying search forms in Twenty Sixteen
 *
 * @package WordPress
 * @subpackage kstyle
 * @since kstyle
 */
?>

<!-- <form role="search" method="get" id="searchform" action="/" >
	<input type="text" value="" name="s" class="s" />
	<input type="submit" class="searchsubmit" value="検索" />
</form> -->


<form method="get" class="searchform" action="<?php echo esc_url( home_url('/') ); ?>">
<input type="text" placeholder="検索" name="s" class="searchfield" value="" />
<input type="submit" value="" alt="検索" title="検索" class="searchsubmit">
</form>