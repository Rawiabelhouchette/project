<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de votre abonnement à {{ config('app.name') }}</title>
</head>
<body>
    <p>Bonjour {{ $clientName }},</p>

    <p>Nous vous remercions de vous être abonné à {{ config('app.name') }}. Votre abonnement a été activé avec succès. Voici les détails de votre abonnement :</p>

    <p>
        <strong>Nom de l'offre</strong> : {{ $offerName }}<br>
        <strong>Durée</strong> : {{ $duration }} mois<br>
        <strong>Date de début</strong> : {{ $startDate }}<br>
        <strong>Date de fin</strong> : {{ $endDate }}
    </p>

    <p>Vous pouvez désormais profiter de tous nos services, y compris la possibilité de poster vos propres annonces et d'accéder à une multitude de fonctionnalités dédiées à la gestion de vos publications.</p>

    <p>Si vous avez des questions ou avez besoin d'assistance, n'hésitez pas à nous contacter à {{ env('APP_EMAIL')}} ou par téléphone au {{ env('APP_PHONE')}}.</p>

    <p>Merci de votre confiance et à bientôt sur {{ config('app.name') }}.</p>

    <p>Cordialement,<br>
    L'équipe {{ config('app.name') }}</p>
</body>
</html>
