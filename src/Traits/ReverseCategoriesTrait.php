<?php

namespace Khill\Lavacharts\Traits;

trait ReverseCategoriesTrait
{
    /**
     * If set to true, will draw series from bottom to top.
     *
     * The default is to draw top-to-bottom.
     *
     * @param  boolean $reverseCategories
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     * @return \Khill\Lavacharts\Charts\Chart
     */
    public function reverseCategories($reverseCategories)
    {
        if (is_bool($reverseCategories) === false) {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'bool'
            );
        }

        return $this->addOption([__FUNCTION__ => $reverseCategories]);
    }
}
