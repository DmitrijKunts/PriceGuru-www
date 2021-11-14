<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserTable extends DataTableComponent
{
    use AuthorizesRequests;

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    protected $listeners = ['confirmedDelete', 'updateUser'];

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
            Column::make('Скачиваний', 'lic_download_histories_count')
                ->sortable(),
            Column::make('Действия'),
        ];
    }

    public function query(): Builder
    {
        // dd(User::withCount('licDownloadHistories')->toSql());
        return User::withCount('licDownloadHistories');
    }

    public function bulkActions(): array
    {
        return [
            'deleteSelected'   => "Удалить",
        ];
    }


    public function confirmedDelete($bulk, $data)
    {
        $this->authorize('users-admin');
        User::whereIn('id', $data)->delete();
        if ($bulk) $this->resetAll();
    }

    public function updateUser($user)
    {
        $this->authorize('users-admin');
        User::find($user['id'])->update($user);
    }


    public function deleteSelected($id = null)
    {
        if ($id || count($this->selectedKeys)) {
            $this->emit(
                'openModal',
                'dlg-delete-confirm',
                [
                    'parentName' => $this->getName(),
                    'data' => $this->selectedKeys,
                    'bulk' => true
                ]
            );
        }
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.user_table';
    }
}
