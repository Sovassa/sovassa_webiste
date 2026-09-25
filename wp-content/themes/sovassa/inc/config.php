<?php
/**
 * Site-wide company details.
 *
 * @package Sovassa
 */

/**
 * Company details used in the header, footer, forms, and enquiry mail.
 *
 * @return array<string, string>
 */
function sovassa_config() {
	return array(
		'name'          => 'Sovassa Technologies',
		'short_name'    => 'Sovassa',
		'tagline'       => 'Build. Market. Grow.',
		'domain'        => 'https://sovassa.com/',
		'phone'         => '+917002862687',
		'phone_display' => '+91 7002862687',
		'email'         => 'admin@sovassa.com',
		'office'        => 'Zirakpur, India',
		'contact_note'  => 'Call or email us, or send the form and we will reply to the address you share. The office is in Zirakpur, India.',
	);
}
