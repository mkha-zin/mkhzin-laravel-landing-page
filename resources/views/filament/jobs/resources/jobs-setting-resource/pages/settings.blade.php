<x-filament-panels::page>
    {{ $this->form }}

    <x-filament::button wire:click="save" class="mt-4">
        {{ __('dashboard.update settings') }}
    </x-filament::button>
</x-filament-panels::page>
