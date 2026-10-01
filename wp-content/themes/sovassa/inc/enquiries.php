<?php
/**
 * Enquiry storage for contact, quote, careers, and newsletter forms.
 *
 * @package Sovassa
 */

/**
 * Register the private enquiry type.
 */
function sovassa_register_enquiry_type() {
	register_post_type(
		'sovassa_enquiry',
		array(
			'labels'              => array(
				'name'          => __('Enquiries', 'sovassa'),
				'singular_name' => __('Enquiry', 'sovassa'),
				'menu_name'     => __('Enquiries', 'sovassa'),
				'all_items'     => __('All enquiries', 'sovassa'),
				'edit_item'     => __('View enquiry', 'sovassa'),
				'search_items'  => __('Search enquiries', 'sovassa'),
				'not_found'     => __('No enquiries yet', 'sovassa'),
			),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_icon'           => 'dashicons-email-alt',
			'menu_position'       => 25,
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
			'hierarchical'        => false,
			'supports'            => array('title', 'editor'),
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'rewrite'             => false,
		)
	);
}
add_action('init', 'sovassa_register_enquiry_type');

/**
 * Handle a public form post.
 */
function sovassa_handle_enquiry() {
	if (!isset($_POST['sovassa_enquiry_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['sovassa_enquiry_nonce'])), 'sovassa_enquiry')) {
		sovassa_enquiry_redirect('invalid');
	}

	if (!empty($_POST['sovassa_company_website'])) {
		wp_safe_redirect(home_url('/thank-you/'));
		exit;
	}

	$type = isset($_POST['enquiry_type']) ? sanitize_key(wp_unslash($_POST['enquiry_type'])) : 'contact';
	$allowed = array('contact', 'quote', 'application', 'newsletter');
	if (!in_array($type, $allowed, true)) {
		$type = 'contact';
	}

	$email = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
	if (!is_email($email)) {
		sovassa_enquiry_redirect('email');
	}

	$consent = isset($_POST['consent']) ? sanitize_text_field(wp_unslash($_POST['consent'])) : '';
	if ('1' !== $consent) {
		sovassa_enquiry_redirect('consent');
	}

	$name = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
	if ('newsletter' !== $type && '' === $name) {
		sovassa_enquiry_redirect('name');
	}

	$phone     = isset($_POST['phone']) ? sanitize_text_field(wp_unslash($_POST['phone'])) : '';
	$company   = isset($_POST['company']) ? sanitize_text_field(wp_unslash($_POST['company'])) : '';
	$service   = isset($_POST['service']) ? sanitize_text_field(wp_unslash($_POST['service'])) : '';
	$objective = isset($_POST['objective']) ? sanitize_text_field(wp_unslash($_POST['objective'])) : '';
	$website   = isset($_POST['website']) ? esc_url_raw(wp_unslash($_POST['website'])) : '';
	$timeline  = isset($_POST['timeline']) ? sanitize_text_field(wp_unslash($_POST['timeline'])) : '';
	$budget    = isset($_POST['budget']) ? sanitize_text_field(wp_unslash($_POST['budget'])) : '';
	$message   = isset($_POST['message']) ? sanitize_textarea_field(wp_unslash($_POST['message'])) : '';
	$services  = array();
	if (isset($_POST['services']) && is_array($_POST['services'])) {
		foreach ($_POST['services'] as $item) {
			$services[] = sanitize_text_field(wp_unslash($item));
		}
	}

	if ('contact' === $type && '' === $message) {
		sovassa_enquiry_redirect('message');
	}
	if ('quote' === $type && '' === $objective) {
		sovassa_enquiry_redirect('objective');
	}

	$labels = array(
		'contact'     => 'Contact',
		'quote'       => 'Quote',
		'application' => 'Application',
		'newsletter'  => 'Newsletter',
	);
	$who    = '' !== $name ? $name : $email;
	$title  = $labels[$type] . ' from ' . $who;

	$lines = array(
		'Type: ' . $labels[$type],
		'Name: ' . $name,
		'Email: ' . $email,
	);
	if ('' !== $phone) {
		$lines[] = 'Phone: ' . $phone;
	}
	if ('' !== $company) {
		$lines[] = 'Company: ' . $company;
	}
	if ('' !== $service) {
		$lines[] = 'Service: ' . $service;
	}
	if ($services) {
		$lines[] = 'Services: ' . implode(', ', $services);
	}
	if ('' !== $objective) {
		$lines[] = 'Objective: ' . $objective;
	}
	if ('' !== $website) {
		$lines[] = 'Website: ' . $website;
	}
	if ('' !== $timeline) {
		$lines[] = 'Timeline: ' . $timeline;
	}
	if ('' !== $budget) {
		$lines[] = 'Budget: ' . $budget;
	}
	if ('' !== $message) {
		$lines[] = '';
		$lines[] = $message;
	}

	$post_id = wp_insert_post(
		array(
			'post_type'    => 'sovassa_enquiry',
			'post_status'  => 'publish',
			'post_title'   => $title,
			'post_content' => implode("\n", $lines),
		),
		true
	);

	if (is_wp_error($post_id)) {
		sovassa_enquiry_redirect('save');
	}

	$meta = array(
		'enquiry_type' => $type,
		'email'        => $email,
		'name'         => $name,
		'phone'        => $phone,
		'company'      => $company,
		'service'      => $service,
		'services'     => implode(', ', $services),
		'objective'    => $objective,
		'website'      => $website,
		'timeline'     => $timeline,
		'budget'       => $budget,
	);
	foreach ($meta as $key => $value) {
		if ('' !== $value) {
			update_post_meta((int) $post_id, '_sovassa_' . $key, $value);
		}
	}

	sovassa_notify_enquiry($title, $lines, $email, $name);

	wp_safe_redirect(add_query_arg('sent', $type, home_url('/thank-you/')));
	exit;
}
add_action('admin_post_nopriv_sovassa_enquiry', 'sovassa_handle_enquiry');
add_action('admin_post_sovassa_enquiry', 'sovassa_handle_enquiry');

/**
 * Email the public address when an enquiry is stored.
 *
 * Mail can fail on a local machine. The enquiry is already saved, so the visitor still reaches the thank-you page.
 *
 * @param string        $title Enquiry title.
 * @param array<int, string> $lines Body lines.
 * @param string        $email Visitor email.
 * @param string        $name Visitor name.
 */
function sovassa_notify_enquiry($title, $lines, $email, $name) {
	$config    = sovassa_config();
	$safe_name = trim(str_replace(array("\r", "\n", '<', '>'), '', $name));
	$reply     = '' !== $safe_name ? $safe_name . ' <' . $email . '>' : $email;
	$body   = implode("\n", $lines);
	$body  .= "\n\nSent from " . $config['domain'];
	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		'From: Sovassa Technologies <' . $config['email'] . '>',
		'Reply-To: ' . $reply,
	);
	wp_mail($config['email'], $title, $body, $headers);
}

/**
 * Use SMTP when the host provides login details. Without them, mail stays on the server's own mail program.
 *
 * @param PHPMailer\PHPMailer\PHPMailer $phpmailer Mailer instance.
 */
function sovassa_phpmailer_smtp($phpmailer) {
	$host = getenv('SOVASSA_SMTP_HOST');
	if (!is_string($host) || '' === $host) {
		return;
	}
	$user = getenv('SOVASSA_SMTP_USER');
	$pass = getenv('SOVASSA_SMTP_PASS');
	$port = getenv('SOVASSA_SMTP_PORT');
	$secure = getenv('SOVASSA_SMTP_SECURE');
	$phpmailer->isSMTP();
	$phpmailer->Host       = $host;
	$phpmailer->Port       = is_string($port) && '' !== $port ? (int) $port : 587;
	$phpmailer->SMTPAuth   = is_string($user) && '' !== $user;
	$phpmailer->Username   = is_string($user) ? $user : '';
	$phpmailer->Password   = is_string($pass) ? $pass : '';
	$phpmailer->SMTPSecure = is_string($secure) && '' !== $secure ? $secure : 'tls';
}
add_action('phpmailer_init', 'sovassa_phpmailer_smtp');

/**
 * Send the visitor back to the form with an error code.
 *
 * @param string $code Error code.
 */
function sovassa_enquiry_redirect($code) {
	$referer = wp_get_referer();
	$target  = $referer ? $referer : home_url('/contact/');
	wp_safe_redirect(add_query_arg('form_error', sanitize_key($code), $target));
	exit;
}

/**
 * Admin columns for enquiries.
 *
 * @param array<string, string> $columns Existing columns.
 * @return array<string, string>
 */
function sovassa_enquiry_columns($columns) {
	return array(
		'cb'            => $columns['cb'],
		'title'         => __('Enquiry', 'sovassa'),
		'enquiry_type'  => __('Type', 'sovassa'),
		'enquiry_email' => __('Email', 'sovassa'),
		'date'          => __('Date', 'sovassa'),
	);
}
add_filter('manage_sovassa_enquiry_posts_columns', 'sovassa_enquiry_columns');

/**
 * Render a custom enquiry column.
 *
 * @param string $column Column key.
 * @param int    $post_id Post ID.
 */
function sovassa_enquiry_column($column, $post_id) {
	if ('enquiry_type' === $column) {
		echo esc_html((string) get_post_meta($post_id, '_sovassa_enquiry_type', true));
	}
	if ('enquiry_email' === $column) {
		echo esc_html((string) get_post_meta($post_id, '_sovassa_email', true));
	}
}
add_action('manage_sovassa_enquiry_posts_custom_column', 'sovassa_enquiry_column', 10, 2);

/**
 * Human copy for a form error code.
 *
 * @return string
 */
function sovassa_form_error_message() {
	if (!isset($_GET['form_error'])) {
		return '';
	}
	$code = sanitize_key(wp_unslash($_GET['form_error']));
	$messages = array(
		'invalid'   => 'The form expired. Please send it again.',
		'email'     => 'Enter a valid email address so we can reply.',
		'consent'   => 'Please confirm we can use your details to respond.',
		'name'      => 'Please add your name.',
		'message'   => 'Please add a short note about the project.',
		'objective' => 'Please describe what you want to achieve.',
		'save'      => 'We could not save that submission. Please try again.',
	);
	return isset($messages[$code]) ? $messages[$code] : 'Please check the form and try again.';
}
