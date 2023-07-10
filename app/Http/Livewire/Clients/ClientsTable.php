<?php

namespace App\Http\Livewire\Clients;

use Livewire\Component;

use App\Models\institutions;


use Livewire\WithFileUploads;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;


class ClientsTable extends LivewireDatatable
{
    use WithFileUploads;

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {

        return institutions::query();


    }


    public function columns(): array
    {
        return [

            Column::name('NAME')
                ->label('Client Name'),

            Column::name('CHANNELS')
                ->label('Client Channels'),

            Column::name('STATUS')
                ->label('Client Status'),




        ];
    }


}
