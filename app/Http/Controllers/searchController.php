<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\StatistiqueAnnonce;
use App\Utils\CustomSession;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function search(Request $request)
    {
        // dd($request->all());
        $hasSessionValue = false;

        $session = new CustomSession();
        if ($session->annonces) {
            $hasSessionValue = true;
        }

        $form_request = $request->input('form_request', null);

        if ($form_request) {
            $hasSessionValue = false;
        }
        return view('public.search', compact('hasSessionValue'));
    }

    public function show($slug)
    {
        $annonce = Annonce::public()->where('slug', $slug)->where('is_active', true)->first();
        $annonces = Annonce::public()->where('type', $annonce->type)->latest()->take(4)->get();
        $type = $annonce->type;
        $key = '';
        // increement statistiqueAnnonce nb_vue
        StatistiqueAnnonce::where('annonce_id', $annonce->id)->first()->increment('nb_vue');

        $typeAnnonce = Annonce::public()->pluck('type')->unique()->toArray();

        $session = new CustomSession();
        $sessAnnonces = $session->annonces;


        if (!$sessAnnonces) {
            $sessAnnonces[] = $annonce->id;
            CustomSession::create([
                'annonces' => $sessAnnonces,
                'key' => $annonce->titre,
            ]);
        }

        // dd($sessAnnonces);
        $result = $this->findElement($sessAnnonces, $annonce->id);

        $previousSlug = 'javascript:void(0)';
        $nextSlug = 'javascript:void(0)';

        if ($result->previous > 0) {
            $previousSlug = route('show', Annonce::public()->where('id', $result->previous)->first()->slug);
        }

        if ($result->next > 0) {
            $nextSlug = route('show', Annonce::public()->where('id', $result->next)->first()->slug);
        }

        $position = $result->position . '/' . (count($session->annonces) == 0 ? 1 : count($session->annonces));

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
