<?php

use Filament\Tables\View\TablesRenderHook;
use Filament\View\PanelsRenderHook;

return [
    /**
     * set the default domain.
     */
    'render-hooks' => [
        'list' => PanelsRenderHook::USER_MENU_BEFORE,
        'bookmark_toggle_icon' => TablesRenderHook::TOOLBAR_TOGGLE_COLUMN_TRIGGER_BEFORE,
    ],

    'dropdown' => [
        'title' => 'Bookmarks',
        'icon' => 'heroicon-m-bookmark-square',
        'empty_icon' => 'heroicon-m-bookmark-slash',
    ],

    /**
     * set  the database tables prefix
     */
    'table-prefix' => 'delia_',

    /**
     * you can overwrite any model and use your own
     * you can also configure the model per panel in your panel provider
     * using: ->models([ ... ])
     */
    'models' => [
        'User' => config('auth.providers.users.model'),
        'Bookmark' => \LaraZeus\Delia\Models\Bookmark::class,
    ],
];