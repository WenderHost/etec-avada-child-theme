<?php global $data; ?>
<div class="header-v2">
	<?php if($data['header_left_content'] != 'Leave Empty' || $data['header_right_content'] != 'Leave Empty'): ?>
	<div class="header-social">
		<div class="avada-row">
			<div class="alignleft">
				<?php
				if($data['header_left_content'] == 'Contact Info') {
					get_template_part('framework/headers/header-info');
				} elseif($data['header_left_content'] == 'Social Links') {
					get_template_part('framework/headers/header-social');
				} elseif($data['header_left_content'] == 'Navigation') {
					get_template_part('framework/headers/header-menu');
				}
				?>
			</div>
			<div class="alignright">
				<?php
				if($data['header_right_content'] == 'Contact Info') {
					get_template_part('framework/headers/header-info');
				} elseif($data['header_right_content'] == 'Social Links') {
					get_template_part('framework/headers/header-social');
				} elseif($data['header_right_content'] == 'Navigation') {
					get_template_part('framework/headers/header-menu');
				}
				?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<header id="header">
		<div class="avada-row" style="margin-top:<?php echo $data['margin_header_top']; ?>;margin-bottom:<?php echo $data['margin_header_bottom']; ?>;">
			<div class="logo">
				<a href="<?php bloginfo('url'); ?>">
					<img src="<?php echo $data['logo']; ?>" alt="<?php bloginfo('name'); ?>" class="normal_logo" />
					<?php if($data['logo_retina'] && $data['retina_logo_width'] && $data['retina_logo_height']): ?>
					<?php
					$pixels ="";
					if(is_numeric($data['retina_logo_width']) && is_numeric($data['retina_logo_height'])):
					$pixels ="px";
					endif; ?>
					<img src="<?php echo $data["logo_retina"]; ?>" alt="<?php bloginfo('name'); ?>" style="width:<?php echo $data["retina_logo_width"].$pixels; ?>;max-height:<?php echo $data["retina_logo_height"].$pixels; ?>; height: auto !important" class="retina_logo" />
					<?php endif; ?>
				</a>
			</div>
			<?php if($data['ubermenu']): ?>
			<nav id="nav-uber">
			<?php else: ?>
			<nav id="nav" class="nav-holder">
			<?php endif; ?>
				<?php get_template_part('framework/headers/header-main-menu'); ?>
			</nav>
			<div class="mobile-nav-holder"></div>
		</div>
	</header>
</div>