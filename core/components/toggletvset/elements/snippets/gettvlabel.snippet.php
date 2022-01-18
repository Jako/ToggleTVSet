<?php
/**
 * GetTVLabel Snippet
 *
 * @package toggletvset
 * @subpackage snippet
 *
 * @var modX $modx
 * @var array $scriptProperties
 */

use TreehillStudio\ToggleTVSet\Snippets\GetTVLabel;

$corePath = $modx->getOption('toggletvset.core_path', null, $modx->getOption('core_path') . 'components/toggletvset/');
/** @var ToggleTVSet $toggletvset */
$toggletvset = $modx->getService('toggletvset', 'ToggleTVSet', $corePath . 'model/toggletvset/', [
    'core_path' => $corePath
]);

$snippet = new GetTVLabel($modx, $scriptProperties);
if ($snippet instanceof TreehillStudio\ToggleTVSet\Snippets\GetTVLabel) {
    return $snippet->execute();
}
return 'TreehillStudio\ToggleTVSet\Snippets\GetTVLabel class not found';