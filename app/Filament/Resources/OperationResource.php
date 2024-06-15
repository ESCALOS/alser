<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OperationResource\Pages;
use App\Filament\Resources\OperationResource\RelationManagers;
use App\Models\Operation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OperationResource extends Resource
{
    protected static ?string $model = Operation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('transaction_type')
                    ->required(),
                Forms\Components\TextInput::make('amount_to_send')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('amount_to_receive')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('factor')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('account_from_send')
                    ->required()
                    ->maxLength(30),
                Forms\Components\TextInput::make('account_to_receive')
                    ->required()
                    ->maxLength(30),
                Forms\Components\TextInput::make('origin_bank')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('destination_bank')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('transaction_type'),
                Tables\Columns\TextColumn::make('amount_to_send')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_to_receive')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('factor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('account_from_send')
                    ->searchable(),
                Tables\Columns\TextColumn::make('account_to_receive')
                    ->searchable(),
                Tables\Columns\TextColumn::make('origin_bank')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('destination_bank')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListOperations::route('/'),
            'create' => Pages\CreateOperation::route('/create'),
            'view' => Pages\ViewOperation::route('/{record}'),
            'edit' => Pages\EditOperation::route('/{record}/edit'),
        ];
    }
}
