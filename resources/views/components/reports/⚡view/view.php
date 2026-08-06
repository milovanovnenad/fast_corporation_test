<?php

use App\Repositories\UserActivityRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Livewire\Component;

new class extends Component
{
    protected Paginator $activitiesPerDate;
    protected array $invertedActivitiesPerDay;

    public function mount(): void
    {
        $this->activitiesPerDate = UserActivityRepository::fetchSumByDays();
        $this->invertedActivitiesPerDay = array_reverse($this->activitiesPerDate->items());
    }
};
