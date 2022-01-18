<?php
/**
 * GetTVLabel Snippet
 *
 * @package toggletvset
 * @subpackage snippet
 */

namespace TreehillStudio\ToggleTVSet\Snippets;

use modChunk;

class GetTVLabel extends Snippet
{
    /**
     * Get default snippet properties.
     *
     * @return array
     */
    public function getDefaultProperties()
    {
        return [
            'input' => '',
            'options' => '',
            'name' => '',
        ];
    }

    /**
     * Output filter that retrieves the label of a corresponding TV value in the input property
     *
     * @return string
     * @throws /Exception
     */
    public function execute()
    {
        $name = $this->getProperty('name');
        $options = $this->getProperty('options');
        $name = (!empty($options)) ? str_replace($options, '', $name) : $name;
        $tv = $this->modx->getObject('modTemplateVar', ['name' => $name]);

        $elements = (!empty($tv)) ? explode('||', $tv->get('elements')) : [];

        $output = '';
        foreach ($elements as $key => $element) {
            $element = explode('==', $element);

            $value = $element[1] ?? '';
            if (strpos($value, '[[') !== false) {
                /** @var modChunk $chunk */
                $chunk = $this->modx->newObject('modChunk', ['name' => '{tmp}-' . uniqid()]);
                $chunk->setCacheable(false);
                $value = $chunk->process([], $value);
                $parser = $this->modx->getParser();
                $parser->processElementTags('', $value, true, true, '[[', ']]', [], 0);
            }
            if ($value == $this->getProperty('input')) {
                $output = $element[0];
                break;
            }
        }

        return $output;
    }
}
