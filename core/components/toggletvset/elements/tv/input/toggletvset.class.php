<?php
/**
 * ToggleTVSet Input Render
 *
 * @package toggletvset
 * @subpackage input_render
 */

class ToggletvsetInputRender extends modTemplateVarInputRender
{
    /**
     * Return the template path to load
     *
     * @return string
     */
    public function getTemplate()
    {
        $corePath = $this->modx->getOption('toggletvset.core_path', null, $this->modx->getOption('core_path') . 'components/toggletvset/');
        return $corePath . 'elements/tv/input/tpl/toggletvset.render.tpl';
    }

    /**
     * Get lexicon topics
     *
     * @return array
     */
    public function getLexiconTopics()
    {
        return ['toggletvset:default'];
    }

    /**
     * Process Input Render
     *
     * @param string $value
     * @param array $params
     * @return void
     */
    public function process($value, array $params = [])
    {
        $opts = [];
        $options = $this->tv->get('elements') ? explode('||', $this->tv->get('elements')) : [];
        foreach ($options as $option) {
            $option = explode('==', $option);
            $optionText = $option[0];
            $optionValue = (isset($option[1])) ? $option[1] : $option[0];
            $opts[] = [
                'text' => $optionText,
                'value' => $optionValue,
                'selected' => $optionValue == $value
            ];
        }
        $this->setPlaceholder('opts', $opts);
        $this->setPlaceholder('value', $value);
    }
}

return 'ToggletvsetInputRender';
