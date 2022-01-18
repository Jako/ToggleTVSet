<?php
/**
 * @package toggletvset
 * @subpackage plugin
 */

namespace TreehillStudio\ToggleTVSet\Plugins\Events;

use modTemplateVar;
use TreehillStudio\ToggleTVSet\Plugins\Plugin;

class OnManagerPageBeforeRender extends Plugin
{
    public function process()
    {
        $this->modx->controller->addLexiconTopic('toggletvset:default');
        $this->toggletvset->includeScriptAssets();
    }
}
