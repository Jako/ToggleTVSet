<?php
/**
 * ToggleTVSet Runtime Hooks
 *
 * @package toggletvset
 * @subpackage plugin
 *
 * @var modX $modx
 * @var array $scriptProperties
 */

$className = 'TreehillStudio\ToggleTVSet\Plugins\Events\\' . $modx->event->name;

$corePath = $modx->getOption('toggletvset.core_path', null, $modx->getOption('core_path') . 'components/toggletvset/');
/** @var ToggleTVSet $toggletvset */
$toggletvset = $modx->getService('toggletvset', 'ToggleTVSet', $corePath . 'model/toggletvset/', [
    'core_path' => $corePath
]);

if ($toggletvset) {
    if (class_exists($className)) {
        $handler = new $className($modx, $scriptProperties);
        if (get_class($handler) == $className) {
            $handler->run();
        } else {
            $modx->log(xPDO::LOG_LEVEL_ERROR, $className. ' could not be initialized!', '', 'ToggleTVSet Plugin');
        }
    } else {
        $modx->log(xPDO::LOG_LEVEL_ERROR, $className. ' was not found!', '', 'ToggleTVSet Plugin');
    }
}

return;
