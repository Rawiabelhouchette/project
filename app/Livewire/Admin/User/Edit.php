<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public $userId;
    public $nom;
    public $prenom;
    public $email;
    public $username;
    public $telephone;
    public $is_active;
    public $role = '';

    public $roles = [];
        
    public function mount($userId)
    {
        $this->roles = Role::orderBy('id', 'desc')->select('name', 'id')->get();
        $this->userId = $userId;
        $user = User::findOrFail($userId);
        $this->nom = $user->nom;
        $this->prenom = $user->prenom;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->telephone = $user->telephone;
        $this->is_active = $user->is_active;
        $this->role = $user->roles->first()->name;

    }

    public function rules() {
        return [
            'nom' => 'required|string|min:3|max:255',
            'prenom' => 'nullable|string|min:3|max:255',
            'email' => 'nullable|email|unique:users,email,' . $this->userId,
            'username' => 'required|string|min:3|max:255|unique:users,username,' . $this->userId,
            'telephone' => 'nullable|string|min:3|max:255|unique:users,telephone,' . $this->userId,
            'is_active' => 'required|boolean',
            'role' => 'required|string|exists:roles,name',
        ];
    }

    protected $messages = [
        'username.unique' => 'Identifiant déjà pris.',
        'email.unique' => 'Adresse email déjà prise.',
        'telephone.unique' => 'Numéro de téléphone déjà pris.',
    ];

    public function update()
    {
        $validated = $this->validate();

        DB::beginTransaction();

        try {
            $user = User::findOrFail($this->userId);
            $user->update($validated);
            $user->syncRoles($this->role);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title'   => __('Une erreur s\'est produite'),
                'message' => __('Utilisateur ajouté avec succès'),
            ]);
        }

        session()->flash('success', 'Utilisateur modifié avec succès.');

        return redirect()->route('users.index');
        

        // $this->dispatch('swal:modal', [
        //     'icon' => 'success',
        //     'title'   => __('Opération réussie'),
        //     'message' => __('Utilisateur ajouté avec succès'),
        // ]);        

        // $this->reset();
        

        // $this->roles = Role::orderBy('id', 'desc')->select('name', 'id')->get();
    }

    public function render()
    {
        return view('livewire.admin.user.edit');
    }
}

