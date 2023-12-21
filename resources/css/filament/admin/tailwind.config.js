import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        "./app/Filament/**/*.php",
        "./resources/views/filament/**/*.blade.php",
        "./app/Livewire/**/*.php",
        "./resources/views/livewire/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
    ],
};