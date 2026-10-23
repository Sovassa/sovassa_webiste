<?php
/**
 * Shared markup for sections used across the theme.
 *
 * @package Sovassa
 */

/**
 * Inline icon.
 *
 * @param string $name Icon name.
 */
function sovassa_icon($name) {
	$icons = array(
		'phone'   => '<path d="M7 3.5h2.2l1.2 3-1.5 1a12.5 12.5 0 0 0 5.6 5.6l1-1.5 3 1.2V17a2 2 0 0 1-2.2 2A16.5 16.5 0 0 1 5 6.7 2 2 0 0 1 7 3.5Z"/>',
		'chat'    => '<path d="M5 6.5A2.5 2.5 0 0 1 7.5 4h9A2.5 2.5 0 0 1 19 6.5v6A2.5 2.5 0 0 1 16.5 15H12l-3.5 3v-3H7.5A2.5 2.5 0 0 1 5 12.5v-6Z"/>',
		'menu'    => '<path d="M4 7h16M4 12h16M4 17h16"/>',
		'close'   => '<path d="M6 6l12 12M18 6 6 18"/>',
		'code'    => '<path d="m8 8-4 4 4 4M16 8l4 4-4 4M13 6l-2 12"/>',
		'megaphone' => '<path d="M5 10v4a2 2 0 0 0 2 2h1l1 4h2l-1-4h2l6 3V7l-6 3H7a2 2 0 0 0-2 2Z"/>',
		'growth'  => '<path d="M4 16.5 9 11l3 3 8-8M14 6h6v6"/>',
		'globe'   => '<path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM4 12h16M12 4c2.2 2.4 3.3 5.1 3.3 8S14.2 17.6 12 20c-2.2-2.4-3.3-5.1-3.3-8S9.8 6.4 12 4Z"/>',
		'layers'  => '<path d="m12 4 8 4-8 4-8-4 8-4Zm8 8-8 4-8-4M20 16l-8 4-8-4"/>',
		'check'   => '<path d="m5 12 5 5L20 7"/>',
		'arrow'   => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'search'  => '<path d="M11 18a7 7 0 1 0 0-14 7 7 0 0 0 0 14Zm5-2 4 4"/>',
		'spark'   => '<path d="M12 3v4M12 17v4M4.9 6.5l2.8 2.8M16.3 14.7l2.8 2.8M3 12h4M17 12h4M4.9 17.5l2.8-2.8M16.3 9.3l2.8-2.8"/>',
		'pen'     => '<path d="M4 20h4L19 9l-4-4L4 16v4Zm11-13 4 4"/>',
		'users'   => '<path d="M8 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM16.5 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5ZM3.5 19c.4-2.2 2.2-3.5 4.5-3.5s4.1 1.3 4.5 3.5M14 15.6c1.6-.2 3 .6 3.8 2.4"/>',
		'shield'  => '<path d="M12 3.5 19 6.5v5.2c0 4.2-2.8 7.2-7 8.8-4.2-1.6-7-4.6-7-8.8V6.5L12 3.5Z"/>',
		'lock'    => '<rect width="14" height="10" x="5" y="11" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/>',
		'up'      => '<path d="M12 19V5M6 11l6-6 6 6"/>',
		'mail'    => '<rect width="18" height="14" x="3" y="5" rx="2"/><path d="m3 7 9 6 9-6"/>',
		'pin'     => '<path d="M12 21s-6-5.3-6-10a6 6 0 1 1 12 0c0 4.7-6 10-6 10Z"/><circle cx="12" cy="11" r="2.5"/>',
	);
	if ('linkedin' === $name) {
		echo '<svg class="icon icon--brand" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><rect width="24" height="24" rx="6" fill="#0A66C2"/><path fill="#fff" stroke="none" d="M7.1 9.7h2.3V17H7.1V9.7Zm1.15-3.6a1.33 1.33 0 1 1 0 2.66 1.33 1.33 0 0 1 0-2.66ZM10.9 9.7h2.2v1h.03c.3-.58 1.06-1.2 2.18-1.2 2.33 0 2.76 1.53 2.76 3.53V17h-2.3v-3.5c0-.84-.02-1.91-1.17-1.91-1.17 0-1.35.91-1.35 1.85V17h-2.3V9.7Z"/></svg>';
		return;
	}
	if ('instagram' === $name) {
		echo '<svg class="icon icon--brand" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><defs><radialGradient id="sovassa-ig" cx="30%" cy="115%" r="140%"><stop offset="0%" stop-color="#feda75"/><stop offset="18%" stop-color="#fa7e1e"/><stop offset="42%" stop-color="#d62976"/><stop offset="70%" stop-color="#962fbf"/><stop offset="100%" stop-color="#4f5bd5"/></radialGradient></defs><rect width="24" height="24" rx="6" fill="url(#sovassa-ig)"/><rect x="5.2" y="5.2" width="13.6" height="13.6" rx="4" fill="none" stroke="#fff" stroke-width="1.6"/><circle cx="12" cy="12" r="3.15" fill="none" stroke="#fff" stroke-width="1.6"/><circle cx="16.45" cy="7.55" r="0.9" fill="#fff" stroke="none"/></svg>';
		return;
	}
	if ('facebook' === $name) {
		echo '<svg class="icon icon--brand" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><rect width="24" height="24" rx="6" fill="#1877F2"/><path fill="#fff" stroke="none" d="M15.4 12.7h-1.8V19h-2.5v-6.3H9.6v-2.3h1.5V9.1c0-1.5.8-2.4 2.4-2.4.7 0 1.3.1 1.3.1v1.7h-.8c-.8 0-1 .4-1 1v1.3h1.8l-.4 2.3Z"/></svg>';
		return;
	}
	if ('whatsapp' === $name) {
		echo '<svg class="icon icon--whatsapp" viewBox="0 0 32 32" aria-hidden="true" focusable="false"><path fill="#25D366" d="M16 2.7C8.6 2.7 2.7 8.6 2.7 16c0 2.3.6 4.5 1.8 6.5L2.4 29.6l7.2-1.9A13.2 13.2 0 0 0 16 29.3c7.4 0 13.3-5.9 13.3-13.3C29.3 8.6 23.4 2.7 16 2.7z"/><path fill="#fff" d="M23.1 18.7c-.3-.2-1.8-.9-2.1-1-.3-.1-.5-.1-.7.2-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-1.7-.8-2.8-1.5-3.9-3.4-.3-.5.3-.5.9-1.6.1-.2 0-.4-.1-.6-.1-.2-.7-1.7-1-2.3-.2-.6-.5-.5-.6-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.2.2 2.1 3.2 5.1 4.5.7.3 1.2.5 1.7.6.7.2 1.3.2 1.8.1.6-.1 1.8-.7 2-1.4.2-.7.2-1.3.2-1.4-.1-.2-.3-.2-.6-.4z"/></svg>';
		return;
	}
	$path = isset($icons[$name]) ? $icons[$name] : $icons['spark'];
	echo '<svg class="icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">' . $path . '</svg>';
}

