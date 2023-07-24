
@if ($paginator->hasPages())
    <ul class="pagination p-2">

        @if ($paginator->onFirstPage())
            <li  class="page-item prev disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span  class="page-link" aria-hidden="true">Prev</span>
            </li>
        @else
            <li class="page-item prev">
                <a  class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Prev</a>
            </li>
        @endif

        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">{{ $element }}</span>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class="page-item next">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
            </li>
        @else
            <li class="page-item next disabled">
                <span class="page-link" aria-hidden="true">Next</span>
            </li>
        @endif
    
    </ul>
@endif