@props(['title', 'category', 'elements', 'selectedItems', 'icon'])

<div>
    <div class="widget-boxed padd-bot-10 mrg-bot-10">
        <div class="widget-boxed-header">
            <h4><i class="{{ $icon }} padd-r-10"></i>{{ $title }}
        </div>
        <div class="widget-boxed-body padd-top-10">
            <div class="side-list">
                <input type="search" style="height: 40px; border-radius: 5px;" class="form-control" id="search-{{ $category }}" placeholder="Rechercher" onkeyup="filterList('{{ $category }}')">
                <ul class="price-range" id="list-{{ $category }}s" style="min-height: 100px; max-height: 273px; overflow-y: auto;">
                    @foreach ($selectedItems as $item)
                        {{ $item }}
                    @endforeach

                    @foreach ($elements as $item)
                        {{ in_array($item['value'], $selectedItems) ? 'checked' : '' }}
                        <li style="padding: 5px;" wire:key='{{ $category }}-{{ $item['value'] }}'>
                            <span class="custom-checkbox d-block padd-top-0">
                                <input id="check-{{ $item['value'] }}" type="checkbox" value="{{ $item['value'] }}" wire:change='changeState("{{ $item['value'] }}", "{{ $category }}")' {{ in_array($item['value'], $selectedItems) ? 'checked' : null }}> {{-- wire:loading.attr="disabled"> --}}
                                <label for="check-{{ $item['value'] }}" style="font-weight: normal;">{{ $item['value'] }}</label>
                            </span>
                        </li>
                    @endforeach
                    <p id="no-{{ $category }}-results" class="text-center" style="display: none;">Aucun résultat</p>
                </ul>
            </div>
        </div>
    </div>
</div>
