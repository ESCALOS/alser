<?php

namespace App\Filament\Resources;

use App\Enums\IdentityDocumentStatusEnum;
use App\Filament\Resources\ValidateIdentityDocumentResource\Pages;
use App\Models\PersonalAccount;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ValidateIdentityDocumentResource extends Resource
{
    protected static ?string $model = PersonalAccount::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';

    protected static ?string $modelLabel = 'Validar documento';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.document_number')
                    ->label('N° Documento'),
                TextColumn::make('user.name')
                    ->label('Nombres')
                    ->searchable(),
                TextColumn::make('first_surname')
                    ->label('Apellidos')
                    ->formatStateUsing(fn (PersonalAccount $record) => $record->first_surname.' '.$record->second_surname)
                    ->searchable(),
                ImageColumn::make('front')
                    ->label('Lado Frontal')
                    ->disk('s3')
                    ->defaultImageUrl(fn (PersonalAccount $record): string => url(route('image.identity-document-by-user', ['type' => 'front', 'userId' => $record->user->id])))
                    ->simpleLightbox(),
                ImageColumn::make('back')
                    ->label('Lado Posterior')
                    ->disk('s3')
                    ->defaultImageUrl(fn (PersonalAccount $record): string => url(route('image.identity-document-by-user', ['type' => 'back', 'userId' => $record->user->id])))
                    ->simpleLightbox(),
                TextColumn::make('pdf_url')
                    ->simpleLightbox('http://localhost/pdfs/prueba.docx'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('validate')
                    ->label('Validar')
                    ->visible(fn (PersonalAccount $record): bool => $record->identity_document_status === IdentityDocumentStatusEnum::UPLOADED)
                    ->requiresConfirmation()
                    ->modalHeading('¿Desea validar el documento?')
                    ->modalDescription('Esta acción es irreversible')
                    ->action(function (PersonalAccount $record): void {
                        $record->update(['identity_document_status' => 3]);
                    })
                    ->icon('heroicon-m-check')
                    ->color('success')
                    ->tooltip('Validar documento'),
                Action::make('reject')
                    ->label('Rechazar')
                    ->visible(fn (PersonalAccount $record): bool => $record->identity_document_status === IdentityDocumentStatusEnum::UPLOADED)
                    ->requiresConfirmation()
                    ->modalHeading('¿Desea rechazar el documento?')
                    ->modalDescription('Esta acción es irreversible')
                    ->action(function (PersonalAccount $record): void {
                        $record->update(['identity_document_status' => 4]);
                    })
                    ->icon('heroicon-m-x-mark')
                    ->color('danger')
                    ->tooltip('Rechazar documento'),
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
            'index' => Pages\ListValidateIdentityDocuments::route('/'),
        ];
    }
}
