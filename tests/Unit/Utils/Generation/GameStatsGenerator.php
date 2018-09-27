<?php

namespace App\Tests\Unit\Utils\Generation;

abstract class GameStatsGenerator {

    // índices ordenados por el valor de sus estadísticas
    const STATS_RANK_1 = 1;
    const STATS_RANK_2 = 2;
    const STATS_RANK_3 = 3;
    const STATS_RANK_4 = 4;

    protected $stats;

    public function getStats($index) {
        assert(is_numeric($index) && $index > 0);

        if (isset($this->stats[$index - 1])) {
            return $this->stats[$index - 1];
        }

        return null;
    }
}