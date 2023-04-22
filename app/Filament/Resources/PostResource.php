<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
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

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(1)->schema([
                Forms\Components\TextInput::make('title'),
                Forms\Components\RichEditor::make('body'),
                Forms\Components\FileUpload::make('image')
                                            ->panelLayout('')
                                           ->image()
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('image')
                                      ->label(__('Image'))
        ])
                     ->filters([
                         Tables\Filters\TrashedFilter::make(),
                     ])
                     ->actions([
                         Tables\Actions\EditAction::make(),
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
