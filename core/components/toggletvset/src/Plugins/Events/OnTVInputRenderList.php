<?php
/**
 * @package toggletvset
 * @subpackage plugin
 */

namespace TreehillStudio\ToggleTVSet\Plugins\Events;

use TreehillStudio\ToggleTVSet\Plugins\Plugin;

class OnTVInputRenderList extends Plugin
{
    public function process()
    {
        $this->modx->event->output($this->toggletvset->getOption('corePath') . 'elements/tv/input/');
    }
}