/**
 * aria-current attribute for a primary navigation link.
 *
 * @param string $slug Page slug.
 * @return string
 */
function sovassa_nav_current($slug) {
	$on = 'insights' === $slug ? (is_home() || is_page('insights')) : is_page($slug);
	return $on ? ' aria-current="page"' : '';
}

/**
 * WhatsApp chat link for the public phone number.
 *
 * @return string
 */
function sovassa_whatsapp_url() {
	$digits = preg_replace('/\D+/', '', sovassa_config()['phone']);
	$text   = rawurlencode('Hello Sovassa Technologies, I would like to talk about a project.');
	return 'https://wa.me/' . $digits . '?text=' . $text;
}

/**
 * Eyebrow label.
 *
 * @param string $text Label.
 */
function sovassa_eyebrow($text) {
	if ('' === $text) {
		return;
	}
	echo '<p class="eyebrow"><span class="eyebrow__line" aria-hidden="true"></span>' . esc_html($text) . '</p>';
}

/**
 * Section introduction.
 *
 * @param string $eyebrow Small label.
 * @param string $title   Heading.
 * @param string $lede    Supporting copy.
 * @param string $level   h2 or h1.
 */
function sovassa_section_head($eyebrow, $title, $lede = '', $level = 'h2') {
	$tag = 'h1' === $level ? 'h1' : 'h2';
	echo '<div class="section-head">';
	sovassa_eyebrow($eyebrow);
	echo '<' . $tag . '>' . esc_html($title) . '</' . $tag . '>';
	if ('' !== $lede) {
		echo '<p class="lede">' . esc_html($lede) . '</p>';
	}
	echo '</div>';
}

