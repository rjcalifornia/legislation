<?php


namespace Elgg\Legislations\Menus;


/**
 * Hook callbacks for menus
 *
 * @since 4.0
 * @internal
 */
class Site {

	   /**
	 * Register item to menu
	 *
	 * @param \Elgg\Event $event 'register', 'menu:site'
	 *
	 * @return \Elgg\Menu\MenuItems
	 */
	public static function register(\Elgg\Event $event) {
		$return = $event->getValue();
		
		$return[] = \ElggMenuItem::factory([
			'name' => 'legislations',
			'icon' => 'comment',
			'text' => elgg_echo('collection:object:legislations'),
			'href' => elgg_generate_url('default:object:legislations'),
		]);
		
		return $return;
	}
}
