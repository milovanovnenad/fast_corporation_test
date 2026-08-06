<?php

use App\Repositories\UserActivityRepository;
use Livewire\Component;

new class extends Component
{
    public string $label = 'Buy a cow';
    public bool $isActive = true;

    public function byACow(): void
    {
        $this->label = 'thankYou';
        $this->isActive = false;
        UserActivityRepository::store(Auth::user()->id, 'byACow');
    }
};
