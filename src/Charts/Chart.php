<?php

namespace Khill\Lavacharts\Charts;

use \Khill\Lavacharts\Utils;
<<<<<<< HEAD
use \Khill\Lavacharts\JavascriptFactory;
use \Khill\Lavacharts\Configs\DataTable;
use \Khill\Lavacharts\Configs\Animation;
=======
use \Khill\Lavacharts\Options;
use \Khill\Lavacharts\JsonConfig;
use \Khill\Lavacharts\Values\Label;
>>>>>>> origin/3.0
use \Khill\Lavacharts\Configs\Legend;
use \Khill\Lavacharts\Configs\Tooltip;
use \Khill\Lavacharts\Configs\TextStyle;
use \Khill\Lavacharts\Configs\ChartArea;
<<<<<<< HEAD
use \Khill\Lavacharts\Configs\BackgroundColor;
use \Khill\Lavacharts\Exceptions\DataTableNotFound;
use \Khill\Lavacharts\Exceptions\InvalidElementId;
use \Khill\Lavacharts\Exceptions\InvalidConfigProperty;
=======
use \Khill\Lavacharts\Configs\Animation;
use \Khill\Lavacharts\Configs\EventManager;
use \Khill\Lavacharts\Configs\BackgroundColor;
use \Khill\Lavacharts\DataTables\DataTable;
use \Khill\Lavacharts\Javascript\JavascriptFactory;
use \Khill\Lavacharts\Exceptions\DataTableNotFound;
>>>>>>> origin/3.0
use \Khill\Lavacharts\Exceptions\InvalidConfigValue;

/**
 * Chart Class, Parent to all charts.
 *
 * Has common properties and methods used between all the different charts.
 *
 *
<<<<<<< HEAD
 * @package    Lavacharts
=======
 * @package    Khill\Lavacharts
>>>>>>> origin/3.0
 * @subpackage Charts
 * @author     Kevin Hill <kevinkhill@gmail.com>
 * @copyright  (c) 2015, KHill Designs
 * @link       http://github.com/kevinkhill/lavacharts GitHub Repository Page
 * @link       http://lavacharts.com                   Official Docs Site
 * @license    http://opensource.org/licenses/MIT MIT
 */
