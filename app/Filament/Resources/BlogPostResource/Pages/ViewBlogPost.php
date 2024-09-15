<?php

namespace App\Filament\Resources\BlogPostResource\Pages;

use App\Filament\Resources\BlogPostResource;
use App\Filament\Resources\BlogCategoryResource;
use App\Models\BlogPost;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\SpatieTagsEntry;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\VerticalAlignment;

class ViewBlogPost extends ViewRecord
{
    protected static string $resource = BlogPostResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->getRecord())
            ->schema([
                Actions::make([
                    // Action::make('delete')
                    //     ->requiresConfirmation()
                    //     ->action(fn (BlogPost $record) => $record->delete())
                    //     ->successRedirectUrl(BlogPostResource::getUrl('index'))
                    //     ->color('danger'),
                    Action::make('edit')
                        ->url(fn (BlogPost $record): string => BlogPostResource::getUrl('edit', ['record' => $record]))
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
                                TextEntry::make('category.name'),
                                TextEntry::make('is_published')->columnSpanFull(),
                                TextEntry::make('is_priority')->columnSpanFull(),
                                TextEntry::make('is_trending')->columnSpanFull(),
                                SpatieTagsEntry::make('tags')->columnSpanFull(),
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
                        Tab::make('Content')
                            ->schema([
                                TextEntry::make('content')
                                    ->html()
                                    ->label(false)
                                    ->formatStateUsing(function (string $state): string {
                                        return "<div class=\"content\" >$state</div>";
                                    }),
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
