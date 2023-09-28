<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveDepartementRequest;
use App\Models\Departement;
use Exception;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index()
    {
        $departements = Departement::paginate(20);      
        return view('departements.index', compact('departements'));
           
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departements.create');
    }

    public function edit(Departement $departement)
    {
      return view('departements.edit',compact('departement'));
  }

  public function store(Departement $departement, saveDepartementRequest $request)
     {

        

        try{
            
            $departement->name = $request->name;
            $departement->save(); 
                  
            return redirect()->route('departement.index')
                         ->with('success_message','Departement enregistré');
            
        }catch (Exception $e){
            dd($e);
        }

    }


    public function update(Departement $departement, saveDepartementRequest $request)
     {

        try{
        $departement->name = $request->name;
        $departement->update();
        return redirect()->route('departement.index')
                         ->with('success_message','Departement mis à jour');;
        }catch (Exception $e){
            dd($e);
        }
    }

    public function delete(Departement $departement)
    {

              try{
                   $departement->delete();
                  return redirect()->route('departement.index')
                         ->with('success_message','Departement supprimé');;
               }catch (Exception $e){
                 dd($e);
                }

    }

    
     
}
