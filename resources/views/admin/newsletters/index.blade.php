@extends('admin.layouts.app')

@section('title', 'Abonnés Newsletter')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Liste des abonnés à la newsletter</h2>

    {{-- Barre de recherche --}}
    <form method="GET" action="{{ route('admin.newsletters.index') }}" class="mb-3">
        <input type="text" name="search" placeholder="Rechercher un email"
            value="{{ request('search') }}" class="form-control d-inline-block" style="max-width: 300px;">
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>

    {{-- Bouton envoyer --}}
    <button id="btnSend" class="btn btn-success mb-3" disabled>Envoyer</button>

    {{-- Tableau des abonnés --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><input type="checkbox" id="checkAll"></th>
                <th>Email</th>
                <th>Date d’inscription</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($subscribers as $subscriber)
                <tr>
                    <td><input type="checkbox" class="email-checkbox" value="{{ $subscriber->email }}"></td>
                    <td>{{ $subscriber->email }}</td>
                    <td>{{ $subscriber->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Aucun abonné trouvé</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $subscribers->links() }}
    </div>
</div>

{{-- ✅ Première modal : Liste des annonces --}}
<div class="modal fade" id="annonceModal" tabindex="-1" aria-labelledby="annonceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sélectionnez une annonce</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Type</th>
                            <th>Entreprise</th>
                            <th>Titre</th>
                            <th>État</th>
                            <th>Date validité</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($annonces as $annonce)
                            <tr>
                                <td>
                                    <input type="radio" name="selected_annonce" value="{{ $annonce->id }}" class="annonce-radio">
                                </td>
                                <td>{{ $annonce->type }}</td>
                                <td>{{ $annonce->entreprise->nom ?? '—' }}</td>
                                <td>{{ $annonce->titre }}</td>
                                <td>
                                    @if($annonce->is_active)
                                        <span class="badge bg-success">Actif</span>
                                    @else
                                        <span class="badge bg-danger">Inactif</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($annonce->date_validite)->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button id="btnNext" class="btn btn-primary" disabled>Suivant</button>
            </div>
        </div>
    </div>
</div>

{{-- ✅ Deuxième modal : affichage des annonces par type --}}
<div class="modal fade" id="annonceCardsModal" tabindex="-1" aria-labelledby="annonceCardsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Annonces disponibles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>

            <div class="modal-body" id="annonceCardsContainer">
                <p class="text-center text-muted">Chargement des annonces...</p>
            </div>

            <div class="modal-footer d-flex justify-content-between">
                {{-- 🔙 Bouton précédent --}}
                <button id="btnPrevious" class="btn btn-secondary">Précédent</button>

                {{-- ✉️ Bouton envoyer --}}
                <button id="btnSendFinal" class="btn btn-success" disabled>Envoyer</button>
            </div>
        </div>
    </div>
</div>
@endsection


{{-- ✅ Script JS --}}
@section('scripts')
<script>
$(document).ready(function () {
    // ✅ Activer/désactiver le bouton "Envoyer"
    $('.email-checkbox, #checkAll').on('change', function () {
        const checked = $('.email-checkbox:checked').length > 0;
        $('#btnSend').prop('disabled', !checked);
    });

    // ✅ Sélectionner/désélectionner tout
    $('#checkAll').on('change', function() {
        $('.email-checkbox').prop('checked', this.checked).trigger('change');
    });

    // ✅ Ouvrir la première popup
    $('#btnSend').on('click', function () {
        $('#annonceModal').modal('show');
    });

    // ✅ Activer le bouton "Suivant"
    $(document).on('change', '.annonce-radio', function () {
        const isChecked = $('.annonce-radio:checked').length > 0;
        $('#btnNext').prop('disabled', !isChecked);
    });

    // ✅ Quand on clique sur "Suivant"
    $('#btnNext').on('click', function () {
        const annonceType = $('.annonce-radio:checked').closest('tr').find('td:nth-child(2)').text().trim();
        $('#annonceModal').modal('hide');
        $('#annonceCardsModal').modal('show');

        // 🔄 Charger dynamiquement les annonces de ce type
        $('#annonceCardsContainer').html('<p class="text-center text-muted">Chargement...</p>');
        $.get("{{ route('admin.newsletters.annonces.byType') }}", { type: annonceType }, function (response) {
        $('#annonceCardsContainer').html(response.html);

            // Après le chargement, réinitialiser le bouton "Envoyer"
            $('#btnSendFinal').prop('disabled', true);
        });
    });

    // ✅ Gérer le bouton "Précédent"
    $('#btnPrevious').on('click', function () {
        $('#annonceCardsModal').modal('hide');
        $('#annonceModal').modal('show');
    });

    // ✅ Activer le bouton "Envoyer" si une annonce est cochée dans la deuxième modal
    $(document).on('change', '.annonce-card-checkbox', function () {
        const checked = $('.annonce-card-checkbox:checked').length > 0;
        $('#btnSendFinal').prop('disabled', !checked);
    });

    // ✅ Envoi final
    $('#btnSendFinal').on('click', function () {
        const selectedCards = $('.annonce-card-checkbox:checked').map(function() {
            return $(this).data('id');
        }).get();

        const emails = $('.email-checkbox:checked').map(function(){ return this.value; }).get();

        alert("Envoi des annonces ID: " + selectedCards.join(', ') + " à : " + emails.join(', '));
        $('#annonceCardsModal').modal('hide');
    });
});
</script>
@endsection
