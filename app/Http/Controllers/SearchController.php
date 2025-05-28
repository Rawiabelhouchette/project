<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\View;
use App\Utils\CustomSession;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $hasSessionValue = false;

        $session = new CustomSession;
        if ($session->annonces) {
            $hasSessionValue = true;
        }
        $session->save();

        $searchTypes = ['se_loger', 'se_restaurer', 'sortir', 'louer_voiture'];

        foreach ($searchTypes as $type) {
            if ($request->input($type) && $request->input($type) == true) {
                // CustomSession::reset();
                session([$type => true]);
            }
        }

        $form_request = $request->input('form_request', null);

        if ($form_request) {
            $hasSessionValue = false;
        }

        return view('public.search', compact('hasSessionValue'));
    }

    public function show($slug)
    {
        $user = auth()->user();

        $annonce = Annonce::eagerLoad()
            ->with('commentaires.auteur')
            ->where('slug', $slug)
            ->first();

        if (! $annonce) {
            return view('errors.404');
        }

        // Accès selon rôles
        $isAdmin = $user && $user->hasRole('Administrateur');
        $isPro = $user && $user->hasRole('Professionnel') && in_array($annonce->entreprise_id, $user->entreprises->pluck('id')->toArray());

        if (! $isAdmin && ! $isPro && ! $annonce->is_active) {
            return view('errors.404');
        }

        // Vues similaires
        // $annonces = Annonce::public()->where('type', $annonce->type)->latest()->take(4)->get();
        $type = $annonce->type;
        $key = '';

        // Création de la vue
        View::createView($annonce->id, request()->ip());

        // Types d'annonces
        $typeAnnonce = Annonce::public()->pluck('type')->unique()->toArray();

        // Session personnalisée
        $session = new CustomSession;
        $sessAnnonces = $session->annonces ?? [];

        if (! in_array($annonce->id, $sessAnnonces)) {
            $sessAnnonces[] = $annonce->id;
            CustomSession::create([
                'annonces' => $sessAnnonces,
                'key' => $annonce->titre,
            ]);
        }

        // Position + pagination
        $result = $this->findElement($sessAnnonces, $annonce->id);

        // $previous = Annonce::public()->find($result->previous);
        // $next = Annonce::public()->find($result->next);

        // $pagination = (object) [
        //     'position' => "{$result->position}/" . max(count($sessAnnonces), 1),
        //     'previous' => $previous ? route('show', $previous->slug) : 'javascript:void(0)',
        //     'next' => $next ? route('show', $next->slug) : 'javascript:void(0)',
        // ];
        $neighbors = Annonce::public()
            ->whereIn('id', [$result->previous, $result->next])
            ->get()
            ->keyBy('id');

        $pagination = (object) [
            'position' => "{$result->position}/".max(count($sessAnnonces), 1),
            'previous' => isset($neighbors[$result->previous])
                ? route('show', $neighbors[$result->previous]->slug)
                : 'javascript:void(0)',
            'next' => isset($neighbors[$result->next])
                ? route('show', $neighbors[$result->next]->slug)
                : 'javascript:void(0)',
        ];

        return view('public.show', compact(
            'annonce',
            'type',
            'key',
            // 'annonces',
            'typeAnnonce',
            'pagination'
        ));
    }

    public function findElement($array, $element)
    {
        $position = array_search($element, $array);

        if ($position === false) {
            return (object) [
                'position' => 1,
                'previous' => 0,
                'next' => 0,
            ];
        }

        // dd($position);

        $previous = $position > 0 ? $array[$position - 1] : 0;
        $next = $position < count($array) - 1 ? $array[$position + 1] : 0;

        return (object) [
            'position' => ++$position,
            'previous' => $previous,
            'next' => $next,
        ];
    }
}
