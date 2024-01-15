<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class Map extends Widget
{
    protected static string $view = 'filament.widgets.map';

    protected int | string | array $columnSpan = 'full';


}
