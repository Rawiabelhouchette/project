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
        return view('public.search');
    }

    public function show($slug)
    {
        $annonce = Annonce::public()->where('slug', $slug)->where('is_active', true)->firstOrFail();
        $annonces = Annonce::public()->where('type', $annonce->type)->latest()->take(4)->get();
        $type = $annonce->type;
        $key = '';
        // increement statistiqueAnnonce nb_vue
        StatistiqueAnnonce::where('annonce_id', $annonce->id)->first()->increment('nb_vue');

        $typeAnnonce = Annonce::public()->pluck('type')->unique()->toArray();

        $session = new CustomSession();

        $result = $this->findElement($session->annonces, $annonce->id);

        $previousSlug = 'javascript:void(0)';
        $nextSlug = 'javascript:void(0)';

        if ($result->previous > 0) {
            $previousSlug = route('show', Annonce::public()->where('id', $result->previous)->first()->slug);
        }

        if ($result->next > 0) {
            $nextSlug = route('show', Annonce::public()->where('id', $result->next)->first()->slug);
        }

        $position = $result->position . '/' . count($session->annonces);

        $pagination = (object) [
            'position' => $position,
            'previous' => $previousSlug,
            'next' => $nextSlug
        ];


        // dd($pagination);



        return view('public.show', compact('annonce', 'type', 'key', 'annonces', 'typeAnnonce', 'pagination'));
    }

    function findElement($array, $element)
    {
        $position = array_search($element, $array);

        if ($position === false) {
            return back();
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