/**
 * Primary and secondary buttons.
 *
 * @param array<string, string> $primary   Label and url.
 * @param array<string, string> $secondary Label and url.
 */
function sovassa_actions($primary, $secondary = array()) {
	echo '<div class="actions">';
	if (!empty($primary['label'])) {
		echo '<a class="btn btn--primary" href="' . esc_url(sovassa_url($primary['url'])) . '">' . esc_html($primary['label']) . ' ';
		sovassa_icon('arrow');
		echo '</a>';
	}
	if (!empty($secondary['label'])) {
		echo '<a class="btn btn--ghost" href="' . esc_url(sovassa_url($secondary['url'])) . '">' . esc_html($secondary['label']) . '</a>';
	}
	echo '</div>';
}

/**
 * Default consultation actions.
 *
 * @param string $secondary_label Button label.
 * @param string $secondary_url   Slug or path.
 */
function sovassa_default_actions($secondary_label = 'Explore Our Services', $secondary_url = 'services') {
	sovassa_actions(
		array(
			'label' => 'Get a Free Consultation',
			'url'   => 'get-a-quote',
		),
		array(
			'label' => $secondary_label,
			'url'   => $secondary_url,
		)
	);
}

/**
 * Inner page hero.
 *
 * @param array<string, mixed> $page        Page definition.
 * @param string               $video       Optional film slug shown behind the text.
 * @param string               $video_label Accessible name for that film.
 */
function sovassa_page_hero($page, $video = '', $video_label = '') {
	$film = '';
	if ($video) {
		$dir = get_template_directory() . '/assets/videos/';
		if (is_readable($dir . $video . '.mp4') || is_readable($dir . $video . '.webm')) {
			$film = $video;
		}
	}
	$primary = isset($page['primary_cta']) ? $page['primary_cta'] : array(
		'label' => 'Get a Free Consultation',
		'url'   => 'get-a-quote',
	);
	$secondary = isset($page['secondary_cta']) ? $page['secondary_cta'] : array(
		'label' => 'Explore Our Services',
		'url'   => 'services',
	);
	?>
	<section class="page-hero<?php echo $film ? ' page-hero--film' : ''; ?>">
		<?php if ($film) : ?>
			<div class="page-hero__film" aria-hidden="true">
				<?php sovassa_brand_video($film, $video_label ? $video_label : $page['title']); ?>
			</div>
		<?php else : ?>
			<div class="hero-orbs" aria-hidden="true"><span></span><span></span></div>
		<?php endif; ?>
		<div class="container">
			<?php sovassa_breadcrumbs(); ?>
			<?php sovassa_section_head($page['eyebrow'], $page['title'], $page['intro'], 'h1'); ?>
			<?php sovassa_actions($primary, $secondary); ?>
		</div>
	</section>
	<?php
}

/**
 * Breadcrumb trail.
 */
function sovassa_breadcrumbs() {
	$items = sovassa_breadcrumb_items();
	if (!$items) {
		return;
	}
	echo '<nav class="breadcrumbs" aria-label="Breadcrumb"><ol>';
	$last = count($items) - 1;
	foreach ($items as $index => $item) {
		echo '<li>';
		if ($index === $last) {
			echo '<span aria-current="page">' . esc_html($item['label']) . '</span>';
		} else {
			echo '<a href="' . esc_url($item['url']) . '">' . esc_html($item['label']) . '</a>';
		}
		echo '</li>';
	}
	echo '</ol></nav>';
}

/**
 * Lazy brand video.
 *
 * @param string $name  File slug in assets/videos.
 * @param string $label Accessible name.
 */
function sovassa_brand_video($name, $label) {
	$dir    = get_template_directory() . '/assets/videos/';
	$base   = get_template_directory_uri() . '/assets/videos/' . $name;
	$ver    = '?ver=' . SOVASSA_VERSION;
	$has_mp4  = is_readable($dir . $name . '.mp4');
	$has_webm = is_readable($dir . $name . '.webm');
	if (!$has_mp4 && !$has_webm) {
		return;
	}
	$poster = $base . '-poster.webp' . $ver;
	?>
	<video class="brand-video" muted loop playsinline preload="none" poster="<?php echo esc_url($poster); ?>" aria-label="<?php echo esc_attr($label); ?>">
		<?php if ($has_webm) : ?>
			<source data-src="<?php echo esc_url($base . '.webm' . $ver); ?>" type="video/webm">
		<?php endif; ?>
		<?php if ($has_mp4) : ?>
			<source data-src="<?php echo esc_url($base . '.mp4' . $ver); ?>" type="video/mp4">
		<?php endif; ?>
	</video>
	<?php
}

