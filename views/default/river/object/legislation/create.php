<?php
/**
 * entity river view.
 */

$item = elgg_extract('item', $vars);
if (!$item instanceof ElggRiverItem) {
	return;
}

$entity = $item->getObjectEntity();
if (!$entity instanceof ElggLegislations) {
	return;
}

$vars['message'] = $entity->summary;

echo elgg_view('river/elements/layout', $vars);
