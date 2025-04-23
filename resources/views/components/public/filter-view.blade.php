@props(['title', 'category', 'items', 'selectedItems', 'icon', 'filterModel'])

<div class="col-xs-12 col-md-3" id="filter-container-{{ $category }}">
    <div class="filter-button padd-bot-10 mrg-bot-10">
        <div class="filter-button-header" style="cursor: pointer;" onclick="toggleFilterBody('{{ $category }}')">
            <p class="theme-cl-blue fs-5">
                <i class="{{ $icon }} padd-r-10 theme-cl-blue "></i>
                {{ $title }} 
                @if(count($selectedItems) > 0)
                    <span class="badge dark-bg rounded-pill">{{ count($selectedItems) }}</span>
                @endif
                <i id="arrow-{{ $category }}" class="fa fa-chevron-down float-end"></i>
            </p>
        </div>
        
        <div class="filter-button-body padd-top-10" id="filter-body-{{ $category }}" style="display: none;">
            <div class="side-list">
                <input type="search" wire:model='{{ $filterModel }}' style="height: 40px; border-radius: 5px;" class="form-control fs-5" id="search-{{ $category }}" placeholder="Rechercher" onkeyup="filterList('{{ $category }}')">
                <ul class="price-range" id="list-{{ $category }}s" style="min-height: 100px; max-height: 273px; overflow-y: auto;">
                    @foreach ($items as $item)
                        <li style="padding: 5px;  display: none;" wire:key='{{ $category }}-{{ $item['value'] }}'>
                            <span class="custom-checkbox d-block padd-top-0 fs-5">
                                <input id="check-{{ $item['value'] }}" type="checkbox" value="{{ $item['value'] }}" wire:change='changeState("{{ $item['value'] }}", "{{ $category }}")' {{ in_array($item['value'], $selectedItems) ? 'checked' : null }}>
                                <label for="check-{{ $item['value'] }}" style="font-weight: normal;">{{ $item['value'] }}</label>
                            </span>
                            <span class="theme-cl fs-5" style="float: right;">
                                {{ $item['count'] }} &nbsp;
                            </span>
                        </li>
                    @endforeach
                    <p id="no-{{ $category }}-results" class="text-center" style="display: none;">Aucun résultat</p>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleFilterBody(category) {
        const body = document.getElementById('filter-body-' + category);
        const arrow = document.getElementById('arrow-' + category);
        const container = document.getElementById('filter-container-' + category);
        
        if (body.style.display === 'none') {
            body.style.display = 'block';
            arrow.classList.replace('fa-chevron-down', 'fa-chevron-up');
            container.className = 'col-xs-12 col-md-3'; // Set to full width when open
            // Trigger filter list to show items
            setTimeout(() => filterList(category), 100);
        } else {
            body.style.display = 'none';
            arrow.classList.replace('fa-chevron-up', 'fa-chevron-down');
            container.className = 'col-xs-12 col-md-3'; // Set to half width when closed
        }
    }
</script>



