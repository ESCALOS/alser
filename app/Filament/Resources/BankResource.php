<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankResource\Pages;
use App\Models\Bank;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BankResource extends Resource
{
    protected static ?string $model = Bank::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $modelLabel = 'banco';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->unique()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('sol_account_name')
                    ->label('Alias')
                    ->required()
                    ->unique()
                    ->maxLength(255),
                Forms\Components\TextInput::make('sol_account_number')
                    ->label('Cuenta en soles')
                    ->required()
                    ->unique()
                    ->maxLength(255),
                Forms\Components\TextInput::make('dollar_account_name')
                    ->label('Alias')
                    ->required()
                    ->unique()
                    ->maxLength(255),
                Forms\Components\TextInput::make('dollar_account_number')
                    ->label('Cuenta en dólares')
                    ->required()
                    ->unique()
                    ->maxLength(255),
            ])->columns();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sol_account')
                    ->label('Cuenta en soles'),
                Tables\Columns\TextColumn::make('dollar_account')
                    ->label('Cuenta en dólares'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ManageBanks::route('/'),
        ];
    }
}
