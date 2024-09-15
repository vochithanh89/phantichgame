<?php

namespace App\Filament\Resources\BlogCategoryResource\Pages;

use App\Filament\Resources\BlogCategoryResource;
use App\Models\BlogCategory;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Support\Enums\Alignment;

class ViewBlogCategory extends ViewRecord
{
    protected static string $resource = BlogCategoryResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->getRecord())
            ->schema([
                Actions::make([
                    // Action::make('delete')
                    //     ->requiresConfirmation()
                    //     ->action(fn (BlogCategory $record) => $record->delete())
                    //     ->successRedirectUrl(BlogCategoryResource::getUrl('index'))
                    //     ->color('danger'),
                    Action::make('edit')
                        ->url(fn (BlogCategory $record): string => BlogCategoryResource::getUrl('edit', ['record' => $record]))
                        ->button(),
                ])->alignment(Alignment::End)->columnSpanFull(),
                Tabs::make('Tabs')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Information')
                            ->schema([
                                TextEntry::make('name'),
                                TextEntry::make('slug'),
                                TextEntry::make('description')->columnSpanFull(),
                                ImageEntry::make('thumbnail')->columnSpanFull(),
                                TextEntry::make('parent.name')->default('none'),
                                TextEntry::make('is_published')->columnSpanFull(),
                                TextEntry::make('created_at')
                                    ->since()
                                    ->tooltip(function (TextEntry $component): ?string {
                                        $state = $component->getState();
                                        return $state;
                                    }),
                                TextEntry::make('updated_at')
                                    ->since()
                                    ->tooltip(function (TextEntry $component): ?string {
                                        $state = $component->getState();
                                        return $state;
                                    })
                            ])
                            ->columns(2),
                        Tab::make('SEO')
                            ->schema([
                                TextEntry::make('meta_name'),
                                TextEntry::make('meta_desc'),
                            ]),
                        Tab::make('Activity Logs')
                            ->schema([
                                RepeatableEntry::make('logs')->label(false)
                                    ->schema([
                                        KeyValueEntry::make('properties.old')->label('Old'),
                                        KeyValueEntry::make('properties.attributes')->label('New'),
                                        TextEntry::make('causer.name')->label('Causer'),
                                        TextEntry::make('event')->label('Event'),
                                    ])->columns(2),
                            ])
                    ]),
            ]);
    }

}
