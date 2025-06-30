<?php
/**
 * ToggleTVSet
 *
 * Copyright 2011-2016 by Benjamin Vauchel <contact@omycode.fr>
 * Copyright 2016-2022 by Thomas Jakobi <office@treehillstudio.com>
 *
 * @package toggletvset
 * @subpackage classfile
 */

namespace TreehillStudio\ToggleTVSet;

use modChunk;
use modX;

/**
 * Class ToggleTVSet
 */
class ToggleTVSet
{
    /**
     * A reference to the modX instance
     * @var modX $modx
     */
    public $modx;

    /**
     * The namespace
     * @var string $namespace
     */
    public $namespace = 'toggletvset';

    /**
     * The package name
     * @var string $packageName
     */
    public $packageName = 'ToggleTVSet';

    /**
     * The version
     * @var string $version
     */
    public $version = '2.0.6';

    /**
     * The class options
     * @var array $options
     */
    public $options = [];

    /**
     * ToggleTVSet constructor
     *
     * @param modX $modx A reference to the modX instance.
     * @param array $options An array of options. Optional.
     */
    public function __construct(modX &$modx, $options = [])
    {
        $this->modx =& $modx;
        $this->namespace = $this->getOption('namespace', $options, $this->namespace);

        $corePath = $this->getOption('core_path', $options, $this->modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/' . $this->namespace . '/');
        $assetsPath = $this->getOption('assets_path', $options, $this->modx->getOption('assets_path', null, MODX_ASSETS_PATH) . 'components/' . $this->namespace . '/');
        $assetsUrl = $this->getOption('assets_url', $options, $this->modx->getOption('assets_url', null, MODX_ASSETS_URL) . 'components/' . $this->namespace . '/');
        $modxversion = $this->modx->getVersionData();

        // Load some default paths for easier management
        $this->options = array_merge([
            'namespace' => $this->namespace,
            'version' => $this->version,
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'vendorPath' => $corePath . 'vendor/',
            'chunksPath' => $corePath . 'elements/chunks/',
            'pagesPath' => $corePath . 'elements/pages/',
            'snippetsPath' => $corePath . 'elements/snippets/',
            'pluginsPath' => $corePath . 'elements/plugins/',
            'controllersPath' => $corePath . 'controllers/',
            'processorsPath' => $corePath . 'processors/',
            'templatesPath' => $corePath . 'templates/',
            'assetsPath' => $assetsPath,
            'assetsUrl' => $assetsUrl,
            'jsUrl' => $assetsUrl . 'js/',
            'cssUrl' => $assetsUrl . 'css/',
            'imagesUrl' => $assetsUrl . 'images/',
            'connectorUrl' => $assetsUrl . 'connector.php'
        ], $options);

        // Set default options
        $this->options = array_merge($this->options, [
            'debug' => $this->getBooleanOption('debug', [], false),
            'toggleTVsClearHidden' => $this->getBooleanOption('toggletvs_clearhidden', [], false),
        ]);

        //$this->setToggleTVs();

        $lexicon = $this->modx->getService('lexicon', 'modLexicon');
        $lexicon->load($this->namespace . ':default');
    }

    /**
     * Get a local configuration option or a namespaced system setting by key.
     *
     * @param string $key The option key to search for.
     * @param array $options An array of options that override local options.
     * @param mixed $default The default value returned if the option is not found locally or as a
     * namespaced system setting; by default this value is null.
     * @return mixed The option value or the default value specified.
     */
    public function getOption($key, $options = [], $default = null)
    {
        $option = $default;
        if (!empty($key) && is_string($key)) {
            if ($options != null && array_key_exists($key, $options)) {
                $option = $options[$key];
            } elseif (array_key_exists($key, $this->options)) {
                $option = $this->options[$key];
            } elseif (array_key_exists("$this->namespace.$key", $this->modx->config)) {
                $option = $this->modx->getOption("$this->namespace.$key");
            }
        }
        return $option;
    }

    /**
     * Get Boolean Option
     *
     * @param string $key
     * @param array $options
     * @param mixed $default
     * @return bool
     */
    public function getBooleanOption($key, $options = [], $default = null)
    {
        $option = $this->getOption($key, $options, $default);
        return ($option === 'true' || $option === true || $option === '1' || $option === 1);
    }

    /**
     * Register javascripts in the controller
     */
    public function includeScriptAssets()
    {
        $assetsUrl = $this->getOption('assetsUrl');
        $jsUrl = $this->getOption('jsUrl') . 'mgr/';
        $jsSourceUrl = $assetsUrl . '../../../source/js/mgr/';
        $cssUrl = $this->getOption('cssUrl') . 'mgr/';
        $cssSourceUrl = $assetsUrl . '../../../source/css/mgr/';

        if ($this->getOption('debug') && $assetsUrl != MODX_ASSETS_URL . 'components/toggletvset/') {
            $this->modx->controller->addJavascript($jsSourceUrl . 'toggletvset.js?v=v' . $this->version);
            $this->modx->controller->addJavascript($jsSourceUrl . 'toggletvset.panel.inputoptions.js?v=v' . $this->version);
            $this->modx->controller->addJavascript($jsSourceUrl . 'toggletvset.combo.templatevar.js?v=v' . $this->version);
            $this->modx->controller->addJavascript($jsSourceUrl . 'toggletvset.util.toggle.js?v=v' . $this->version);
            //$this->modx->controller->addJavascript($jsSourceUrl . 'toggletvset-render.js?v=v' . $this->version);
            $this->modx->controller->addCss($cssSourceUrl . 'toggletvset.css?v=v' . $this->version);
        } else {
            $this->modx->controller->addJavascript($jsUrl . 'toggletvset.min.js?v=v' . $this->version);
            $this->modx->controller->addCss($cssUrl . 'toggletvset.min.css?v=v' . $this->version);
        }
        $this->modx->controller->addHtml('<script type="text/javascript">' .
            'ToggleTVSet.config = ' . json_encode($this->options, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . ';' .
            '</script>');
    }

    public function setToggleTVs()
    {
        $toggletvs = [];
        $hidetvs = [];
        $showtvs = [];

        $c = $this->modx->newQuery('modTemplateVar');
        $c->innerJoin('modTemplateVarTemplate', 'TemplateVarTemplate', [
            'TemplateVarTemplate.tmplvarid = modTemplateVar.id',
        ]);
        $c->where([
            'type:=' => 'toggletvset',
            'TemplateVarTemplate.templateid' => ($this->modx->resource) ? $this->modx->resource->get('template') : $this->modx->getOption('default_template'),
        ]);
        if ($this->getOption('toggletvs')) {
            $c->where([
                'OR:id:IN' => ($this->getOption('toggletvs')) ? array_map('trim', explode(',', $this->getOption('toggletvs'))) : [],
            ]);
        }
        $tvs = $this->modx->getIterator('modTemplateVar', $c);
        foreach ($tvs as $tv) {
            $toggletv = $tv->get('id');
            $toggletvs[] = (string)$toggletv;
            $elements = $tv->get('elements');
            $elements = explode('||', $elements);

            foreach ($elements as $element) {
                $element = explode('==', $element);
                if (isset($element[1])) {
                    if (strpos($element[1], '[[') !== false) {
                        /** @var modChunk $chunk */
                        $chunk = $this->modx->newObject('modChunk', ['name' => "{tmp}-" . uniqid()]);
                        $chunk->setCacheable(false);
                        $element[1] = $chunk->process([], $element[1]);
                        $parser = $this->modx->getParser();
                        $parser->processElementTags('', $element[1], true, true, '[[', ']]', [], 0);
                    }
                    $hidetvs = array_merge($hidetvs, array_map('trim', explode(',', $element[1])));
                }
            }
            $hidetvs = array_values(array_unique($hidetvs));
            if ($this->modx->resource) {
                $tvr = $this->modx->getObject('modTemplateVarResource', [
                    'tmplvarid' => $toggletv,
                    'contentid' => $this->modx->resource->get('id')
                ]);
                if ($tvr) {
                    $tvvalue = $tvr->get('value');
                } else {
                    $tv = $this->modx->getObject('modTemplateVar', $toggletv);
                    $tvvalue = ($tv) ? $tv->get('default_text') : '';
                }
                if ($tvvalue) {
                    if (strpos($tvvalue, '[[') !== false) {
                        /** @var modChunk $chunk */
                        $chunk = $this->modx->newObject('modChunk', ['name' => "{tmp}-" . uniqid()]);
                        $chunk->setCacheable(false);
                        $tvvalue = $chunk->process([], $tvvalue);
                        $parser = $this->modx->getParser();
                        $parser->processElementTags('', $tvvalue, true, true, '[[', ']]', [], 0);
                    }
                    $showtvs = array_merge($showtvs, array_map('trim', explode(',', $tvvalue)));
                }
            }
            $showtvs = array_values(array_unique($showtvs));
        }

        return [
            'toggleTVs' => $toggletvs,
            'hideTVs' => $hidetvs,
            'showTVs' => $showtvs,
        ];
    }
}
