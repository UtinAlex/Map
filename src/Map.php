<?php

namespace Ads\Map;

use Laravel\Nova\Card;

class Map extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'map';
    }

    /**
     * Indicates that the analytics should show current visitors.
     *
     * @return $this
     */
    public function mapCoordinates($latitude)
    {
        return $this->withMeta(['mapCoordinates' => $latitude]);
    }
}
