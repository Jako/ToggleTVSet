<?php
/**
 * ToggleTVSetAdd Snippet
 *
 * @package toggletvset
 * @subpackage snippet
 */

namespace TreehillStudio\ToggleTVSet\Snippets;

class GetTVNames extends Snippet
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
     * Output filter that retrieves the names of TVs from a comma-separated list of TV IDs in the input property
     *
     * @return string
     * @throws /Exception
     */
    public function execute()
    {
        $tvIds = explode(',', $this->getProperty('input'));

        $tvNames = [];
        foreach ($tvIds as $tvId) {
            $tv = $this->modx->getObject('modTemplateVar', $tvId);
            if (!empty($tv)) {
                $tvNames[] = $tv->get('name');
            }
        }

        return implode(',', $tvNames);
    }
}
