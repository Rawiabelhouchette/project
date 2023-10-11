@if ($paginator->hasPages())
    <nav class="navbar-right" style="transform: scale(0.8); margin: 0px; padding: 0px;">
        <ul class="pagination" style="margin: 0px; padding: 0px;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a href="javascript:void(0)" aria-hidden="true">«</a>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">«</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true">
                        <a href="javascript:void(0)">{{ $element }}</a>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == 1 && $page != $paginator->currentPage())
                            <li>
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif

                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page">
                                <a href="javascript:void(0)">{{ $page }}</a>
                            </li>
                        {{-- @else
                            <li>
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li> --}}
                        @endif
                        
                        @if ($page == $paginator->lastPage() && $page != $paginator->currentPage())
                            <li>
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">»</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a href="javascript:void(0)" aria-hidden="true">»</a>
                </li>
            @endif
        </ul>
    </nav>
@endif
