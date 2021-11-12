<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class UserTable extends DataTableComponent
{

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public $showConfirmation = false;

    public function columns(): array
    {
        return [
            Column::make('Имя', 'name')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
            Column::make('Дата регистрации', 'created_at')
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return User::query();
    }

    public function bulkActions(): array
    {

        return [
            'deleteSelected'   => "Удалить",
        ];
    }

    public function closeConfirmation()
    {
        $this->showConfirmation = false;
    }

    public function deleteSelected()
    {
        if (count($this->selectedKeys)) {
            $this->showConfirmation = true;
            // User::whereIn('id',$this->selectedKeys)->delete();
        }
    }
    public function delete()
    {
        if (count($this->selectedKeys)) {
            User::whereIn('id', $this->selectedKeys)->delete();
            $this->showConfirmation = false;
        }
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.user_table';
    }
}
