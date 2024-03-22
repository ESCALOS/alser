<?php

namespace App\Filament\Resources\ComplaintBookResource\Pages;

use App\Filament\Resources\ComplaintBookResource;
use App\Models\ComplaintBook;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListComplaintBooks extends ListRecords
{
    protected static string $resource = ComplaintBookResource::class;

    public function getTabs(): array
    {
        return [
            'pending' => Tab::make('Pendiente')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'P'))
                ->icon('heroicon-m-clock')
                ->badge(ComplaintBook::query()->where('status', 'P')->count())
                ->badgeColor('danger'),
            'in_progress' => Tab::make('En Progreso')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'IP'))
                ->icon('heroicon-m-ellipsis-horizontal')
                ->badge(ComplaintBook::query()->where('status', 'IP')->count())
                ->badgeColor('warning'),
            'completed' => Tab::make('Completado')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'C'))
                ->icon('heroicon-m-check'),
        ];
    }
}
