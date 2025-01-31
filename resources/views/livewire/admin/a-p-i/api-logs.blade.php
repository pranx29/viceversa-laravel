<div>
    <h1 class="text-2xl font-bold mb-2 text-primary-foreground">API Logs</h1>
    <p class="text-foreground mb-4">Monitor API usage, response times, errors, and user interactions in real time.</p>

    <div class="mb-4 flex flex-wrap gap-2 w-3/4">
        <x-text-input wire:model.live="searchTerm" type="text" placeholder="Search by endpoint, method, or user ID"
            class="flex-grow" />

        <!-- HTTP Method Filter -->
        <x-select-input wire:model.live="method" id="method">
            <option value="">HTTP Method</option>
            <option value="GET">GET</option>
            <option value="POST">POST</option>
            <option value="PUT">PUT</option>
            <option value="DELETE">DELETE</option>
        </x-select-input>

        <!-- Execution Time Filter -->
        <x-select-input wire:model.live="executionTime" id="executionTime">
            <option value="">Execution Time</option>
            <option value="slowest">Slowest First</option>
            <option value="fastest">Fastest First</option>
        </x-select-input>
    </div>

    <div
        class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-primary/50 shadow-md rounded-lg bg-clip-border">
        <table class="w-full text-left table-auto min-w-max">
            <thead>
                <tr class="border-b border-foreground bg-primary">
                    <th class="p-4 text-sm font-normal leading-none text-foreground">User ID</th>
                    <th class="p-4 text-sm font-normal leading-none text-foreground">Endpoint</th>
                    <th class="p-4 text-sm font-normal leading-none text-foreground">Method</th>
                    <th class="p-4 text-sm font-normal leading-none text-foreground">Status Code</th>
                    <th class="p-4 text-sm font-normal leading-none text-foreground">Execution Time (ms)</th>
                    <th class="p-4 text-sm font-normal leading-none text-foreground">IP Address</th>
                    <th class="p-4 text-sm font-normal leading-none text-foreground">Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                    <tr class="cursor-pointer">
                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">{{ $log->user_id ?? 'N/A' }}
                        </td>
                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">{{ $log->endpoint }}</td>
                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">{{ $log->method }}</td>
                        <td
                            class="p-4 border-b border-foreground text-primary-foreground py-3 {{ $log->status_code >= 200 && $log->status_code < 300 ? 'text-green-500' : ($log->status_code >= 400 ? 'text-yellow-500' : 'text-red-500') }}">
                            {{ $log->status_code }}
                        </td>
                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">{{ $log->execution_time }}
                        </td>
                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">{{ $log->ip_address }}</td>
                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex justify-between items-center px-4 py-3">
            <div class="text-sm text-primary-foreground">
            Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }}
            </div>
            <div>
            {{ $logs->links('pagination::custom') }}
            </div>
        </div>
    </div>
</div>
</div>
