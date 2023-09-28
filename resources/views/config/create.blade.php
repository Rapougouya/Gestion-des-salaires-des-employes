@extends('layouts.temp')
  
@section('content')
<h1 class="app-page-title">Configurations</h1>
<hr class="mb-4">
<div class="row g-4 settings-section">
    <div class="col-12 col-md-4">
        <h3 class="section-title">Ajout</h3>
        <div class="section-intro">Ajouter une nouvelle configuration</div>
    </div>
    <div class="col-12 col-md-8">
        <div class="app-card app-card-settings shadow-sm p-4">
            
            <div class="app-card-body">
                <form class="settings-form" method="POST" action="{{route('configuration.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="setting-input-1" class="form-label">Type de la configuration<span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info."></span></label>
                        
                        <select class="form-control" name="type" id="type">
                            <option value="PAYMENT_DATE">Date de paiement</option>
                            <option value="APP_NAME">Nom de l'application</option>
                            <option value="DEVELOPPER_NAME">Equipe de developpement</option>
                            <option value="ANOTHER">Autre option</option>
                        </select>
                        @error('type')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-1" class="form-label">Valeur<span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info."></span></label>
                        
                        <input type="text" class="form-control" value="{{old('valeur')}}" placeholder="Entrer la valeur" name="valeur" >
                     
                        @error('valeur')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn app-btn-primary" >Enregistrer</button>
                </form>
        </div>
    </div>
</div>
@endsection