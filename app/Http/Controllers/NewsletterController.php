<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Models\Annonce;

class NewsletterController extends Controller
{
    /**
     * Inscription à la newsletter (frontend)
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ], [
            'email.required' => 'Veuillez entrer une adresse email.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cet email est déjà inscrit à la newsletter.',
        ]);

        Newsletter::create(['email' => $request->email]);

        return redirect()->back()->with('success', 'Merci pour votre inscription !');
    }

    /**
     * Page d’administration : liste des abonnés newsletter
     */
    public function index(Request $request)
    {
        $query = Newsletter::query();

        // 🔍 Recherche d’un email
        if ($request->filled('search')) {
            $query->where('email', 'like', "%{$request->search}%");
        }

        // 🔹 Pagination
        $subscribers = $query->orderBy('created_at', 'desc')->paginate(10);

        // 🔹 Liste des annonces (avec leur entreprise)
        $annonces = Annonce::with('entreprise')->orderBy('created_at', 'desc')->get();

        return view('admin.newsletters.index', compact('subscribers', 'annonces'));
    }

    /**
     * Suppression multiple d’abonnés
     */
    public function deleteSelected(Request $request)
    {
        $ids = $request->input('selected', []);

        if (!empty($ids)) {
            Newsletter::whereIn('id', $ids)->delete();
            return back()->with('success', 'Les abonnés sélectionnés ont été supprimés.');
        }

        return back()->with('error', 'Aucun abonné sélectionné.');
    }

    /**
     * Récupère les annonces selon leur type (pour la 2e popup AJAX)
     */
    public function getAnnoncesByType(Request $request)
    {
        $type = $request->input('type');

        // 🧩 Sécurité : si le type est vide
        if (empty($type)) {
            return response()->json(['html' => '<p class="text-center text-muted">Type non spécifié.</p>']);
        }

        // 🔹 Récupérer les annonces du type sélectionné
        $annonces = Annonce::with('entreprise')
            ->where('type', $type)
            ->orderBy('created_at', 'desc')
            ->get();

        // 🔹 Retourne la vue partielle HTML
        $html = view('admin.newsletters.partials.annonce_cards', compact('annonces'))->render();

        return response()->json(['html' => $html]);
    }
}
