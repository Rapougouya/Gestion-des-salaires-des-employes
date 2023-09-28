<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeConfigRequest;
use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Facades\AppNameGetter; 
use Exception;

class ConfigurationController extends Controller
{
    public function index(){
        $allconfigurations = Configuration::latest()->paginate(10);
        return view('config/index', compact('allconfigurations'));
    }

    public function create(){
        return view('config.create');
    }

    public function store(storeConfigRequest $request){
        try{
            Configuration::create($request->all());
           return redirect()->route('configurations')
                  ->with('success_message','Configuration ajoutée');;
        }catch (Exception $e){           
           throw new Exception("Erreur lors de l'enregistrement de la configuration");
         }
    }

    public function delete(Configuration $configuration)
    {

              try{
                   $configuration->delete();
                  return redirect()->route('configurations')
                         ->with('success_message','Configuration supprimé');;
               }catch (Exception $e){
                throw new Exception("Erreur lors de la suppression de la configuration");
                }

    }
}
