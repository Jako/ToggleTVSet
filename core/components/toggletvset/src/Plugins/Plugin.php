<?php
/**
 * Abstract plugin
 *
 * @package toggletvset
 * @subpackage plugin
 */

namespace TreehillStudio\ToggleTVSet\Plugins;

use modX;
use ToggleTVSet;

/**
 * Class Plugin
 */
abstract class Plugin
{
    /** @var modX $modx */
    protected $modx;
    /** @var ToggleTVSet $toggletvset */
    protected $toggletvset;
    /** @var array $scriptProperties */
    protected $scriptProperties;

    /**
     * Plugin constructor.
     *
     * @param $modx
     * @param $scriptProperties
     */
    public function __construct($modx, &$scriptProperties)
    {
        $this->scriptProperties = &$scriptProperties;
        $this->modx =& $modx;
        $corePath = $this->modx->getOption('toggletvset.core_path', null, $this->modx->getOption('core_path') . 'components/toggletvset/');
        $this->toggletvset = $this->modx->getService('toggletvset', 'ToggleTVSet', $corePath . 'model/toggletvset/', [
            'core_path' => $corePath
        ]);
    }

    /**
     * Run the plugin event.
     */
    public function run()
    {
        $init = $this->init();
        if ($init !== true) {
            return;
        }

        $this->process();
    }

    /**
     * Initialize the plugin event.
     *
     * @return bool
     */
    public function init()
    {
        return true;
    }

    /**
     * Process the plugin event code.
     *
     * @return mixed
     */
    abstract public function process();
}