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
		'analytics_id'                 => 'G-2K9QLM7XWQ',
		'search_console_verification'  => 'bMmGjPGOuZCYU0GoqSlQcmqXIcp95-0g776NaifPAcU',
		// Byline on insights. Configured with executive founder profiles for Google E-E-A-T.
		'author'        => array(
			'name'  => 'Simran Kaur',
			'role'  => 'Founder & CEO',
			'bio'   => 'Simran Kaur directs Sovassa Technologies’ executive vision, operations, and global client partnerships, helping ambitious companies scale with unified product development and digital marketing.',
			'url'   => '/about/#founders',
			'image' => 'assets/images/founders/founder-simran-kaur.jpg',
		),
		'authors'       => array(
			'simran'     => array(
				'name'  => 'Simran Kaur',
				'role'  => 'Founder & CEO',
				'bio'   => 'Simran Kaur directs Sovassa Technologies’ executive vision, operations, and global client partnerships, helping ambitious companies scale with unified product development and digital marketing.',
				'url'   => '/about/#founders',
				'image' => 'assets/images/founders/founder-simran-kaur.jpg',
			),
			'sukhwinder' => array(
				'name'  => 'Sukhwinder Kaur',
				'role'  => 'Founder & Managing Director',
				'bio'   => 'Sukhwinder Kaur directs technological architecture, engineering excellence, and technical innovation at Sovassa Technologies, designing scalable, high-performance web systems and native/cross-platform mobile applications.',
				'url'   => '/about/#founders',
				'image' => 'assets/images/founders/founder-sukhwinder-kaur.jpg',
			),
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
