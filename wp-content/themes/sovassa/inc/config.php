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
		'maps_url'      => 'https://maps.app.goo.gl/tCo4o3xFd4VxRMsu9',
		'contact_note'  => 'Call, WhatsApp, or email us, or send the form and we will reply to the address you share. The office is in Zirakpur, India.',
		'analytics_id'                 => 'G-3WB7FRC1LR',
		'search_console_verification'  => '',
		'social'        => array(
			'Instagram' => 'https://www.instagram.com/sovassa_technologies/',
			'Facebook'  => 'https://www.facebook.com/sovassa.technologies',
		),
	);
}
