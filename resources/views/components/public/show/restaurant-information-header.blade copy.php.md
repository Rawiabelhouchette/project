@props(['sections'])

<ul class="nav nav-tabs" id="myTab" role="tablist">
    {{-- <li class="nav-item" role="presentation">
        <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
    </li>
    
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="equipement-tab" data-bs-toggle="tab" data-bs-target="#equipement" type="button" role="tab" aria-controls="equipement" aria-selected="true">Équipements</button>
    </li>

    <li class="nav-item" role="menu">
        <button class="nav-link" id="menu-tab" data-bs-toggle="tab" data-bs-target="#menu" type="button" role="tab" aria-controls="menu" aria-selected="true">Menu</button>
    </li>

    <li class="nav-item" role="comments">
        <button class="nav-link" id="comments-tab" data-bs-toggle="tab" data-bs-target="#comments" type="button" role="tab" aria-controls="comments" aria-selected="true">Commentaires</button>
    </li> --}}

    @foreach ($sections as $index => $section)
        <li class="nav-item" role="{{ $section }}">
            <button class="nav-link {{ $index == 0 ? 'active' : '' }}" id="{{ $section }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $section }}" type="button" role="tab" aria-controls="{{ $section }}" aria-selected="true">{{ $section }}</button>
        </li>
    @endforeach
</ul>
