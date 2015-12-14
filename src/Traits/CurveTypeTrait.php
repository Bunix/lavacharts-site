<?php

namespace Khill\Lavacharts\Traits;

<<<<<<< HEAD
use \Khill\Lavacharts\Utils;

=======
>>>>>>> origin/3.0
trait CurveTypeTrait
{
    /**
     * Controls the curve of the lines when the line width is not zero.
     *
     * Can be one of the following:
     * 'none' - Straight lines without curve.
     * 'function' - The angles of the line will be smoothed.
     *
     * @param  string $curveType Accepted values [none|function]
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     * @return \Khill\Lavacharts\Charts\Chart
     */
    public function curveType($curveType)
    {
        $values = [
            'none',
            'function'
        ];

<<<<<<< HEAD
        if (in_array($curveType, $values, true) === false) {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'string',
                'with a value of '.Utils::arrayToPipedString($values)
            );
        }

        return $this->addOption([__FUNCTION__ => $curveType]);
=======
        return $this->setStringInArrayOption(__FUNCTION__, $curveType, $values);
>>>>>>> origin/3.0
    }
}
