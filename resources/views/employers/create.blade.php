@extends('layouts.temp')
  
@section('content')
<h1 class="app-page-title">Employés</h1>
<hr class="mb-4">
<div class="row g-4 settings-section">
    <div class="col-12 col-md-4">
        <h3 class="section-title">Ajout</h3>
        <div class="section-intro">Ajouter un nouvel employé</div>
    </div>
    <div class="col-12 col-md-8">
        <div class="app-card app-card-settings shadow-sm p-4">
            
            <div class="app-card-body">
                <form class="settings-form" method="POST" action="{{ route('employer.store') }}">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="setting-input-3" class="form-label">Departement</label>
                        <select class="form-control" name="departement_id" id="departement_id">
                           <option value=""></option>
                            @foreach ($departements as $departement)
                                <option value="{{$departement->id}}">{{$departement->name}}</option>
                            @endforeach
                        </select>

                        @error('departement_id')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-1" class="form-label">Nom<span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info."></span>
                        </label>
                        <input type="text" class="form-control" id="setting-input-1" placeholder="Entrer le nom" name="firstname" value="{{old('firstname')}}" required>

                        @error('firstname')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Prenom</label>
                        <input type="text" class="form-control" id="setting-input-2" placeholder="Entrer le prenom" name="lastname" value="{{old('lastname')}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-3" class="form-label"> Email</label>
                        <input type="email" class="form-control" id="setting-input-3" name="email" value="{{old('email')}}" placeholder="Entrer le Email">
                        @error('email')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-3" class="form-label">Contact</label>
                        <input type="number" class="form-control" id="setting-input-3" name="phone" value="{{old('phone')}}" placeholder="Entrer le contact">
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-3" class="form-label">Montant journalier</label>
                        <input type="number" class="form-control" id="setting-input-3" name="montant_journalier" value="{{old('montant_journalier')}}" placeholder="Entrer le montant jounalier">

                        @error('montant_journalier')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <label for="setting-input-3" class="form-label"> Email</label>
                        <input type="email" class="form-control" id="setting-input-3" name="email" value="{{old('email')}}" placeholder="Entrer le Email">
                    </div> --}}
                    <button type="submit" class="btn app-btn-primary" >Enregistrer</button>
                </form>
            </div><!--//app-card-body-->
            
        </div><!--//app-card-->
    </div>
</div><!--//row-->
@endsection