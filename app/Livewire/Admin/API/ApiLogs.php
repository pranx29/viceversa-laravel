<?php

namespace App\Livewire\Admin\API;

use Livewire\Component;
use Livewire\WithPagination;

class ApiLogs extends Component
{
    use WithPagination;

    public $searchTerm = '';
    public $method = '';
    public $executionTime = '';
    public $userId = '';

    protected $queryString = [
        'searchTerm' => ['except' => ''],
        'method' => ['except' => ''],
        'executionTime' => ['except' => ''],
    ];

    public function render()
    {
        $query = \App\Models\ApiLog::query();

        // Filter by search term
        if ($this->searchTerm) {
            $query->where('endpoint', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('method', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('user_id', 'like', '%' . $this->searchTerm . '%');
        }

        // Filter by method
        if ($this->method) {
            $query->where('method', $this->method);
        }

        // Filter by execution time
        if ($this->executionTime) {
            $query->orderBy('execution_time', $this->executionTime === 'slowest' ? 'desc' : 'asc');
        }

        $logs = $query->paginate(10);

        return view('livewire.admin.a-p-i.api-logs', [
            'logs' => $logs,
        ]);
    }

}