<<<<<<< HEAD
class Chart
=======
class Chart extends JsonConfig
>>>>>>> origin/3.0
{
    /**
     * The chart's unique label.
     *
<<<<<<< HEAD
     * @var string
     */
    public $label = null;
=======
     * @var \Khill\Lavacharts\Values\Label
     */
    protected $label;
>>>>>>> origin/3.0

    /**
     * The chart's datatable.
     *
<<<<<<< HEAD
     * @var DataTable
     */
    protected $datatable = null;

    /**
     * The chart's defined events.
     *
     * @var array
     */
    protected $events = [];

    /**
     * The chart's user set options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The chart's default options.
     *
     * @var array
     */
    protected $defaults = [
=======
     * @var \Khill\Lavacharts\DataTables\DataTable
     */
    protected $datatable;

    /**
     * Enabled chart events with callbacks.
     *
     * @var \Khill\Lavacharts\Configs\EventManager
     */
    protected $events;

    /**
     * Default configuration options for the chart.
     *
     * @var array
     */
    protected $chartDefaults = [
>>>>>>> origin/3.0
        'animation',
        'backgroundColor',
        'chartArea',
        'colors',
        'datatable',
        'events',
        'fontSize',
        'fontName',
        'height',
        'legend',
        'title',
        'titlePosition',
        'titleTextStyle',
        'tooltip',
        'width'
    ];


    /**
     * Builds a new chart with the given label.
     *
<<<<<<< HEAD
     * @param  string $chartLabel Identifying label for the chart.
     * @param  \Khill\Lavacharts\Configs\DataTable $datatable Datatable used for the chart.
     * @return self
     */
    public function __construct($chartLabel, DataTable $datatable)
    {
        if (Utils::nonEmptyString($chartLabel) === false) {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'string',
                'which is unique and non-empty'
            );
        }

        $this->label     = $chartLabel;
        $this->datatable = $datatable;
    }
/* @TODO: see if child charts can have defaults as properties and the parent constructor merge them.
    public function mergeDefaultOptions($childDefaults)
    {
        $this->defaults = array_merge($childDefaults, $this->defaults);
    }
*/
    /**
     * Sets a configuration option
     *
     * Takes an array with option => value, or an object created by
     * one of the configOptions child objects.
     *
     * @param mixed $o
     *
     * @return this
     */
    protected function addOption($o)
    {
        if (is_array($o)) {
            $this->options = array_merge($this->options, $o);
        } else {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'array'
            );
        }

        return $this;
    }

    /**
     * Sets configuration options from array of values
     *
     * You can set the options all at once instead of passing them individually
     * or chaining the functions from the chart objects.
     *
     * @param  array $options
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigProperty
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     * @return self
     */
    public function setOptions($options)
    {
        if (is_array($options) === false || count($options) == 0) {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'array'
            );
        }

        foreach ($options as $option => $value) {
            if (in_array($option, $this->defaults)) {
                $this->$option($value);
            } else {
                throw new InvalidConfigProperty(
                    static::TYPE,
                    __FUNCTION__,
                    $option,
                    $this->defaults
                );
            }
        }

        return $this;
    }

    /**
     * Gets a specific option from the array.
     *
     * @param  string             $option Which option to fetch
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     * @return mixed
     */
    public function getOption($option)
    {
        if (is_string($option) === false || array_key_exists($option, $this->options) === false) {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'string',
                'must be one of '.Utils::arrayToPipedString($this->defaults)
            );
        }

        return $this->options[$option];
    }

    /**
     * Gets the current chart options.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Returns a JSON string representation of the chart's properties.
     *
     * @return string
     */
    public function optionsToJson()
    {
        return json_encode($this->options);
    }

    /**
     * Checks if any events have been assigned to the chart.
     *
     * @return bool
     */
    public function hasEvents()
    {
        return count($this->events) > 0 ? true : false;
    }

    /**
     * Checks if any events have been assigned to the chart.
     *
     * @return bool
     */
    public function getEvents()
    {
        return $this->events;
=======
     * @param  \Khill\Lavacharts\Values\Label         $chartLabel Identifying label for the chart.
     * @param  \Khill\Lavacharts\DataTables\DataTable $datatable DataTable used for the chart.
     * @param  \Khill\Lavacharts\Options      $options Options fot the chart.
     * @param  array                                  $config Array of options to set on the chart.
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function __construct(Label $chartLabel, DataTable $datatable, Options $options, $config = [])
    {
        $this->label     = $chartLabel;
        $this->datatable = $datatable;
        $this->events    = new EventManager;

        $options->extend($this->chartDefaults);

        parent::__construct($options, $config);
    }

    /**
     * Returns the chart type.
     *
     * @since 3.0.0
     * @return string
     */
    public function getType()
    {
        return static::TYPE;
    }

    /**
     * Checks if any events have been assigned to the chart.
     *
     * @access public
     * @return bool
     */
    public function hasEvents()
    {
        if (count($this->events) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Retrieves the events if any have been assigned to the chart.
     *
     * @access public
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Returns the chart label.
     *
     * @access public
     * @since  3.0.0
     * @return \Khill\Lavacharts\Values\Label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Register javascript callbacks for specific events.
     *
     * Set with an associative array where the keys are events and the values are the
     * javascript callback functions.
     *
     * Valid events are:
     * [ animationfinish | error | onmouseover | onmouseout | ready | select | statechange ]
     *
     * @access public
     * @param  array $events Array of events associated to a callback
     * @return \Khill\Lavacharts\Charts\Chart
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function events($events)
    {
        if (is_array($events) === false) {
            throw new InvalidConfigValue(
                static::TYPE . '->' . __FUNCTION__,
                'array',
                'who\'s keys are one of '.Utils::arrayToPipedString($this->defaultEvents)
            );
        }

        foreach ($events as $event => $callback) {
            if (Utils::nonEmptyString($callback) === false) {
                throw new InvalidConfigValue(
                    static::TYPE . '->' . __FUNCTION__,
                    'string'
                );
            }

            $this->events->set($event, $callback);
        }

        return $this;
>>>>>>> origin/3.0
    }

    /**
     * Assigns a datatable to use for the Chart.
     *
<<<<<<< HEAD
     * @deprecated
     * @uses   Datatable
     * @param  Datatable $datatable
     * @return self
     */
    public function datatable(Datatable $datatable)
=======
     * @deprecated Apply the DataTable to the chart in the constructor.
     * @access public
     * @param  \Khill\Lavacharts\DataTables\DataTable $datatable
     * @return \Khill\Lavacharts\Charts\Chart
     */
    public function datatable(DataTable $datatable)
>>>>>>> origin/3.0
    {
        $this->datatable = $datatable;

        return $this;
    }

    /**
<<<<<<< HEAD
     * Returns the DataTable if set, false if not set.
     *
     * @since  3.0.0
     * @throws DataTableNotFound
     * @return bool|DataTable
=======
     * Returns the DataTable
     *
     * @access public
     * @since  3.0.0
     * @return \Khill\Lavacharts\DataTables\DataTable
     * @throws \Khill\Lavacharts\Exceptions\DataTableNotFound
>>>>>>> origin/3.0
     */
    public function getDataTable()
    {
        if (is_null($this->datatable)) {
            throw new DataTableNotFound($this);
        }

        return $this->datatable;
    }

    /**
     * Returns a JSON string representation of the datatable.
     *
<<<<<<< HEAD
     * @since  2.5.0
     * @throws DataTableNotFound
=======
     * @access public
     * @since  2.5.0
     * @throws \Khill\Lavacharts\Exceptions\DataTableNotFound
>>>>>>> origin/3.0
     * @return string
     */
    public function getDataTableJson()
    {
<<<<<<< HEAD
        return $this->getDataTable()->toJson();
    }

    /**
     * Set the animation options for a chart
     *
     * @param  Animation $animation Animation config object
     * @return self
     */
    public function animation(Animation $animation)
    {
        return $this->addOption($animation->toArray());
    }

    /**
     * The background color for the main area of the chart. Can be either a simple
     * HTML color string, for example: 'red' or '#00cc00', or a backgroundColor object
     *
     * @uses  BackgroundColor
     * @param BackgroundColor $backgroundColor
     *
     * @return self
     */
    public function backgroundColor(BackgroundColor $backgroundColor)
    {
        return $this->addOption($backgroundColor->toArray());
=======
        return json_encode($this->getDataTable());
    }

    /**
     * Outputs the chart javascript into the page.
     *
     * Pass in a string of the html elementID that you want the chart to be
     * rendered into.
     *
     * @deprecated Use the Lavacharts master object to keep track of charts to render.
     * @codeCoverageIgnore
     * @access public
     * @since  2.0.0
     * @param  string $elemId The id of an HTML element to render the chart into.
     * @return string Javascript code blocks
     * @throws \Khill\Lavacharts\Exceptions\InvalidElementId
     *
     */
    public function render($elemId)
    {
        trigger_error("Rendering directly from charts is deprecated. Use the render method off your main Lavacharts object.", E_USER_DEPRECATED);
        $jsf = new JavascriptFactory;

        return $jsf->getChartJs($this, $elemId);
    }

    /*****************************************************************************************************************
     ** Options
     *****************************************************************************************************************/

    /**
     * Set the animation options for a chart.
     *
     * @access public
     * @param  array $animationConfig Animation options
     * @return \Khill\Lavacharts\Charts\Chart
     */
    public function animation($animationConfig)
    {
        return $this->setOption(__FUNCTION__, new Animation($animationConfig));
    }

    /**
     * The background color for the main area of the chart.
     *
     * Can be a simple HTML color string, or hex code, for example: 'red' or '#00cc00'
     *
     * @access public
     * @param  array $backgroundColorConfig Options for the chart's background color
     * @return \Khill\Lavacharts\Charts\Chart
     */
    public function backgroundColor($backgroundColorConfig)
    {
        return $this->setOption(__FUNCTION__, new BackgroundColor($backgroundColorConfig));
>>>>>>> origin/3.0
    }

    /**
     * An object with members to configure the placement and size of the chart area
     * (where the chart itself is drawn, excluding axis and legends).
<<<<<<< HEAD
     * Two formats are supported: a number, or a number followed by %.
     * A simple number is a value in pixels; a number followed by % is a percentage.
     *
     * @uses  ChartArea
     * @param ChartArea $chartArea
     *
     * @return self
     */
    public function chartArea(ChartArea $chartArea)
    {
        return $this->addOption($chartArea->toArray());
    }

    /**
     * The colors to use for the chart elements. An array of strings, where each
     * element is an HTML color string, for example: colors:['red','#004411'].
     *
     * @param  array              $cArr
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     *
     * @return self
     */
    public function colors($cArr)
    {
        if (Utils::arrayValuesCheck($cArr, 'string') === false) {
            throw $this->invalidConfigValue(
                __FUNCTION__,
=======
     *
     * Two formats are supported: a number, or a number followed by %.
     * A simple number is a value in pixels; a number followed by % is a percentage.
     *
     *
     * @access public
     * @param  array $chartAreaConfig Options for the chart area.
     * @return \Khill\Lavacharts\Charts\Chart
     */
    public function chartArea($chartAreaConfig)
    {
        return $this->setOption(__FUNCTION__, new ChartArea($chartAreaConfig));
    }

    /**
     * The colors to use for the chart elements.
     *
     * An array of strings, where each element is an HTML color string
     * for example:['red','#004411']
     *
     *
     * @access public
     * @param  array $colorArray
     * @return \Khill\Lavacharts\Charts\Chart
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function colors($colorArray)
    {
        if (Utils::arrayValuesCheck($colorArray, 'string') === false) {
            throw new InvalidConfigValue(
                static::TYPE . '->' . __FUNCTION__,
>>>>>>> origin/3.0
                'array',
                'with valid HTML colors'
            );
        }

<<<<<<< HEAD
        return $this->addOption([__FUNCTION__ => $cArr]);
    }

    /**
     * Register javascript callbacks for specific events.
     *
     * Valid values include:
     * [ animationfinish | error | onmouseover | onmouseout | ready | select ]
     * associated to a respective pre-defined javascript function as the callback.
     *
     * @param  array              $e Array of events associated to a callback
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     *
     * @return self
     */
    public function events($e)
    {
        if (is_array($e)) {
            foreach ($e as $event) {
                if (is_subclass_of($event, 'Khill\Lavacharts\Events\Event')) {
                    $this->events[] = $event;
                } else {
                    throw $this->invalidConfigValue(
                        __FUNCTION__,
                        'Event'
                    );
                }
            }
        } else {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'array'
            );
        }

        return $this;
    }

    /**
     * The default font size, in pixels, of all text in the chart. You can
     * override this using properties for specific chart elements.
     *
     * @param  integer                $fontSize
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     *
     * @return self
     */
    public function fontSize($fontSize)
    {
        if (is_int($fontSize) === false) {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'int'
            );
        }

        return $this->addOption([__FUNCTION__ => $fontSize]);
    }

    /**
     * The default font face for all text in the chart. You can override this
     * using properties for specific chart elements.
     *
     * @param  string             $fontName
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     *
     * @return self
     */
    public function fontName($fontName)
    {
        if (Utils::nonEmptyString($fontName) === false) {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'string'
            );
        }

        return $this->addOption([__FUNCTION__ => $fontName]);
=======
        return $this->setOption(__FUNCTION__, $colorArray);
    }

    /**
     * The default font size, in pixels, of all text in the chart.
     *
     * You can override this using properties for specific chart elements.
     *
     *
     * @access public
     * @param  integer $fontSize
     * @return \Khill\Lavacharts\Charts\Chart
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function fontSize($fontSize)
    {
        return $this->setIntOption(__FUNCTION__, $fontSize);
    }

    /**
     * The default font face for all text in the chart.
     *
     * You can override this using properties for specific chart elements.
     *
     *
     * @access public
     * @param  string $fontName
     * @return \Khill\Lavacharts\Charts\Chart
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function fontName($fontName)
    {
        return $this->setStringOption(__FUNCTION__, $fontName);
>>>>>>> origin/3.0
    }

    /**
     * Height of the chart, in pixels.
     *
<<<<<<< HEAD
     * @param  integer                $h
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     *
     * @return self
     */
    public function height($h)
    {
        if (is_int($h) === false) {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'int'
            );
        }

        return $this->addOption([__FUNCTION__ => $h]);
    }

    /**
     * An object with members to configure various aspects of the legend. To
     * specify properties of this object, create a new legend() object, set the
     * values then pass it to this function or to the constructor.
     *
     * @uses   Legend
     * @param  Legend             $legend
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     *
     * @return self
     */
    public function legend(Legend $legend)
    {
        return $this->addOption($legend->toArray());
    }

    /**
     * Outputs the chart javascript into the page
     *
     * Pass in a string of the html elementID that you want the chart to be
     * rendered into.
     *
     * @since  2.0.0
     * @param  string           $elemId The id of an HTML element to render the chart into.
     * @throws InvalidElementId
     *
     * @return string Javscript code blocks
     */
    public function render($elemId)
    {
        $jsf = new JavascriptFactory;

        return $jsf->getChartJs($this, $elemId);
=======
     *
     * @access public
     * @param  int $height
     * @return \Khill\Lavacharts\Charts\Chart
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function height($height)
    {
        return $this->setIntOption(__FUNCTION__, $height);
    }

    /**
     * An object with members to configure various aspects of the legend.
     *
     * To specify properties of this object, pass in an array of valid options.
     *
     *
     * @access public
     * @param  array $legendConfig Options for the chart's legend.
     * @return \Khill\Lavacharts\Charts\Chart
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function legend($legendConfig)
    {
        return $this->setOption(__FUNCTION__, new Legend($legendConfig));
>>>>>>> origin/3.0
    }

    /**
     * Text to display above the chart.
     *
<<<<<<< HEAD
     * @param  string             $title
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     *
     * @return self
     */
    public function title($title)
    {
        if (Utils::nonEmptyString($title) === false) {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'string'
            );
        }

        return $this->addOption([__FUNCTION__ => $title]);
    }

    /**
     * Where to place the chart title, compared to the chart area. Supported values:
     * 'in' - Draw the title inside the chart area.
     * 'out' - Draw the title outside the chart area.
     * 'none' - Omit the title.
     *
     * @param  string             $titlePosition
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     *
     * @return self
=======
     *
     * @access public
     * @param  string $title
     * @return \Khill\Lavacharts\Charts\Chart
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function title($title)
    {
        return $this->setStringOption(__FUNCTION__, $title);
    }

    /**
     * Where to place the chart title, compared to the chart area.
     *
     * Supported values:
     * 'in'   - Draw the title inside the chart area.
     * 'out'  - Draw the title outside the chart area.
     * 'none' - Omit the title.
     *
     *
     * @access public
     * @param  string $titlePosition
     * @return \Khill\Lavacharts\Charts\Chart
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
>>>>>>> origin/3.0
     */
    public function titlePosition($titlePosition)
    {
        $values = [
            'in',
            'out',
            'none'
        ];

<<<<<<< HEAD
        if (in_array($titlePosition, $values, true) === false) {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'string',
                'with a value of '.Utils::arrayToPipedString($values)
            );
        }

        return $this->addOption([__FUNCTION__ => $titlePosition]);
    }

    /**
     * An object that specifies the title text style. create a new textStyle()
     * object, set the values then pass it to this function or to the constructor.
     *
     * @uses   TextStyle
     * @param  TextStyle          $textStyle
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     *
     * @return self
     */
    public function titleTextStyle(TextStyle $textStyle)
    {
        return $this->addOption($textStyle->toArray(__FUNCTION__));
    }

    /**
     * An object with members to configure various tooltip elements. To specify
     * properties of this object, create a new tooltip() object, set the values
     * then pass it to this function or to the constructor.
     *
     * @uses   Tooltip
     * @param  Tooltip            $tooltip
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     *
     * @return self
     */
    public function tooltip(Tooltip $tooltip)
    {
        return $this->addOption($tooltip->toArray());
=======
        return $this->setStringInArrayOption(__FUNCTION__, $titlePosition, $values);
    }

    /**
     * An array of options for defining the title text style.
     *
     * @access public
     * @uses   TextStyle
     * @param  TextStyle $textStyle
     * @return \Khill\Lavacharts\Charts\Chart
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function titleTextStyle($textStyle)
    {
        return $this->setOption(__FUNCTION__, new TextStyle($textStyle));
    }

    /**
     * An object with members to configure various tooltip elements.
     *
     *
     * @param  array $tooltip Options for the tooltips
     * @return \Khill\Lavacharts\Charts\Chart
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function tooltip($tooltip)
    {
        return $this->setOption(__FUNCTION__, new Tooltip($tooltip));
>>>>>>> origin/3.0
    }

    /**
     * Width of the chart, in pixels.
     *
<<<<<<< HEAD
     * @param  integer                $width
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     *
     * @return self
     */
    public function width($width)
    {
        if (is_int($width) === false) {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'int'
            );
        }

        return $this->addOption([__FUNCTION__ => $width]);
    }

    /**
     * function for easy creation of exceptions
     *
     * @return InvalidConfigValue
     */
    protected function invalidConfigValue($func, $type, $extra = '')
    {
        if (! empty($extra)) {
            return new InvalidConfigValue(
                static::TYPE . '::' . $func,
                $type,
                $extra
            );
        } else {
            return new InvalidConfigValue(
                static::TYPE . '::' . $func,
                $type
            );
        }
=======
     * @param  int $width
     * @return \Khill\Lavacharts\Charts\Chart
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function width($width)
    {
        return $this->setIntOption(__FUNCTION__, $width);
>>>>>>> origin/3.0
    }
}
