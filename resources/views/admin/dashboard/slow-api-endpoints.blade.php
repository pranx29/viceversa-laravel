<div class="shadow-md rounded-lg mt-8">
    <h2 class="text-2xl font-bold text-primary-foreground mb-2">Slow API Endpoints</h2>
    <div
        class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-primary/50 shadow-md rounded-lg bg-clip-border">
        <table class="w-full text-left table-auto min-w-max">
            <thead>
                <tr class="border-b border-foreground bg-primary">
                    <th class="p-4 text-sm font-normal leading-none text-foreground">Endpoint</th>
                    <th class="p-4 text-sm font-normal leading-none text-foreground">Method</th>
                    <th class="p-4 text-sm font-normal leading-none text-foreground">Avg Execution Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($slowApiEndpoints as $endpoint)
                    <tr class="cursor-pointer hover:bg-primary">
                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">{{ $endpoint['id']['endpoint'] }}</td>
                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">{{ $endpoint['id']['method'] }}
                        </td>
                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                            {{ $endpoint['avg_execution_time'] }} ms</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
