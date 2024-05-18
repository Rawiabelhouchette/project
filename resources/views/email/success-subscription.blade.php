<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription réussie</title>
</head>

<body>
    <h1>Inscription réussie</h1>
    <p>Bonjour {{ $user->nom . ' ' . $user->prenom }},</p>
    <p>Votre inscription au forfait {{ $subscription->offre->libelle }} a été effectuée avec succès.</p>
    <p>Montant: {{ $subscription->offre->prix }}</p>
    <p>Date de début: {{ $subscription->date_debut }}</p>
    <p>Date de fin: {{ $subscription->date_fin }}</p>
    <p>Merci de votre confiance !</p>
    <p>Cordialement,</p>
    <p>L'équipe de notre application</p>
    <div style="text-align: center;">
        <img src="{{ asset('assets/img/logo-vamiyi-by-numrod-white.png') }}" alt="Logo" style="width: 200px; height: auto;">
    </div>
</body>

</html>
