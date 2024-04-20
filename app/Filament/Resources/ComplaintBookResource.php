<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComplaintBookResource\Pages;
use App\Models\ComplaintBook;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;

class ComplaintBookResource extends Resource
{
    protected static ?string $model = ComplaintBook::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $modelLabel = 'Libro de reclamaciones';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('document_type')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('document_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name_father')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('last_name_mother')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('representative')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('location_district_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('street')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('street_number')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('street_lot')
                    ->maxLength(100)
                    ->default(null),
                Forms\Components\TextInput::make('street_dpto')
                    ->maxLength(100)
                    ->default(null),
                Forms\Components\TextInput::make('urbanization')
                    ->maxLength(100)
                    ->default(null),
                Forms\Components\TextInput::make('reference')
                    ->maxLength(100)
                    ->default(null),
                Forms\Components\TextInput::make('telephone')
                    ->tel()
                    ->maxLength(12)
                    ->default(null),
                Forms\Components\TextInput::make('celphone')
                    ->tel()
                    ->required()
                    ->maxLength(9),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('response_medium')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('is_complaint')
                    ->required(),
                Forms\Components\Textarea::make('reason_description')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('document_type_enum')
                    ->label('Tipo de Doc.')
                    ->badge(),
                Tables\Columns\TextColumn::make('document_number')
                    ->label('Número de Doc.')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fullname')
                    ->label('Nombre o Razón Social')
                    ->searchable(['name', 'last_name_father', 'last_name_mother']),
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
                Action::make('pending')
                    ->label('A pendiente')
                    ->visible(fn (ComplaintBook $record): bool => $record->status === 'IP')
                    ->requiresConfirmation()
                    ->action(function (ComplaintBook $record): void {
                        $record->update(['status' => 'P']);
                    })
                    ->icon('heroicon-m-clock')
                    ->color('danger')
                    ->tooltip('Mover a Pendiente'),
                Action::make('inProgress')
                    ->label('Procesar')
                    ->hidden(fn (ComplaintBook $record): bool => $record->status === 'IP')
                    ->requiresConfirmation()
                    ->action(function (ComplaintBook $record): void {
                        $record->update(['status' => 'IP']);
                    })
                    ->icon('heroicon-m-ellipsis-horizontal')
                    ->color('warning')
                    ->tooltip('Mover a proceso'),
                Action::make('completed')
                    ->label('Completar')
                    ->visible(fn (ComplaintBook $record): bool => $record->status === 'IP')
                    ->requiresConfirmation()
                    ->action(function (ComplaintBook $record): void {
                        $record->update(['status' => 'C']);
                    })
                    ->icon('heroicon-m-check')
                    ->color('success')
                    ->tooltip('Completado'),
                Tables\Actions\ViewAction::make()
                    ->color('info'),
            ])
            ->bulkActions([

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
            'index' => Pages\ListComplaintBooks::route('/'),
            'view' => Pages\ViewComplaintBook::route('/{record}'),
        ];
    }
}
