<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use STS\FilamentImpersonate\Impersonate;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';
    protected static ?string $recordTitleAttribute = 'email';

    public static function getGloballySearchableAttributes(): array
    {
        return ['name','email'];
    }

    public static function getPluralLabel(): string
    {
        return trans('filament-user::user.resource.label');
    }

    public static function getLabel(): string
    {
        return trans('filament-user::user.resource.single');
    }

    public static function form(Form $form): Form
    {
        $rows = [
            TextInput::make('name')
                     ->required()
                     ->label(trans('filament-user::user.resource.name')),
            TextInput::make('email')
                     ->email()
                     ->required()
                     ->label(trans('filament-user::user.resource.email')),
            Forms\Components\TextInput::make('password')
                                      ->label(trans('filament-user::user.resource.password'))
                                      ->password()
                                      ->maxLength(255)
                                      ->dehydrateStateUsing(static function ($state) use ($form) {
                                          if (!empty($state)) {
                                              return Hash::make($state);
                                          }

                                          $user = User::find($form->getColumns());
                                          if ($user) {
                                              return $user->password;
                                          }
                                      }),
        ];

        if (config('filament-user.shield')) {
            $rows[] = Forms\Components\Select::make('roles')
                                             ->multiple(true)
                                             ->relationship('roles','name')
                                             ->preload()
                                             ->label(trans('filament-user::user.resource.roles'));
        }

        $form->schema(Forms\Components\Grid::make(1)
                                           ->schema($rows));

        return $form;
    }

    public static function table(Table $table): Table
    {
        $table->columns([
                TextColumn::make('id')
                          ->sortable()
                          ->label(trans('filament-user::user.resource.id')),
                TextColumn::make('name')
                          ->sortable()
                          ->searchable()
                          ->label(trans('filament-user::user.resource.name')),
                TextColumn::make('email')
                          ->sortable()
                          ->searchable()
                          ->label(trans('filament-user::user.resource.email')),
                Tables\Columns\BadgeColumn::make('posts_count')
                                          ->counts('posts'),
                Tables\Columns\BadgeColumn::make('roles.name'),
                Tables\Columns\TextColumn::make('created_at')
                                         ->label(trans('filament-user::user.resource.created_at'))
                                         ->dateTime('M j, Y')
                                         ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                                         ->label(trans('filament-user::user.resource.updated_at'))
                                         ->dateTime('M j, Y')
                                         ->sortable(),

            ])
              ->filters([
                  Tables\Filters\Filter::make('verified')
                                       ->label(trans('filament-user::user.resource.verified'))
                                       ->query(fn(Builder $query
                                       ): Builder => $query->whereNotNull('email_verified_at')),
                  Tables\Filters\Filter::make('unverified')
                                       ->label(trans('filament-user::user.resource.unverified'))
                                       ->query(fn(Builder $query): Builder => $query->whereNull('email_verified_at')),
                  Tables\Filters\SelectFilter::make('roles')->multiple()->relationship('roles','name')
              ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);

        if (config('filament-user.impersonate')) {
            $table->prependActions([
                Impersonate::make('impersonate'),
            ]);
        }

        return $table;
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationLabel(): string
    {
        return trans('filament-user::user.resource.label');
    }

    protected function getTitle(): string
    {
        return trans('filament-user::user.resource.title.resource');
    }
}
