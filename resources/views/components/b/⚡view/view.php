<?php

use App\Repositories\UserActivityRepository;
use Livewire\Component;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

new class extends Component
{
    public function download(): BinaryFileResponse
    {
        UserActivityRepository::store(Auth::user()->id, 'Download');

        return response()->download(
            'sublime_text_build_4200_x64_setup.exe', 'sublime_text_build_4200_x64_setup.exe'
        );
    }
};