/**
 * Landscape still used beside story copy.
 *
 * @param string $name File slug in assets/images (jpg/webp).
 * @param string $alt  Accessible description.
 */
function sovassa_page_still($name, $alt) {
	$dir  = get_template_directory() . '/assets/images/';
	$base = get_template_directory_uri() . '/assets/images/' . $name;
	$ver  = '?ver=' . SOVASSA_VERSION;
	$has_webp = is_readable($dir . $name . '.webp');
	$has_jpg  = is_readable($dir . $name . '.jpg');
	$has_png  = is_readable($dir . $name . '.png');
	if (!$has_webp && !$has_jpg && !$has_png) {
		return;
	}
	$fallback = $has_jpg ? $base . '.jpg' . $ver : ($has_png ? $base . '.png' . $ver : $base . '.webp' . $ver);
	?>
	<figure class="split-still split-still--<?php echo esc_attr($name); ?>">
		<picture>
			<?php if ($has_webp) : ?>
				<source type="image/webp" srcset="<?php echo esc_url($base . '.webp' . $ver); ?>">
			<?php endif; ?>
			<img src="<?php echo esc_url($fallback); ?>" alt="<?php echo esc_attr($alt); ?>" width="1024" height="575" loading="lazy">
		</picture>
	</figure>
	<?php
}

/**
 * Slow row of labels. The track is duplicated so the loop is seamless.
 *
 * @param array<int, string> $labels Visible names.
 * @param string             $url    Destination for each label.
 */
function sovassa_marquee($labels, $url) {
	$labels = array_values(array_filter($labels));
	if (!$labels) {
		return;
	}
	?>
	<div class="marquee">
		<div class="marquee__track">
			<?php for ($copy = 0; $copy < 2; $copy++) : ?>
				<?php foreach ($labels as $label) : ?>
					<a class="chip" href="<?php echo esc_url($url); ?>"<?php echo $copy ? ' aria-hidden="true" tabindex="-1"' : ''; ?>><?php echo esc_html($label); ?></a>
				<?php endforeach; ?>
			<?php endfor; ?>
		</div>
	</div>
	<?php
}

/**
 * Numbered process rail.
 *
 * @param array<int, array<string, string>> $steps         Steps.
 * @param string                             $label         Eyebrow.
 * @param string                             $title         Heading.
 * @param string                             $lede          Intro.
 * @param string                             $video         Optional brand video slug.
 * @param string                             $section_class Extra section classes.
 * @param string                             $still         Optional still slug when there is no clean film.
 */
function sovassa_process($steps, $label, $title, $lede = '', $video = '', $section_class = '', $still = '') {
	$class = 'section' . ($section_class ? ' ' . $section_class : '');
	?>
	<section class="<?php echo esc_attr($class); ?>">
		<div class="container">
			<?php sovassa_section_head($label, $title, $lede); ?>
			<?php if ($video) : ?>
				<?php sovassa_brand_video($video, $title); ?>
			<?php elseif ($still) : ?>
				<div class="feature-frame">
					<?php sovassa_page_still($still, $title); ?>
				</div>
			<?php endif; ?>
			<div class="rail" data-rail>
				<div class="rail__line" aria-hidden="true"><span class="rail__fill"></span></div>
				<ol class="steps steps--rail" style="--steps: <?php echo esc_attr((string) count($steps)); ?>">
					<?php foreach ($steps as $index => $step) : ?>
						<li class="step">
							<span class="step__index"><?php echo esc_html(sprintf('%02d', $index + 1)); ?></span>
							<h3><?php echo esc_html($step['title']); ?></h3>
							<p><?php echo esc_html($step['text']); ?></p>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>
		</div>
	</section>
	<?php
}

/**
 * FAQ accordion.
 *
 * @param array<int, array<string, string>> $items Questions.
 * @param string                             $title Heading.
 */
function sovassa_faq($items, $title = 'Questions, answered plainly') {
	if (!$items) {
		return;
	}
	?>
	<section class="section section--tight">
		<div class="container container--narrow">
			<?php sovassa_section_head('FAQ', $title, 'Short answers to the decisions this page is meant to support.'); ?>
			<div class="faq">
				<?php foreach ($items as $item) : ?>
					<details class="faq__item">
						<summary><?php echo esc_html($item['q']); ?></summary>
						<p><?php echo esc_html($item['a']); ?></p>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
}

