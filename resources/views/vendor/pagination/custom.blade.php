@if ($paginator->hasPages())
    <nav class="flex justify-between items-center"></nav></nav>

        <div>
            <ul class="flex space-x-2 static">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="px-4 py-2 text-white bg-black border border-foreground rounded cursor-not-allowed"
                            aria-hidden="true">&lsaquo;</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"
                            class="px-4 py-2 text-white bg-black border border-foreground rounded hover:bg-background/50 transition-colors">
                            &lsaquo;
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="disabled" aria-disabled="true">
                            <span class="px-4 py-2 text-white bg-background border border-foreground rounded">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active" aria-current="page">
                                    <span class="px-4 py-2 text-black bg-button border border-foreground rounded">{{ $page }}</span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}"
                                        class="px-4 py-2 text-white bg-background border border-foreground rounded hover:bg-background/50 transition-colors">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"
                            class="px-4 py-2 text-white bg-black border border-foreground rounded hover:bg-background/60 transition-colors">
                            &rsaquo;
                        </a>
                    </li>
                @else
                    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="px-4 py-2 text-white bg-black border border-foreground rounded cursor-not-allowed"
                            aria-hidden="true">&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
@endif
