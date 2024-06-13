<?php

namespace App\Filament\Resources;

use App\Enums\AccountTypeEnum;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $modelLabel = 'usuario';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('two_factor_secret')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('two_factor_recovery_codes')
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('two_factor_confirmed_at'),
                Forms\Components\TextInput::make('current_team_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('profile_photo_path')
                    ->maxLength(2048)
                    ->default(null),
                Forms\Components\TextInput::make('account_type')
                    ->required(),
                Forms\Components\Toggle::make('is_admin')
                    ->required(),
                Forms\Components\TextInput::make('celphone')
                    ->tel()
                    ->maxLength(20)
                    ->default(null),
                Forms\Components\TextInput::make('document_type'),
                Forms\Components\TextInput::make('document_number')
                    ->maxLength(12)
                    ->default(null),
                Forms\Components\TextInput::make('identity_document_status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fullname')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('account_type')
                    ->label('Tipo de Cuenta')
                    ->badge(),
                Tables\Columns\TextColumn::make('celphone')
                    ->label('Celular'),
                Tables\Columns\TextColumn::make('document_type')
                    ->label('Tipo de Doc.')
                    ->badge(),
                Tables\Columns\TextColumn::make('document_number')
                    ->label('# de Doc.')
                    ->searchable(),
                ImageColumn::make('front')
                    ->label('Lado Frontal')
                    ->disk('s3')
                    ->defaultImageUrl(fn (User $record): string => url(route('image.identity-document-by-user', ['type' => 'front', 'userId' => $record->id])))
                    ->simpleLightbox(),
                ImageColumn::make('back')
                    ->label('Lado Posterior')
                    ->disk('s3')
                    ->defaultImageUrl(fn (User $record): string => url(route('image.identity-document-by-user', ['type' => 'back', 'userId' => $record->id])))
                    ->simpleLightbox(),
                Tables\Columns\TextColumn::make('Fecha de solicitud')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Data')
                            ->label(fn (User $user) => $user->isPersonalAccount() ? 'Datos Generales' : 'Datos de la Empresa')
                            ->schema([
                                TextEntry::make('fullname')
                                    ->label(fn (User $user) => $user->isBusinessAccount() ? 'Razón Social' : 'Nombres y Apellidos')
                                    ->columnSpan(fn (User $user) => $user->isPersonalAccount() ? 2 : 1),
                                TextEntry::make('document_type')
                                    ->label('Tipo de documento')
                                    ->badge()
                                    ->visible(fn (User $user) => $user->isPersonalAccount()),
                                TextEntry::make('document_number')
                                    ->label(fn (User $user) => $user->isPersonalAccount() ? '# de Documento' : 'RUC'),
                                Grid::make()
                                    ->schema([
                                        TextEntry::make('personalAccount.country.name')
                                            ->label('Nacionalidad'),
                                        TextEntry::make('celphone')
                                            ->label('Celular'),
                                        IconEntry::make('pep')
                                            ->label('¿Es PEP?')
                                            ->boolean(),
                                        IconEntry::make('wife_pep')
                                            ->label('¿Esposa PEP?')
                                            ->boolean(),
                                        IconEntry::make('relative_pep')
                                            ->label('¿Familiar PEP?')
                                            ->boolean(),
                                    ])->visible(fn (User $user) => $user->isPersonalAccount()),
                            ])
                            ->columns(2),
                        Tabs\Tab::make('Representante Legal')
                            ->schema([
                                TextEntry::make('legalRepresentative.fullname')
                                    ->label('Nombres y Apellidos'),
                                TextEntry::make('legalRepresentative.representation_type')
                                    ->label('Tipo de representación')
                                    ->badge(),
                                TextEntry::make('legalRepresentative.document_type')
                                    ->label('Tipo de documento')
                                    ->badge(),
                                TextEntry::make('legalRepresentative.document_number')
                                    ->label('# de Documento'),
                                TextEntry::make('legalRepresentative.country.name')
                                    ->label('Nacionalidad'),
                                TextEntry::make('celphone')
                                    ->label('Celular'),
                                IconEntry::make('legalRepresentative.is_PEP')
                                    ->label('¿Es PEP?')
                                    ->boolean(),
                                IconEntry::make('legalRepresentative.wife_is_PEP')
                                    ->label('¿Esposa PEP?')
                                    ->boolean(),
                                IconEntry::make('legalRepresentative.relative_is_PEP')
                                    ->label('¿Familiar PEP?')
                                    ->boolean(),
                            ])->columns(2)
                            ->visible(fn (User $user): bool => $user->account_type === AccountTypeEnum::BUSINESS),
                        Tabs\Tab::make('ShareHolders')
                            ->label('Accionistas')
                            ->schema([
                                RepeatableEntry::make('shareHolders')
                                    ->schema([
                                        TextEntry::make('fullname'),
                                        TextEntry::make('document_type'),
                                        TextEntry::make('document_number')
                                            ->columnSpan(2),
                                    ])
                                    ->columns(2),
                            ])->columns(2)
                            ->visible(fn (User $user): bool => $user->account_type === AccountTypeEnum::BUSINESS),
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
            'index' => Pages\ListUsers::route('/'),
            // 'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
