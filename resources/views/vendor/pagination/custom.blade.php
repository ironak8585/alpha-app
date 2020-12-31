@php
$parameters = $parameters . "&" . 'rpp=' . $paginator->perPage();
@endphp
<div class="divider">Pagination</div>
<nav class="pagination" role="navigation" aria-label="pagination">
    @if ($paginator->onFirstPage())
        <a class="pagination-previous button" disabled aria-label="@lang('pagination.previous')">
            <i class="fas fa-backward"></i>
        </a>
    @else
        <a class="pagination-previous button is-primary" href="{{ $paginator->previousPageUrl() . $parameters }}"
            rel="prev" aria-label="@lang('pagination.previous')">
            <i class="fas fa-backward"></i>
        </a>
    @endif
    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a class="pagination-previous button is-primary" href="{{ $paginator->nextPageUrl() . $parameters }}" rel="next"
            aria-label="@lang('pagination.next')">
            <i class="fas fa-forward"></i>
        </a>
    @else
        <a class="pagination-previous button" disabled aria-label="@lang('pagination.next')">
            <i class="fas fa-forward"></i>
        </a>
    @endif
    <ul class="pagination-list">
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li>
                    <span class="pagination-ellipsis">&hellip;</span>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li>
                            <a class="pagination-link is-current" aria-current="page">
                                <span>{{ $page }}</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a class="pagination-link" href="{{ $url . $parameters }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
    </ul>
    <div class="divider is-vertical" style="order: 4">RPP</div>
    <div class="field" style="order: 5">
        <input type="hidden" id="rpp-prev" value="{{ $paginator->perPage() }}">
        <div class="control">
            <div class="select">
                <select name="rpp" id="rpp">
                    @foreach (Config::get('constants.APP.RECORDS_PER_PAGES') as $option)
                        <option value="{{ $option }}" {{ $paginator->perPage() == $option ? 'selected' : '' }}>
                            {{ $option }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</nav>
