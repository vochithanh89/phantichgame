<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogCategoryResource\Pages;
use App\Models\BlogCategory;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BlogCategoryResource extends Resource
{
    protected static ?string $model = BlogCategory::class;

    protected static ?string $label = 'Category';

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Information')
                    ->columnSpan(1)
                    ->schema([
                        TextInput::make('slug')
                            ->placeholder('Auto generate from name')
                            ->unique(ignoreRecord: true),
                        TextInput::make('name')
                            ->maxLength(255)
                            ->required(),
                        Textarea::make('description')
                            ->minLength(50)
                            ->maxLength(255)
                            ->required()
                            ->rows(5),
                        FileUpload::make('thumbnail')
                            ->image()
                            ->imageEditor()
                            ->directory('images/blog_categories')
                            ->visibility('public')
                            ->required()
                            ->optimize('webp'),
                        Select::make('parent_id')
                            ->label('Category Parent')
                            ->options(function (Get $get) {
                                return BlogCategory::where(['parent_id' => null])
                                    ->where('id', '!=' , $get('id'))
                                    ->pluck('name', 'id')
                                    ->toArray();
                            })
                            ->searchable()
                            ->preload(),
                        Grid::make()
                            ->schema([
                                Toggle::make('is_published')->default(true),
                            ])
                    ]
                ),
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
                            ->rows(5),
                    ]
                ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('parent.name')
                    ->default('none')
                    ->sortable(),
                TextColumn::make('meta_name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('description')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('meta_desc')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('thumbnail'),
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
                SelectFilter::make('parent')
                    ->relationship('parent', 'name'),
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
            'index' => Pages\ListBlogCategories::route('/'),
            'create' => Pages\CreateBlogCategory::route('/create'),
            'view' => Pages\ViewBlogCategory::route('/{record}'),
            'edit' => Pages\EditBlogCategory::route('/{record}/edit'),
        ];
    }
}
