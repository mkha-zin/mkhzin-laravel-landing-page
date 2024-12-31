<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\BranchesAndSections;
use App\Filament\Widgets\OffersOverview;
use App\Filament\Widgets\VisitorsMessages;
use Filament\Widgets\TextWidget;

class Dashboard extends \Filament\Pages\Dashboard
{
    public function getWidgets(): array
    {
        return
            [
                OffersOverview::class,
                BranchesAndSections::class,
                VisitorsMessages::class
            ];
    }
}
