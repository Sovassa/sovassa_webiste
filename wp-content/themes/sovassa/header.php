<?php
/**
 * Header and navigation.
 *
 * @package Sovassa
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>document.documentElement.classList.add("js");</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="grain" aria-hidden="true"></div>
<a class="skip-link" href="#main">Skip to content</a>
<div class="site-top">
	<header class="site-header">
		<div class="site-header__inner">
			<a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo-horizontal.png?ver=' . SOVASSA_VERSION); ?>" alt="Sovassa Technologies" width="960" height="213">
			</a>
			<nav id="site-menu" class="primary-nav" aria-label="Primary">
				<div class="nav-drop">
					<button type="button" aria-expanded="false" aria-controls="menu-company">Company</button>
					<div class="nav-panel nav-panel--drop" id="menu-company" hidden>
						<a href="<?php echo esc_url(home_url('/about/')); ?>">About Us</a>
						<a href="<?php echo esc_url(home_url('/technologies/')); ?>">Technologies</a>
						<a href="<?php echo esc_url(home_url('/careers/')); ?>">Careers</a>
						<a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Us</a>
					</div>
				</div>
				<div class="nav-drop nav-drop--mega">
					<button type="button" aria-expanded="false" aria-controls="menu-services">Services</button>
					<div class="nav-panel nav-panel--mega" id="menu-services" hidden>
						<div class="mega">
							<div class="mega__grid">
								<?php
								$service_columns = array(
									array(
										'label' => 'Build',
										'text'  => 'Products, sites, and the interface around them.',
										'links' => array('web-development', 'mobile-app-development', 'ui-ux-design', 'ai-automation'),
									),
									array(
										'label' => 'Market',
										'text'  => 'Search, content, social, and paid work tied to the offer.',
										'links' => array('digital-marketing', 'seo', 'content-marketing', 'social-media-marketing', 'google-ads'),
									),
								);
								foreach ($service_columns as $column) :
									?>
									<div class="mega__col">
										<p class="mega__label"><?php echo esc_html($column['label']); ?></p>
										<p class="mega__note"><?php echo esc_html($column['text']); ?></p>
										<?php
										$service_icons = array(
											'web-development'        => 'code',
											'mobile-app-development' => 'layers',
											'ui-ux-design'           => 'pen',
											'ai-automation'          => 'spark',
											'digital-marketing'      => 'megaphone',
											'seo'                    => 'search',
											'content-marketing'      => 'pen',
											'social-media-marketing' => 'users',
											'google-ads'             => 'growth',
										);
										foreach ($column['links'] as $slug) :
											$item = sovassa_page($slug);
											if (!$item) {
												continue;
											}
											?>
											<a class="mega-link" href="<?php echo esc_url(sovassa_url($slug)); ?>">
												<span class="mega-link__mark"><?php sovassa_icon(isset($service_icons[ $slug ]) ? $service_icons[ $slug ] : 'spark'); ?></span>
												<span class="mega-link__body">
													<strong><?php echo esc_html($item['nav_label']); ?></strong>
													<span><?php echo esc_html($item['card']); ?></span>
												</span>
											</a>
										<?php endforeach; ?>
									</div>
								<?php endforeach; ?>
								<div class="mega__aside">
									<p class="mega__label">Start</p>
									<p>Tell us the outcome. We will recommend the mix.</p>
									<a class="btn btn--primary btn--sm" href="<?php echo esc_url(home_url('/get-a-quote/')); ?>">Get a Free Consultation</a>
									<a class="text-link" href="<?php echo esc_url(home_url('/services/')); ?>">View all services <?php sovassa_icon('arrow'); ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="nav-drop nav-drop--mega">
					<button type="button" aria-expanded="false" aria-controls="menu-industries">Industries</button>
					<div class="nav-panel nav-panel--mega" id="menu-industries" hidden>
						<div class="mega">
							<div class="mega__grid">
								<?php
								$industry_items = array();
								foreach (sovassa_page('industries')['items'] as $industry) {
									$industry_items[ $industry['title'] ] = $industry;
								}
								$industry_groups = array(
									array(
										'label'  => 'Technology',
										'text'   => 'Software products and early companies.',
										'titles' => array('SaaS', 'Software and startups', 'Startups'),
									),
									array(
										'label'  => 'Organisations',
										'text'   => 'Teams that sell expertise or a service.',
										'titles' => array('Professional services', 'Healthcare', 'Education', 'Real estate'),
									),
									array(
										'label'  => 'Commerce',
										'text'   => 'Stores and products that handle money.',
										'titles' => array('Ecommerce', 'Fintech'),
									),
								);
								foreach ($industry_groups as $group) :
									?>
									<div class="mega__col">
										<p class="mega__label"><?php echo esc_html($group['label']); ?></p>
										<p class="mega__note"><?php echo esc_html($group['text']); ?></p>
										<?php
										$industry_icons = array(
											'Professional services'   => 'users',
											'Ecommerce'               => 'layers',
											'Healthcare'              => 'shield',
											'Education'               => 'pen',
											'Real estate'             => 'globe',
											'Software and startups'   => 'code',
											'SaaS'                    => 'layers',
											'Startups'                => 'spark',
											'Fintech'                 => 'shield',
										);
										foreach ($group['titles'] as $title) :
											if (empty($industry_items[ $title ])) {
												continue;
											}
											?>
											<a class="mega-link" href="<?php echo esc_url(home_url('/industries/#' . sanitize_title($title))); ?>">
												<span class="mega-link__mark"><?php sovassa_icon(isset($industry_icons[ $title ]) ? $industry_icons[ $title ] : 'globe'); ?></span>
												<span class="mega-link__body"><strong><?php echo esc_html($title); ?></strong></span>
											</a>
										<?php endforeach; ?>
									</div>
								<?php endforeach; ?>
							</div>
							<div class="mega__foot">
								<div>
									<strong>Explore all industries</strong>
									<p>The same capabilities, shaped around how a market buys.</p>
								</div>
								<a class="btn btn--primary btn--sm" href="<?php echo esc_url(home_url('/industries/')); ?>">View all industries <?php sovassa_icon('arrow'); ?></a>
							</div>
						</div>
					</div>
				</div>
				<a class="nav-link" href="<?php echo esc_url(home_url('/work/')); ?>">Case Studies</a>
				<a class="nav-link" href="<?php echo esc_url(home_url('/insights/')); ?>">Insights</a>
				<div class="drawer-actions">
					<a class="btn btn--ghost btn--sm" href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Us</a>
					<a class="btn btn--primary btn--sm" href="<?php echo esc_url(home_url('/get-a-quote/')); ?>">Get a Free Consultation</a>
				</div>
			</nav>
			<div class="header-actions">
				<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-menu">
					<span class="menu-toggle__bars" aria-hidden="true"><span></span><span></span><span></span></span>
					<span class="menu-toggle__label">Menu</span>
				</button>
			</div>
		</div>
	</header>
</div>
<main id="main">
