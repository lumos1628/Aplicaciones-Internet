<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 pb-8">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-800">Consultas con JOINs (Query Builder)</h1>
        </div>

        @foreach($queries as $key => $query)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-200 flex items-center justify-between flex-wrap gap-2">
                    <div>
                        <h3 class="font-semibold text-slate-800">{{ $query['title'] }}</h3>
                        <span class="inline-block mt-1 px-2.5 py-0.5 text-xs font-medium rounded-full
                            @switch($query['type'])
                                @case('INNER JOIN') bg-blue-100 text-blue-700 @break
                                @case('LEFT JOIN') bg-amber-100 text-amber-700 @break
                                @case('RIGHT JOIN') bg-purple-100 text-purple-700 @break
                                @case('LEFT JOIN (subconsultas)') bg-indigo-100 text-indigo-700 @break
                                @case('JOIN + GROUP BY + DATE_FORMAT') bg-teal-100 text-teal-700 @break
                                @case('INNER JOIN + WHERE') bg-sky-100 text-sky-700 @break
                                @case('LEFT JOIN + GROUP BY') bg-orange-100 text-orange-700 @break
                                @case('JOIN + HAVING') bg-rose-100 text-rose-700 @break
                                @default bg-gray-100 text-gray-700
                            @endswitch
                        ">
                            {{ $query['type'] }}
                        </span>
                    </div>
                    <span class="text-xs text-gray-400 font-mono">{{ $key }}</span>
                </div>

                <div class="px-5 py-3 bg-gray-50 border-b border-gray-200">
                    <details>
                        <summary class="text-sm font-medium text-gray-500 cursor-pointer hover:text-gray-700">Ver código Query Builder</summary>
                        <pre class="mt-2 p-3 bg-gray-900 text-gray-100 text-xs rounded-lg overflow-x-auto leading-relaxed font-mono">{{ $query['sql'] }}</pre>
                    </details>
                </div>

                <div class="p-5">
                    @php $data = $query['data']; @endphp
                    @if($data->count())
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="text-left text-gray-500 border-b border-gray-200">
                                        @foreach($query['cols'] as $col)
                                            <th class="pb-2 pr-4 font-medium whitespace-nowrap">{{ $col }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($data as $row)
                                        <tr>
                                            @foreach($query['props'] as $prop)
                                                @php
                                                    $value = $row->$prop ?? '';
                                                @endphp
                                                <td class="py-2 pr-4 text-slate-700 whitespace-nowrap">
                                                    @if(is_numeric($value) && (
                                                        str_contains($prop, 'monto') ||
                                                        str_contains($prop, 'suma_') ||
                                                        str_contains($prop, 'total_') ||
                                                        $prop === 'balance'
                                                    ))
                                                        S/ {{ number_format((float)$value, 2) }}
                                                    @else
                                                        {{ $value }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">No hay datos disponibles para esta consulta.</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
