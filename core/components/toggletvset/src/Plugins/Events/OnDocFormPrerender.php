<?php
/**
 * @package toggletvset
 * @subpackage plugin
 */

namespace TreehillStudio\ToggleTVSet\Plugins\Events;

use TreehillStudio\ToggleTVSet\Plugins\Plugin;

class OnDocFormPrerender extends Plugin
{
    public function process()
    {
        $this->modx->controller->addHtml('<script type="text/javascript"> 
            ToggleTVSet.config = Object.assign(ToggleTVSet.config, ' . json_encode($this->toggletvset->setToggleTVs(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . ');
            MODx.on("ready", function() {
                setTimeout(function () {
                    ToggleTVSet.util.init();
                }, 500);
            });
        </script>');
    }
}
