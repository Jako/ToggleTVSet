<?php
/**
 * ToggleTVSet Input Options Render
 *
 * @package toggletvset
 * @subpackage inputoptions_render
 */

/** @var modX $modx */
$corePath = $modx->getOption('toggletvset.core_path', null, $modx->getOption('core_path') . 'components/toggletvset/');

return $modx->smarty->fetch($corePath . 'elements/tv/input/tpl/toggletvset.options.tpl');
