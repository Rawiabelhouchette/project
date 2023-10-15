<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Add extends Component
{
    public $nom;
    public $prenom;
    public $email;
    public $username;
    public $telephone;
    public $is_active;
    public $password;
    public $password_confirmation;
    public $role = '';

    public $roles = [];

    public function mount()
    {
        $this->roles = Role::orderBy('id', 'desc')->select('name', 'id')->get();
    }

    protected $rules = [
        'nom' => 'required|string|min:3|max:255',
        'prenom' => 'nullable|string|min:3|max:255',
        'email' => 'nullable|email|unique:users,email',
        'username' => 'required|string|min:3|max:255|unique:users,username',
        'telephone' => 'nullable|string|min:3|max:255|unique:users,telephone',
        'is_active' => 'required|boolean',
        'password' => 'required|min:4|max:255',
        'password_confirmation' => 'required|same:password',
        'role' => 'required|string|exists:roles,name',
    ];

    protected $messages = [
        'username.unique' => 'Identifiant déjà pris.',
        'email.unique' => 'Adresse email déjà prise.',
        'telephone.unique' => 'Numéro de téléphone déjà pris.',
    ];

    public function store()
    {
        $validated = $this->validate();
        
        DB::beginTransaction();

        try {
            $user = User::create($validated);
            $user->assignRole($this->role);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title'   => __('Une erreur s\'est produite'),
                'message' => __('Utilisateur ajouté avec succès'),
            ]);   
        }

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title'   => __('Opération réussie'),
            'message' => __('Utilisateur ajouté avec succès'),
        ]);        

        $this->reset();
        

        $this->roles = Role::orderBy('id', 'desc')->select('name', 'id')->get();
    }

    public function render()
    {
        return view('livewire.admin.user.add');
    }
}
