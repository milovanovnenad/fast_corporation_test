<?php

use App\Repositories\UserActivityRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;

new class extends Component
{
    protected LengthAwarePaginator $actions;

    public string $date = '';
    public string $name = '';
    public string $action = '';

    public function search(): void
    {
        $this->mount();
    }

    public function mount(): void
    {
        $this->actions = UserActivityRepository::fetch($this->date, $this->name, $this->action);
    }
};
