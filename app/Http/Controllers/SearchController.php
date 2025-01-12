<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Utils\CustomSession;
use Illuminate\Http\Request;
use App\Models\View;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // dd($request->all());
        $hasSessionValue = false;

        $session = new CustomSession();
        if ($session->annonces) {
            $hasSessionValue = true;
        }

        if ($request->input('se_loger') && $request->input('se_loger') == true) {
            session(['se_loger' => true]);
        }

        // se_restaurer , sortir, louer_voiture
        if ($request->input('se_restaurer') && $request->input('se_restaurer') == true) {
            session(['se_restaurer' => true]);
        }

        if ($request->input('sortir') && $request->input('sortir') == true) {
            session(['sortir' => true]);
        }

        if ($request->input('louer_voiture') && $request->input('louer_voiture') == true) {
            session(['louer_voiture' => true]);
        }

        $session->save();

        $form_request = $request->input('form_request', null);

        if ($form_request) {
            $hasSessionValue = false;
        }
        return view('public.search', compact('hasSessionValue'));
    }

    public function show($slug)
    {
        $annonce = Annonce::with(['galerie', 'entreprise', 'commentaires', 'favoris'])
            ->public()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->first();
        if (!$annonce) {
            return view('errors.404');
        }
        $annonces = Annonce::public()->where('type', $annonce->type)->latest()->take(4)->get();
        $type = $annonce->type;
        $key = '';

        View::createView($annonce->id, request()->ip());

        $typeAnnonce = Annonce::public()->pluck('type')->unique()->toArray();

        $session = new CustomSession();
        $sessAnnonces = $session->annonces;


        if (!$sessAnnonces) {
            $sessAnnonces = [];
            $sessAnnonces[] = $annonce->id;
            CustomSession::create([
                'annonces' => $sessAnnonces,
                'key' => $annonce->titre,
            ]);
        }


        $result = $this->findElement($sessAnnonces, $annonce->id);

        $previousSlug = 'javascript:void(0)';
        $nextSlug = 'javascript:void(0)';

        if ($result->previous > 0) {
            $previousSlug = route('show', Annonce::public()->where('id', $result->previous)->first()->slug);
        }

        if ($result->next > 0) {
            $nextSlug = route('show', Annonce::public()->where('id', $result->next)->first()->slug);
        }

        $position = $result->position . '/' . (count($sessAnnonces) == 0 ? 1 : count($sessAnnonces));

        $pagination = (object) [
            'position' => $position,
            'previous' => $previousSlug,
            'next' => $nextSlug
        ];

        return view('public.show', compact('annonce', 'type', 'key', 'annonces', 'typeAnnonce', 'pagination'));
    }

    function findElement($array, $element)
    {
        $position = array_search($element, $array);

        if ($position === false) {
            return (object) [
                'position' => 1,
                'previous' => 0,
                'next' => 0
            ];
        }

        // dd($position);

        $previous = $position > 0 ? $array[$position - 1] : 0;
        $next = $position < count($array) - 1 ? $array[$position + 1] : 0;

        return (object) [
            'position' => ++$position,
            'previous' => $previous,
            'next' => $next
        ];
    }

}
