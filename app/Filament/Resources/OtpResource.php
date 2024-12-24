<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OtpResource\Pages;
use App\Filament\Resources\OtpResource\RelationManagers;
use App\Models\Otp;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OtpResource extends Resource
{
    protected static ?string $model = Otp::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return 'کد یک بار مصرف';
    }

    public static function getPluralModelLabel(): string
    {
        return 'کد های یک بار مصرف';
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('token'),
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('login_id'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('auth_type'),
                Tables\Columns\TextColumn::make('ip'),
                Tables\Columns\TextColumn::make('agent'),
                Tables\Columns\TextColumn::make('used_at')->jalaliDateTime(),
                Tables\Columns\IconColumn::make('expired')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->jalaliDateTime()->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')->jalaliDateTime()->toggleable(isToggledHiddenByDefault: true),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListOtps::route('/')
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }


}
