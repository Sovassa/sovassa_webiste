<?php
/**
 * Client logo strip. Hidden until real, approved client logos are listed.
 *
 * @package Sovassa
 *
 * @var array<string, mixed> $args
 */

$clients = $args['page']['proof']['clients'];
if (!$clients) {
	return;
}
?>
<section class="hp-clients" aria-label="Clients">
	<p>Trusted by growing businesses</p>
	<div class="hp-marquee">
		<div class="hp-marquee__track">
			<?php foreach (array(false, true) as $copy) : ?>
				<?php foreach ($clients as $client) : ?>
					<span class="hp-client"<?php echo $copy ? ' aria-hidden="true"' : ''; ?>>
						<?php if (!empty($client['logo'])) : ?>
							<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/' . $client['logo']); ?>" alt="<?php echo esc_attr($copy ? '' : $client['name']); ?>" height="32" loading="lazy">
						<?php else : ?>
							<?php echo esc_html($client['name']); ?>
						<?php endif; ?>
					</span>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>
