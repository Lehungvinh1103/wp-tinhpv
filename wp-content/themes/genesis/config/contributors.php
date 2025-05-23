<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Contributors
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

/**
 * To toggle someone as being a contributor to a particular release, toggle the comment on their role.
 *
 * Each person will ultimately need the following properties (once added to `Genesis_Contributors`):
 *   name
 *   url (full URL)
 *   avatar (full path to image)
 *   role (typically `contributor` or `lead-developer`)
 *
 * There are two shortcut properties:
 *   twitter (just the twitter handle, no `@`, which gets converted into a full URL for the `url` key)
 *   gravatar (just the hash, which gets converted into a full Gravatar URL for the `avatar` key)
 *
 * The shortcut properties are preferred, but if someone does not have Twitter, or a Gravatar URL,
 * different sources can be provided in the `url and `avatar` keys.
 */
// phpcs:disable Squiz.PHP.CommentedOutCode.Found -- PHPCS doesn't like the commented-out role key-values.
return [
	'nathanrice'       => [
		'name'     => 'Nathan Rice',
		'twitter'  => 'nathanrice',
		'gravatar' => 'fdbd4b13e3bcccb8b48cc18f846efb7f',
		'role'     => 'lead-developer',
	],
	'briangardner'     => [
		'name'     => 'Brian Gardner',
		'twitter'  => 'bgardner',
		'gravatar' => 'c845c86ebe395cea0d21c03bc4a93957',
		'role'     => 'lead-developer',
	],
	'johnparris'       => [
		'name'     => 'John Parris',
		'twitter'  => 'John_Parris',
		'gravatar' => '1b31a4fe3905a88053a566b6037002d5',
		'role'     => 'lead-developer',
	],
	'garyjones'        => [
		'name'     => 'Gary Jones',
		'twitter'  => 'garyj',
		'gravatar' => 'e70d4086e89c2e1e081870865be68485',
		'role'     => 'contributor',
	],
	'tonyamork'        => [
		'name'     => 'Tonya Mork',
		'twitter'  => 'hellofromTonya',
		'gravatar' => 'cd9217f16a69ad83496f5e182caf0649',
		// 'role'     => 'contributor',
	],
	'ronrennick'       => [
		'name'     => 'Ron Rennick',
		'twitter'  => 'sillygrampy',
		'gravatar' => '7b8ff059b9a4504dfbaebd4dd190466e',
		// 'role'     => 'contributor',
	],
	'leeanthony'       => [
		'name'     => 'Lee Anthony',
		'twitter'  => 'seothemeswp',
		'gravatar' => '0520d97bf4999e910f18ccbe51a07c99',
		// 'role'     => 'contributor',
	],
	'jaredatchison'    => [
		'name'     => 'Jared Atchison',
		'twitter'  => 'jaredatch',
		'gravatar' => 'e341eca9e1a85dcae7127044301b4363',
		// 'role'     => 'contributor',
	],
	'jenbaumann'       => [
		'name'     => 'Jen Baumann',
		'twitter'  => 'dreamwhisper',
		'gravatar' => 'eb9c6d91d77db908473131160e71ef6f',
		'role'     => 'contributor',
	],
	'brianbourn'       => [
		'name'     => 'Brian Bourn',
		'twitter'  => 'brianbourn',
		'gravatar' => 'fd5093291ce465911f8a2d5aa2045de6',
		// 'role'     => 'contributor',
	],
	'jonbrown'         => [
		'name'     => 'Jon Brown',
		'twitter'  => 'jb510',
		'gravatar' => 'f1c8858594659f20b4e99d65d0855f7c',
		// 'role'     => 'contributor',
	],
	'chriscochran'     => [
		'name'     => 'Chris Cochran',
		'twitter'  => 'tweetsfromchris',
		'gravatar' => 'aa0bea067ea6bfb854387d73f595aa1c',
		// 'role'     => 'contributor',
	],
	'nickcernis'       => [
		'name'     => 'Nick Cernis',
		'twitter'  => 'NickCernis',
		'gravatar' => '459313f5f8b00775ef71be0e5191ff62',
		'role'     => 'contributor',
	],
	'marcydiaz'        => [
		'name'     => 'Marcy Diaz',
		'twitter'  => 'mjsdiaz1',
		'gravatar' => 'b51816d10eea5a7c59ff204961011a08',
		// 'role'     => 'contributor',
	],
	'robincornett'     => [
		'name'     => 'Robin Cornett',
		'twitter'  => 'robincornett',
		'gravatar' => '92f90103972341af5dcf421661209729',
		// 'role'     => 'contributor',
	],
	'nickcroft'        => [
		'name'     => 'Nick Croft',
		'twitter'  => 'nick_thegeek',
		'gravatar' => '3241d4eab93215b5487e162b87569e42',
		// 'role'     => 'contributor',
	],
	'daviddecker'      => [
		'name'     => 'David Decker',
		'twitter'  => 'deckerweb',
		'gravatar' => '28d02f8d09fc32fccc0282efdc23a4e5',
		// 'role'     => 'contributor',
	],
	'remkusdevries'    => [
		'name'     => 'Remkus de Vries',
		'twitter'  => 'DeFries',
		'gravatar' => 'e15799da17422f3fa7a6157339501e2c',
		// 'role'     => 'contributor',
	],
	'carriedils'       => [
		'name'     => 'Carrie Dils',
		'twitter'  => 'cdils',
		'gravatar' => '312a558dc3619f40b429d60b6fde9ee1',
		// 'role'     => 'contributor',
	],
	'josheaton'        => [
		'name'     => 'Josh Eaton',
		'twitter'  => 'jjeaton',
		'gravatar' => 'd32c3546dfa39bda008b07a91826df1d',
		// 'role'     => 'contributor',
	],
	'billerickson'     => [
		'name'     => 'Bill Erickson',
		'twitter'  => 'billerickson',
		'gravatar' => 'ae510affa31e5b946623bda4ff969b67',
		// 'role'     => 'contributor',
	],
	'salferrarello'    => [
		'name'     => 'Sal Ferrarello',
		'twitter'  => 'salcode',
		'gravatar' => 'f7bea39ff77df472cc4e3c29e40d3e46',
		// 'role'     => 'contributor',
	],
	'thomasgriffin'    => [
		'name'     => 'Thomas Griffin',
		'twitter'  => 'jthomasgriffin',
		'gravatar' => 'fe4225114bfd1f8993c6d20d32227537',
		// 'role'     => 'contributor',
	],
	'mikehemberger'    => [
		'name'     => 'Mike Hemberger',
		'twitter'  => 'jivedig',
		'gravatar' => '371c8693fa81eb43dadc28eaaba367f8',
		'role'     => 'contributor',
	],
	'christophherr'    => [
		'name'     => 'Christoph Herr',
		'twitter'  => 'Christoph_Herr',
		'gravatar' => '16e62c03133d8068dac42352fd3a9909',
		// 'role'     => 'contributor',
	],
	'jayhill'          => [
		'name'     => 'Jay Hill',
		'twitter'  => 'wpdevlife',
		'gravatar' => '2afc00d7b8851571b9d61a4997212071',
		'role'     => 'contributor',
	],
	'tiagohillebrandt' => [
		'name'     => 'Tiago Hillebrandt',
		'twitter'  => 'tiagoscd',
		'gravatar' => 'f621dee2befcb84893d2543905afb66f',
		// 'role'     => 'contributor',
	],
	'markjaquith'      => [
		'name'     => 'Mark Jaquith',
		'twitter'  => 'markjaquith',
		'gravatar' => '682b7a49f9ed567186c4d1f707fe4523',
		// 'role'     => 'contributor',
	],
	'timjensen'        => [
		'name'     => 'Tim Jensen',
		'twitter'  => 'timothy_jensen_',
		'gravatar' => 'a1d48c77f8d239fe09ed9e05a88980e1',
		// 'role'     => 'contributor',
	],
	'sridharkatakam'   => [
		'name'     => 'Sridhar Katakam',
		'twitter'  => 'srikat',
		'gravatar' => '0e1ab0231a04ca6c9cccd3579d5d2c0f',
		// 'role'     => 'contributor',
	],
	'calvinkoepke'     => [
		'name'     => 'Calvin Koepke',
		'twitter'  => 'cjkoepke',
		'gravatar' => 'c4e7524abdec288e00e23dc1d15f91d7',
		// 'role'     => 'contributor',
	],
	'brandonkraft'     => [
		'name'     => 'Brandon Kraft',
		'twitter'  => 'kraft',
		'gravatar' => 'fa4976cfd706b9be00f6494df9aa99d9',
		// 'role'     => 'contributor',
	],
	'laurenmancke'     => [
		'name'     => 'Lauren Mancke',
		'twitter'  => 'laurenmancke',
		'gravatar' => 'f7478b09179c624a91ba6c45422fbf4e',
		// 'role'     => 'contributor',
	],
	'carlomanf'        => [
		'name'     => 'Carlo Manf',
		'twitter'  => 'manfcarlo',
		'gravatar' => '495aa472007b999d2489201fdb17aa35',
		// 'role'     => 'contributor',
	],
	'mikemcalister'    => [
		'name'     => 'Mike McAlister',
		'twitter'  => 'mikemcalister',
		'gravatar' => '0aeecce7f483aa2b409fe65c352d034a',
		// 'role'     => 'contributor',
	],
	'andrewnorcross'   => [
		'name'     => 'Andrew Norcross',
		'twitter'  => 'norcross',
		'gravatar' => '26ab8f9b2c86b10e7968b882403b3bf8',
		// 'role'     => 'contributor',
	],
	'travisnorthcutt'  => [
		'name'     => 'Travis Northcutt',
		'twitter'  => 'tnorthcutt',
		'gravatar' => 'a3b6222854e90883765f5f30375718bf',
		// 'role'     => 'contributor',
	],
	'jeremypry'        => [
		'name'     => 'Jeremy Pry',
		'twitter'  => 'JPry',
		'gravatar' => '84552f74b71a1a3e6aae380aa9ab3bd3',
		// 'role'     => 'contributor',
	],
	'gregrickaby'      => [
		'name'     => 'Greg Rickaby',
		'twitter'  => 'GregRickaby',
		'gravatar' => '28af3e39c0a1fe4c31367c7e9a8bcac3',
		// 'role'     => 'contributor',
	],
	'rianrietveld'     => [
		'name'     => 'Rian Rietveld',
		'twitter'  => 'RianRietveld',
		'gravatar' => '54b6a8a47f9d6f1a93f33be5909c59a5',
		// 'role'     => 'contributor',
	],
	'marcosschratz'    => [
		'name'     => 'Marcos Schratzenstaller',
		'twitter'  => 'marksabbath',
		'gravatar' => '24a3f43146b18fc5c7a70ba233aa4c6b',
		'role'     => 'contributor',
	],
	'travissmith'      => [
		'name'     => 'Travis Smith',
		'twitter'  => 'wp_smith',
		'gravatar' => '7e673cdf99e6d7448f3cbaf1424c999c',
		// 'role'     => 'contributor',
	],
	'rafaltomal'       => [
		'name'     => 'Rafal Tomal',
		'twitter'  => 'rafaltomal',
		'gravatar' => 'c9f7b936cd19bd5aba8831ddea21f05d',
		// 'role'     => 'contributor',
	],
	'ronwillemse'      => [
		'name'     => 'Ron Willemse',
		'twitter'  => 'ronwillemse',
		'gravatar' => 'b4075dd8ec19e79cae578ff19ae29bf1',
		// 'role'     => 'contributor',
	],
];
// phpcs:enable Squiz.PHP.CommentedOutCode.Found