/**
 * Related service links.
 *
 * @param array<int, string> $slugs Related slugs.
 */
function sovassa_related($slugs) {
	if (!$slugs) {
		return;
	}
	?>
	<section class="section section--tint">
		<div class="container">
			<?php sovassa_section_head('Related', 'Continue with the work around this service', 'Most engagements connect more than one capability.'); ?>
			<div class="card-grid card-grid--3">
				<?php foreach ($slugs as $slug) : ?>
					<?php $related = sovassa_page($slug); ?>
					<?php if (!$related) { continue; } ?>
					<a class="link-card" href="<?php echo esc_url(sovassa_url($slug)); ?>">
						<p class="link-card__kicker"><?php echo esc_html($related['eyebrow']); ?></p>
						<h3><?php echo esc_html($related['nav_label']); ?></h3>
						<p><?php echo esc_html(isset($related['card']) ? $related['card'] : $related['intro']); ?></p>
						<span class="text-link">View service <?php sovassa_icon('arrow'); ?></span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
}

/**
 * Form error notice.
 */
function sovassa_form_notice() {
	$message = sovassa_form_error_message();
	if ('' === $message) {
		return;
	}
	echo '<p class="form-error" role="alert">' . esc_html($message) . '</p>';
}

/**
 * Shared hidden form fields.
 *
 * @param string $type Enquiry type.
 */
function sovassa_form_hidden($type) {
	wp_nonce_field('sovassa_enquiry', 'sovassa_enquiry_nonce');
	echo '<input type="hidden" name="action" value="sovassa_enquiry">';
	echo '<input type="hidden" name="enquiry_type" value="' . esc_attr($type) . '">';
	echo '<p class="hp-field"><label>Company website<input type="text" name="sovassa_company_website" tabindex="-1" autocomplete="off"></label></p>';
}

/**
 * Consent checkbox.
 */
function sovassa_consent_field() {
	?>
	<label class="check">
		<input type="checkbox" name="consent" value="1" required>
		<span>I agree that Sovassa Technologies can use these details to respond to this enquiry. Read the <a href="<?php echo esc_url(home_url('/privacy/')); ?>">privacy policy</a>.</span>
	</label>
	<?php
}

/**
 * Latest insight posts.
 *
 * @param int $count How many posts.
 * @return WP_Query
 */
function sovassa_insights_query($count = 3) {
	return new WP_Query(
		array(
			'post_type'      => 'post',
			'posts_per_page' => $count,
			'post_status'    => 'publish',
		)
	);
}

/**
 * Insight card.
 */
function sovassa_insight_image_uri() {
	$categories = get_the_category();
	$slug       = $categories ? sanitize_title($categories[0]->name) : 'sovassa';
	$file       = 'insight-' . $slug . '.webp';
	if (!file_exists(get_template_directory() . '/assets/images/' . $file)) {
		$file = 'insight-sovassa.webp';
	}
	return get_template_directory_uri() . '/assets/images/' . $file;
}

function sovassa_post_card() {
	$categories = get_the_category();
	$label      = $categories ? $categories[0]->name : 'Insight';
	?>
	<article class="post-card">
		<a href="<?php the_permalink(); ?>"><img class="post-card__image" src="<?php echo esc_url(sovassa_insight_image_uri()); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" width="1280" height="720"></a>
		<div class="post-card__body">
			<p class="link-card__kicker"><?php echo esc_html($label); ?></p>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p><?php echo esc_html(get_the_excerpt()); ?></p>
			<a class="text-link" href="<?php the_permalink(); ?>">Read insight <?php sovassa_icon('arrow'); ?></a>
		</div>
	</article>
	<?php
}

/**
 * Who an insight is credited to. Falls back to the company.
 *
 * @return array<string, string|bool>
 */
