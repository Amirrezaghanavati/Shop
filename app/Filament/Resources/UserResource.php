<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class UserResource extends Resource
{
    protected static ?string $model = User::class;


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return 'کاربر';
    }

    public static function getPluralModelLabel(): string
    {
        return 'کاربران';
    }



    public static function form(Form $form): Form
    {
        return $form->schema([
                Forms\Components\Section::make(__('Login information'))
                    ->schema([
                        Forms\Components\Split::make([
                            Forms\Components\Group::make([
//                                Forms\Components\Select::make('roles')->relationship('roles', 'name')->multiple()->preload(),
                                Forms\Components\FileUpload::make('avatar_url')->inlineLabel()->avatar()->image()->imageEditor(),
                                Forms\Components\TextInput::make('name')->inlineLabel()->required(),
                                Forms\Components\TextInput::make('email')->inlineLabel()->required()->email()->unique('users', 'email', ignoreRecord: true),
                                Forms\Components\TextInput::make('mobile')->inlineLabel()->required()->unique('users', 'mobile', ignoreRecord: true),
//                                Forms\Components\Placeholder::make('password')->inlineLabel()->content(new HtmlString('<a href="' . MyProfilePage::getUrl() . '" class="text-primary-600 dark:text-primary-400">تغییر کلمه عبور</a>'))
//                                    ->visible(fn(string $operation, ?User $record) => ($operation == 'edit' && $record->id == auth()->id())),

                                Forms\Components\TextInput::make('password')
                                    ->inlineLabel()
                                    ->live()
                                    ->password()
                                    ->revealable()
                                    ->confirmed(),
                                Forms\Components\TextInput::make('password_confirmation')
                                    ->inlineLabel()
                                    ->live()
                                    ->password()
                                    ->revealable(),
//                                Forms\Components\Radio::make('role')->options(UserRole::class)->inlineLabel()->default(UserRole::USER),
                            ]),
                            Forms\Components\Group::make([
                                Forms\Components\Placeholder::make('ip')->inlineLabel()->content(fn(?User $record) => $record?->ip ?? request()->ip()),
                                Forms\Components\Placeholder::make('agent')->inlineLabel()->content(fn(?User $record) => $record?->agent ?? request()->userAgent()),
                                Forms\Components\Placeholder::make('last_login')->inlineLabel()->content(fn(?User $record) =>$record?->last_login),
                                Forms\Components\Checkbox::make('must_password_reset')->reactive()->afterStateUpdated(function (Forms\Set $set) {
                                    $set('can_password_reset', false);
                                    $set('password_expires', false);
                                })->hint(new HtmlString(Blade::render('<x-filament::loading-indicator wire:loading wire:target="data.must_password_reset, data.can_password_reset, data.can_password_expires" class="h-5 w-5"/>'))),
                                Forms\Components\Checkbox::make('can_password_reset')->reactive()->afterStateUpdated(fn(Forms\Set $set, $state) => $set('must_password_reset', false)),
                                Forms\Components\Checkbox::make('password_expires')->reactive()->afterStateUpdated(fn(Forms\Set $set, $state) => $set('must_password_reset', false))
                            ])
                        ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('mobile')->searchable(),
                Tables\Columns\TextColumn::make('mobile_verified_at')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('role'),
                Tables\Columns\TextColumn::make('ip')->searchable(),
                Tables\Columns\TextColumn::make('agent')->searchable(),
                Tables\Columns\TextColumn::make('last_login')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('banned_until')->dateTime()->sortable(),
                Tables\Columns\IconColumn::make('status')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
