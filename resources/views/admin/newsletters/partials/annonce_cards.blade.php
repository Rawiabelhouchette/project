<div class="row">
    @forelse ($annonces as $annonce)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="mb-2">
                        @if($annonce->is_active)
                            <span class="badge bg-success">Ouvert</span>
                        @else
                            <span class="badge bg-danger">Fermé</span>
                        @endif
                    </div>

                    <h5 class="card-title text-primary">{{ $annonce->titre }}</h5>
                    <p class="text-muted mb-1">
                        <i class="bi bi-geo-alt"></i> {{ $annonce->pays ?? '—' }},
                        {{ $annonce->ville ?? '' }}
                    </p>
                    <p><i class="bi bi-phone"></i> {{ $annonce->entreprise->telephone ?? '—' }}</p>
                    <p><i class="bi bi-tags"></i> {{ $annonce->prix ?? '—' }}</p>

                    {{-- ✅ Checkbox pour sélectionner l'annonce --}}
                    <div class="form-check mt-3">
                        <input class="form-check-input annonce-checkbox"
                               type="checkbox"
                               value="{{ $annonce->id }}"
                               id="annonce_{{ $annonce->id }}">
                        <label class="form-check-label" for="annonce_{{ $annonce->id }}">
                            Sélectionner
                        </label>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center text-muted">Aucune annonce trouvée pour ce type.</p>
    @endforelse
</div>

{{-- ✅ Footer avec les deux boutons --}}
<div class="d-flex justify-content-between mt-4">
    <button id="btnPrevious" class="btn btn-secondary">⬅ Précédent</button>
    <button id="btnSendFinal" class="btn btn-success" disabled>Envoyer</button>
</div>

{{-- ✅ Script JS pour gérer les boutons --}}
<script>
$(document).ready(function () {
    // Désactiver le bouton "Envoyer" tant qu’aucune annonce n’est cochée
    $(document).on('change', '.annonce-checkbox', function () {
        const anyChecked = $('.annonce-checkbox:checked').length > 0;
        $('#btnSendFinal').prop('disabled', !anyChecked);
    });

    // Bouton "Précédent" → revenir à la popup précédente
    $('#btnPrevious').on('click', function () {
        $('#annonceCardsModal').modal('hide');
        $('#annonceModal').modal('show');
    });

    // Bouton "Envoyer" → récupérer les annonces + emails sélectionnés
    $('#btnSendFinal').on('click', function () {
        const selectedAnnonces = $('.annonce-checkbox:checked').map(function(){ return this.value; }).get();
        const selectedEmails = $('.email-checkbox:checked').map(function(){ return this.value; }).get();

        alert(
            "📢 Annonces sélectionnées: " + selectedAnnonces.join(', ') +
            "\n📧 Emails: " + selectedEmails.join(', ')
        );

        $('#annonceCardsModal').modal('hide');
    });
});
</script>
