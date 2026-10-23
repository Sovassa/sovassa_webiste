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
		'tagline'       => 'Build. Launch. Grow.',
		'domain'        => 'https://sovassa.com/',
		'phone'         => '+917002862687',
		'phone_display' => '+91 7002862687',
		'email'         => 'admin@sovassa.com',
		'office'        => 'Hermitage Centralis, SCO 5, VIP Rd, Zirakpur, Punjab 140603',
		'maps_url'      => 'https://www.google.com/maps/place/Sovassa+Technologies/data=!4m2!3m1!1s0x0:0x7d8217d45bfc667d?sa=X&ved=1t:2428&ictx=111',
		'maps_embed_url'=> 'https://maps.google.com/maps?cid=9043817202557150845&output=embed',
		'contact_note'  => 'Call, WhatsApp, or email us, or send the form and we will reply to the address you share. We work with clients worldwide.',
		'analytics_id'                 => 'G-3WB7FRC1LR',
		'search_console_verification'  => 'bMmGjPGOuZCYU0GoqSlQcmqXIcp95-0g776NaifPAcU',
		// Byline on insights. Leave 'name' empty to credit the company. With a real
		// person, add a profile URL so search engines can connect the author.
		'author'        => array(
			'name'  => '',
			'role'  => '',
			'bio'   => '',
			'url'   => '',
			'image' => '',
		),
		'social'        => array(
			'LinkedIn'  => 'https://www.linkedin.com/company/sovassa-technologies',
			'Instagram' => 'https://www.instagram.com/sovassa_technologies/',
			'Facebook'  => 'https://www.facebook.com/sovassa.technologies',
		),
		'clutch_url'    => 'https://clutch.co/profile/sovassa-technologies',
		'goodfirms_url' => 'https://www.goodfirms.co/company/sovassa-technologies',
	);
}
