<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use App\Models\Scopes\UserIdScope;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $recordTitleAttribute = 'title';



    public static function getGloballySearchableAttributes(): array
    {
        return ['title','body'];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)
                                 ->schema([
                                     Forms\Components\Select::make('userId')
                                                            ->searchable()
                                                            ->relationship('user','name',
                                                                fn(Builder $query) => $query->role('client'))
                                                            ->preload()
                                                            ->required(),
                                     Forms\Components\Select::make('category_id')
                                                            ->searchable()
                                                            ->preload()
                                                            ->required()
                                                            ->relationship('category','title'),
                                 ]),
            Forms\Components\Grid::make(1)
                                 ->schema([

                                     Forms\Components\TextInput::make('title'),
                                     Forms\Components\RichEditor::make('body'),
                                     Forms\Components\Toggle::make('active'),
                                     Forms\Components\FileUpload::make('image')
                                                                ->panelLayout('')
                                                                ->directory('uploads/posts')
                                                                ->panelAspectRatio('2:1')
                                                                ->imagePreviewHeight('250')
                                                                ->image()
                                 ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('image')
                                      ->label(__('Image')),
            Tables\Columns\TextColumn::make('title')
                                     ->searchable(),
            Tables\Columns\BadgeColumn::make('user.name')
                                      ->searchable(),
            Tables\Columns\BadgeColumn::make('category.title')
                                      ->searchable(),
            Tables\Columns\ToggleColumn::make('active')
        ])
                     ->filters([
                         Tables\Filters\SelectFilter::make('category')
                                                    ->searchable()
                                                    ->relationship('category','title'),
                         Tables\Filters\SelectFilter::make('user')
                                                    ->searchable()
                                                    ->relationship('user','name',
                                                        fn(Builder $query) => $query->role('client')),
                         Tables\Filters\TernaryFilter::make('active'),
                         Tables\Filters\TrashedFilter::make(),
                     ])
                     ->actions([
                         Tables\Actions\ViewAction::make(),
                         Tables\Actions\EditAction::make(),
                         Tables\Actions\DeleteAction::make(),
                     ])
                     ->bulkActions([
                         Tables\Actions\DeleteBulkAction::make(),
                         Tables\Actions\ForceDeleteBulkAction::make(),
                         Tables\Actions\RestoreBulkAction::make(),
                     ]);
    }

    public static function getRelations(): array
    {
        return [//
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit'   => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
                     ->withoutGlobalScopes([
                         SoftDeletingScope::class,
                     ]);
    }
}
