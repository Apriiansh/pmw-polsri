<?php

namespace App\Services;

use App\Models\PmwPeriodModel;
use App\Models\PmwScheduleModel;

class PmwPhaseAccessService
{
    private PmwPeriodModel $periodModel;
    private PmwScheduleModel $scheduleModel;

    public function __construct()
    {
        $this->periodModel = new PmwPeriodModel();
        $this->scheduleModel = new PmwScheduleModel();
    }

    public function getActivePeriod(): ?array
    {
        return $this->periodModel->getActive();
    }

    public function getPhaseForActivePeriod(int $phaseNumber): ?array
    {
        $active = $this->getActivePeriod();
        if (!$active) {
            return null;
        }

        return $this->scheduleModel->getByPeriodAndPhase((int) $active['id'], $phaseNumber);
    }

    public function isPhaseOpenForActivePeriod(int $phaseNumber): bool
    {
        $active = $this->getActivePeriod();
        if (!$active) {
            return false;
        }

        $phase = $this->scheduleModel->getByPeriodAndPhase((int) $active['id'], $phaseNumber);
        if (!$phase) {
            return false;
        }

        return $this->isPhaseOpen($phase);
    }

    public function isPhaseOpen(?array $phase): bool
    {
        if (!$phase) {
            return false;
        }

        if (empty($phase['start_date']) || empty($phase['end_date'])) {
            return false;
        }

        $now = date('Y-m-d');

        return ($now >= $phase['start_date'] && $now <= $phase['end_date']);
    }
}
