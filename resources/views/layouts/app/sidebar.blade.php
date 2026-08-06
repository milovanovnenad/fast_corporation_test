<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky collapsible="mobile" class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            <flux:spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item href="{{ route('a') }}" wire:navigate>
                    {{ __('A') }}
                </flux:sidebar.item>

                <flux:sidebar.item href="{{ route('b') }}" wire:navigate>
                    {{ __('B') }}
                </flux:sidebar.item>
                @if(auth()->user()->isAdmin())
                <flux:sidebar.item href="{{ route('statistics') }}" wire:navigate>
                    {{ __('Statistics') }}
                </flux:sidebar.item>

                <flux:sidebar.item href="{{ route('reports') }}" wire:navigate>
                    {{ __('Reports') }}
                </flux:sidebar.item>
                @endif
            </flux:sidebar.nav>

            <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
        </flux:sidebar>

        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
