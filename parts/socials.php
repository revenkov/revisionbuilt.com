<?php
$facebook = get_field('facebook', 'options');
$x = get_field('x', 'options');
$linkedin = get_field('linkedin', 'options');
$instagram = get_field('instagram', 'options');
$youtube = get_field('youtube', 'options');
$tiktok = get_field('tiktok', 'options');
$pinterest = get_field('pinterest', 'options');
?>
<?php if (!empty($facebook)) : ?><a href="<?php echo $facebook; ?>" target="_blank" class="social social--facebook-f" title="<?php echo __('Follow us on Facebook', 'selectrum'); ?>"></a><?php endif; ?>
<?php if (!empty($x)) : ?><a href="<?php echo $x; ?>" target="_blank" class="social social--x" title="<?php echo __('Follow us on X', 'selectrum'); ?>"></a><?php endif; ?>
<?php if (!empty($youtube)) : ?><a href="<?php echo $youtube; ?>" target="_blank" class="social social--youtube" title="<?php echo __('Follow us on Youtube', 'selectrum'); ?>"></a><?php endif; ?>
<?php if (!empty($instagram)) : ?><a href="<?php echo $instagram; ?>" target="_blank" class="social social--instagram" title="<?php echo __('Follow us on Instagram', 'selectrum'); ?>"></a><?php endif; ?>
<?php if (!empty($linkedin)) : ?><a href="<?php echo $linkedin; ?>" target="_blank" class="social social--linkedin" title="<?php echo __('Follow us on Linkedin', 'selectrum'); ?>"></a><?php endif; ?>
<?php if (!empty($tiktok)) : ?><a href="<?php echo $tiktok; ?>" target="_blank" class="social social--tiktok" title="<?php echo __('Follow us on TikTok', 'selectrum'); ?>"></a><?php endif; ?>

