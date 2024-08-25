<li class="dm-pagination__item">
Total : {{ $paginator->total() }} Data
</li>
<li class="dm-pagination__item">
    {{-- Tombol "Pertama" --}}
    @if ($paginator->onFirstPage())
        <a href="#" class="dm-pagination__link pagination-control"><span class="la la-angle-double-left"></span></a>
    @else
        <a href="{{ $paginator->url(1) }}" class="dm-pagination__link pagination-control"><span class="la la-angle-double-left"></span></a>
    @endif

    {{-- Tombol "Sebelumnya" --}}
    @if ($paginator->onFirstPage())
        <a href="#" class="dm-pagination__link pagination-control"><span class="la la-angle-left"></span></a>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="dm-pagination__link pagination-control"><span class="la la-angle-left"></span></a>
    @endif

    {{-- Loop paginasi dengan onEachSide --}}
    @for ($page = max(1, $paginator->currentPage() - $paginator->onEachSide); $page <= min($paginator->lastPage(), $paginator->currentPage() + $paginator->onEachSide); $page++)
        @if ($page == $paginator->currentPage())
            <a href="#" class="dm-pagination__link active"><span class="page-number">{{ $page }}</span></a>
        @else
            <a href="{{ $paginator->url($page) }}" class="dm-pagination__link"><span class="page-number">{{ $page }}</span></a>
        @endif
    @endfor

    {{-- Tombol "Berikutnya" --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="dm-pagination__link pagination-control"><span class="la la-angle-right"></span></a>
    @else
        <a href="#" class="dm-pagination__link pagination-control"><span class="la la-angle-right"></span></a>
    @endif

    {{-- Tombol "Terakhir" --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->url($paginator->lastPage()) }}" class="dm-pagination__link pagination-control"><span class="la la-angle-double-right"></span></a>
    @else
        <a href="#" class="dm-pagination__link pagination-control"><span class="la la-angle-double-right"></span></a>
    @endif
</li>
    <li class="dm-pagination__item">
                                       <div class="paging-option">
                                       <form method="GET" action="#" id="pagination-form">
                                       <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                                       @if(Request::is('pengumpulan/laporan*'))
                                            <input type="hidden" name="bulan" value="{{ request('bulan') }}">
                                        @endif
                                       
                                                <select name="limit" id="limit" class="page-selection" onchange="this.form.submit()">
                                                    <option value="10" {{ request('limit') == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="20" {{ request('limit') == 20 ? 'selected' : '' }}>20</option>
                                                    <option value="40" {{ request('limit') == 40 ? 'selected' : '' }}>40</option>
                                                    <option value="100" {{ request('limit') == 100 ? 'selected' : '' }}>100</option>
                                                    @if(Request::is('pendistribusian/laporan*') || Request::is('sdm/laporan*'))
                                                    <option value="1000" {{ request('limit') == 1000 ? 'selected' : '' }}>1000</option>
                                                    <option value="5000" {{ request('limit') == 5000 ? 'selected' : '' }}>5000</option>
                                                    @endif
                                                </select>
                                            </form>
                                       </div>
                                    </li>


                           