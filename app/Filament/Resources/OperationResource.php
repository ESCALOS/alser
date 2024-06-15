<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OperationResource\Pages;
use App\Models\Operation;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OperationResource extends Resource
{
    protected static ?string $model = Operation::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';

    protected static ?string $modelLabel = 'Operaciones';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('user.fullname')
                    ->label('Usuario'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.fullname')
                    ->label('Usuario')
                    ->searchable(),
                Tables\Columns\TextColumn::make('transaction_type')
                    ->label('Tipo de transacción')
                    ->badge(),
                Tables\Columns\TextColumn::make('amount_to_send')
                    ->label('Monto recibido')
                    ->numeric(decimalPlaces: 2)
                    ->prefix(fn (Operation $operation) => $operation->isPurchase() ? '$ ' : 'S/. '),
                Tables\Columns\TextColumn::make('amount_to_receive')
                    ->label('Monto a enviar')
                    ->numeric(decimalPlaces: 2)
                    ->prefix(fn (Operation $operation) => $operation->isPurchase() ? 'S/. ' : '$ '),
                Tables\Columns\TextColumn::make('factor')
                    ->label('Tasa de cambio')
                    ->numeric(decimalPlaces: 4),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->color('info')
                    ->openUrlInNewTab(),
            ])
            ->poll('10s');
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
            'index' => Pages\ListOperations::route('/'),
            'view' => Pages\ViewOperation::route('/{record}'),
        ];
    }
}
