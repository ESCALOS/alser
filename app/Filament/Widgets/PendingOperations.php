<?php

namespace App\Filament\Widgets;

use App\Enums\OperationStatusEnum;
use App\Filament\Resources\OperationResource;
use App\Models\Operation;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PendingOperations extends BaseWidget
{
    protected static ?string $heading = 'Operaciones pendientes';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Operation::where('status', OperationStatusEnum::UPLOADED))
            ->columns([
                TextColumn::make('user.document_number')
                    ->searchable()
                    ->label('# de Documento'),
                TextColumn::make('user.fullname')
                    ->searchable()
                    ->label('Usuario'),
                TextColumn::make('transaction_type')
                    ->label('Tipo de Transacción')
                    ->badge(),
                TextColumn::make('amount_to_send')
                    ->label('Monto recibido')
                    ->numeric(decimalPlaces: 2)
                    ->prefix(fn (Operation $operation) => $operation->isPurchase() ? '$ ' : 'S/. '),
                TextColumn::make('amount_to_receive')
                    ->label('Monto a enviar')
                    ->numeric(decimalPlaces: 2)
                    ->prefix(fn (Operation $operation) => $operation->isPurchase() ? 'S/. ' : '$ '),
                TextColumn::make('factor')
                    ->label('Tasa de cambio')
                    ->numeric(decimalPlaces: 4),
            ])
            ->actions([
                ViewAction::make()
                    ->color('info')
                    ->url(fn (Operation $operation): string => OperationResource::getUrl('view', ['record' => $operation]))
                    ->openUrlInNewTab(),
            ])
            ->poll('10s');
    }
}
