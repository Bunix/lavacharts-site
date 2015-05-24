<?php

namespace Khill\Lavacharts\Configs;

use \Khill\Lavacharts\Utils;

use \Khill\Lavacharts\Exceptions\InvalidConfigValue;

/**
 * Crosshair ConfigObject
 *
 * An object containing the crosshair properties for the chart.
 *
 *
 * @package    Lavacharts
 * @subpackage Configs
 * @since      3.0.0
 * @author     Kevin Hill <kevinkhill@gmail.com>
 * @copyright  (c) 2015, KHill Designs
 * @link       http://github.com/kevinkhill/lavacharts GitHub Repository Page
 * @link       http://lavacharts.com                   Official Docs Site
 * @license    http://opensource.org/licenses/MIT MIT
 */
class Crosshair extends ConfigObject
{
    /**
     * Foreground color.
     *
     * @var string
     */
    public $color;

    /**
     * Focused color.
     *
     * @var
     */
    public $focused;

    /**
     * Crosshair opacity.
     *
     * @var float
     */
    public $opacity;

    /**
     * Crosshair orientation.
     *
     * @var string
     */
    public $orientation;

    /**
     * Focused color.
     *
     * @var
     */
    public $selected;

    /**
     * Crosshair trigger.
     *
     * @var string
     */
    public $trigger;

    /**
     * Stores all the information about the crosshair.
     *
     * All options can be set either by passing an array with associative
     * values for option => value, or by chaining together the functions
     * once an object has been created.
     *
     * @param  array                 $config
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigProperty
     * @return self
     */
    public function __construct($config = [])
    {
        parent::__construct($this, $config);

        $this->options = array_merge(
            $this->options,
            [
                'color',
                'focused',
                'opacity',
                'orientation',
                'selected',
                'trigger'
            ]
        );
    }

    /**
     * Specifies the crosshair color.
     *
     * @param  string             $color
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     * @return self
     */
    public function color($color)
    {
        if (is_string($color)) {
            $this->color = $color;
        } else {
            throw new InvalidConfigValue(
                __FUNCTION__,
                'string'
            );
        }

        return $this;
    }

    /**
     * An object that specifies the crosshair focused color.
     *
     * @param  Color     $color
     * @return self
     */
    public function focused(Color $color)
    {
        $this->focused = $color->getValues();

        return $this;
    }

    /**
     * The crosshair opacity, with 0.0 being fully transparent and 1.0 fully opaque.
     *
     * @param  float     $opacity
     * @return self
     */
    public function opacity($opacity)
    {
        if (Utils::between(0.0, $opacity, 1.0, true)) {
            $this->opacity = $opacity;
        } else {
            throw new InvalidConfigValue(
                __FUNCTION__,
                'float',
                'between 0.0 - 1.0'
            );
        }

        return $this;
    }

    /**
     * The crosshair orientation, which can be 'vertical' for vertical hairs only,
     * 'horizontal' for horizontal hairs only, or 'both' for traditional crosshairs.
     *
     * @param  string             $orientation
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     * @return self
     */
    public function orientation($orientation)
    {
        $values = [
            'both',
            'horizontal',
            'vertical'
        ];

        if (in_array($orientation, $values, true)) {
            $this->orientation = $orientation;
        } else {
            throw new InvalidConfigValue(
                __FUNCTION__,
                'string',
                'with a value of '.Utils::arrayToPipedString($values)
            );
        }

        return $this;
    }

    /**
     * An object that specifies the crosshair selected color.
     *
     * @param  Color     $color
     * @return self
     */
    public function selected(Color $color)
    {
        $this->selected = $color->getValues();

        return $this;
    }

    /**
     * When to display crosshairs: on 'focus', 'selection', or 'both'.
     *
     * @param  string             $trigger
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     * @return self
     */
    public function trigger($trigger)
    {
        $values = [
            'both',
            'focus',
            'selection'
        ];

        if (in_array($trigger, $values, true)) {
            $this->trigger = $trigger;
        } else {
            throw new InvalidConfigValue(
                __FUNCTION__,
                'string',
                'with a value of '.Utils::arrayToPipedString($values)
            );
        }

        return $this;
    }
}
