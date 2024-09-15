<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $label = 'Post';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Information')
                    ->columnSpan(1)
                    // ->columns(2)
                    ->schema([
                        TextInput::make('slug')
                            ->placeholder('Auto generate from name')
                            ->unique(ignoreRecord: true),
                        TextInput::make('name')
                            ->minLength(20)
                            ->maxLength(255)
                            ->required(),
                        Textarea::make('description')
                            ->required()
                            ->minLength(50)
                            ->maxLength(255)
                            ->rows(5),
                        Select::make('category_id')
                            ->label('Category')
                            ->options(BlogCategory::all()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),
                        FileUpload::make('thumbnail')
                            ->image()
                            ->imageEditor()
                            ->directory('images/blog_posts')
                            ->visibility('public')
                            ->required()
                            ->optimize('webp'),                     
                    ]),
                Section::make('SEO')
                    ->columnSpan(1)
                    ->schema([
                        TextInput::make('meta_name')
                            ->minLength(20)
                            ->maxLength(100)
                            ->required(),
                        Textarea::make('meta_desc')
                            ->minLength(50)
                            ->maxLength(190)
                            ->required()
                            ->columnSpanFull()
                            ->rows(5),
                        SpatieTagsInput::make('tags'),
                    ]),
                
                Section::make('Content')
                    ->schema([
                        TinyEditor::make('content')->columnSpanFull()->minHeight(500)->label(''),
                    ]),

                Section::make('Options')
                    ->schema([
                        Toggle::make('is_trending')->default(false),
                        Toggle::make('is_priority')->default(false),
                        Toggle::make('is_published')->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('category.name')
                    ->sortable(),
                TextColumn::make('author.name')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('thumbnail'),
                TextColumn::make('description')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('like_count')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('view_count')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                // SpatieTagsColumn::make('tags'),
                ToggleColumn::make('is_trending'),
                ToggleColumn::make('is_priority'),
                ToggleColumn::make('is_published'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('is_published')->query(fn (Builder $query): Builder => $query->where('is_published', true))->label('Published'),
                Filter::make('is_priority')->query(fn (Builder $query): Builder => $query->where('is_priority', true))->label('Priority'),
                Filter::make('is_trending')->query(fn (Builder $query): Builder => $query->where('is_trending', true))->label('Trending'),
                SelectFilter::make('category')
                    ->relationship('category', 'name'),
                SelectFilter::make('author')
                    ->relationship('author', 'name')
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'view' => Pages\ViewBlogPost::route('/{record}'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }    
}