function sovassa_author($post_id = null) {
	$config  = sovassa_config();
	$post_id = $post_id ?: get_the_ID();
	$person  = null;

	if ($post_id) {
		$slug     = get_post_field('post_name', $post_id);
		$articles = function_exists('sovassa_articles') ? sovassa_articles() : array();
		if (isset($articles[$slug]['author']) && isset($config['authors'][$articles[$slug]['author']])) {
			$person = $config['authors'][$articles[$slug]['author']];
		}
	}

	if (!$person && isset($config['author']) && is_array($config['author']) && !empty($config['author']['name'])) {
		$person = $config['author'];
	}

	if (!$person || empty($person['name'])) {
		return array(
			'is_person' => false,
			'name'      => $config['name'],
			'role'      => 'Product, web, and marketing team',
			'bio'       => 'Sovassa Technologies builds websites, apps, and AI tools, then markets them. These notes come from the questions clients ask before a project starts.',
			'url'       => home_url('/about/'),
			'image'     => '',
		);
	}

	$image = isset($person['image']) ? (string) $person['image'] : '';
	if ('' !== $image && !str_starts_with($image, 'http')) {
		$image = get_template_directory_uri() . '/' . ltrim($image, '/');
	}

	$url = isset($person['url']) ? (string) $person['url'] : '';
	if ('' !== $url && !str_starts_with($url, 'http')) {
		$url = home_url('/' . ltrim($url, '/'));
	}

	return array(
		'is_person' => true,
		'name'      => $person['name'],
		'role'      => isset($person['role']) ? (string) $person['role'] : '',
		'bio'       => isset($person['bio']) ? (string) $person['bio'] : '',
		'url'       => $url,
		'image'     => $image,
	);
}

/**
 * Minutes to read the current post, at 220 words a minute.
 *
 * @return int
 */
function sovassa_reading_minutes() {
	$words = str_word_count(wp_strip_all_tags((string) get_post_field('post_content', get_the_ID())));
	return max(1, (int) round($words / 220));
}

/**
 * Byline under an insight title: author, dates, and reading time.
 */
function sovassa_article_byline() {
	$author    = sovassa_author();
	$published = get_the_date('c');
	$modified  = get_the_modified_date('c');
	$updated   = get_the_modified_date('Y-m-d') !== get_the_date('Y-m-d');
	?>
	<p class="article-meta">
		<span>By <a href="<?php echo esc_url($author['url']); ?>"><?php echo esc_html($author['name']); ?></a></span>
		<span><time datetime="<?php echo esc_attr($published); ?>"><?php echo esc_html(get_the_date('j M Y')); ?></time></span>
		<?php if ($updated) : ?>
			<span>Updated <time datetime="<?php echo esc_attr($modified); ?>"><?php echo esc_html(get_the_modified_date('j M Y')); ?></time></span>
		<?php endif; ?>
		<span><?php echo esc_html(sovassa_reading_minutes()); ?> min read</span>
	</p>
	<?php
}

/**
 * Author card at the end of an insight.
 */
function sovassa_author_box() {
	$author = sovassa_author();
	$image  = $author['image'] ? $author['image'] : get_template_directory_uri() . '/assets/images/apple-touch-icon.png';
	?>
	<aside class="author-box" aria-label="About the author">
		<img class="author-box__image" src="<?php echo esc_url($image); ?>" alt="" width="64" height="64" loading="lazy">
		<div>
			<p class="author-box__name"><a href="<?php echo esc_url($author['url']); ?>"><?php echo esc_html($author['name']); ?></a></p>
			<?php if ($author['role']) : ?>
				<p class="author-box__role"><?php echo esc_html($author['role']); ?></p>
			<?php endif; ?>
			<?php if ($author['bio']) : ?>
				<p><?php echo esc_html($author['bio']); ?></p>
			<?php endif; ?>
		</div>
	</aside>
	<?php
}

/**
 * URL of a homepage image in assets/images/home/.
 *
 * @param string $name File name without extension.
 * @return string
 */
function sovassa_home_image($name) {
	return get_template_directory_uri() . '/assets/images/home/' . $name . '.webp?ver=' . SOVASSA_VERSION;
}

/**
 * Shared homepage section heading: eyebrow pill, title, optional lede.
 *
 * @param string $eyebrow Small label above the title.
 * @param string $title   Section title.
 * @param string $lede    Optional supporting line.
 * @param string $id      Optional id for the heading, used by aria-labelledby.
 */
function sovassa_home_head($eyebrow, $title, $lede = '', $id = '') {
	?>
	<div class="hp-head">
		<span class="hp-pill"><?php echo esc_html($eyebrow); ?></span>
		<h2<?php echo $id ? ' id="' . esc_attr($id) . '"' : ''; ?>><?php echo esc_html($title); ?></h2>
		<?php if ($lede) : ?>
			<p><?php echo esc_html($lede); ?></p>
		<?php endif; ?>
	</div>
	<?php
}
