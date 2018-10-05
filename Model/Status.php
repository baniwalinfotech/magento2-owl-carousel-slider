<?php

namespace Baniwal\OwlCarouselSlider\Model;

/**
 * Status
 * @category Baniwal
 * @package  Baniwal_OwlCarouselSlider
 * @module   OwlCarouselSlider
 * @author   Baniwal Developer
 */
class Status
{
    const STATUS_ENABLED  = 1;
    const STATUS_DISABLED = 0;

    /**
     * Retrieve available statuses.
     *
     * @return []
     */
    public function getAllAvailableStatuses()
    {
        return [
            self::STATUS_ENABLED  => __('Enabled'),
            self::STATUS_DISABLED => __('Disabled'),
        ];
    }
}
