<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeEmployerRequest;
use App\Http\Requests\UpdateEmployerRequest;
use App\Models\Departement;
use App\Models\Employer;
use Exception;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function index()
    {
        
        $employers = Employer::with('departement')->paginate(10);      
        return view('employers.index', compact('employers'));
           
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departements = Departement::all();
        return view('employers.create', compact('departements'));
    }

    public function edit(Employer $employer)
    {
      $departements = Departement::all();
      return view('employers.edit',compact('employer', 'departements'));
    }
    
    
    public function store(storeEmployerRequest $request)
     {

        try{
            $query = Employer::create($request->all());
           
        if($query){
            
            return redirect()->route('employer.index')
                         ->with('success_message','Employé ajouté');

        } 
        }catch (Exception $e){
            dd($e);
        }
        }
        

    
    

    public function update(UpdateEmployerRequest $request, Employer $employer){
        try{
            $employer->departement_id = $request->departement_id;
            $employer->firstname = $request->firstname;
            $employer->lastname = $request->lastname;
            $employer->email = $request->email;
            $employer->phone = $request->phone;
            $employer->montant_journalier = $request->montant_journalier;
            $employer->update();
            
            return redirect()->route('employer.index')
                             ->with('success_message',"Les informations de l'employé ont été mise à jour");;
            }catch (Exception $e){
                dd($e);
            }
    }

    public function delete(Employer $employer)
    {

              try{
                   $employer->delete();
                  return redirect()->route('employer.index')
                         ->with('success_message','Employer supprimé');
               }catch (Exception $e){
                 //dd($e);
                 throw new Exception('Une erreur est survenue lors de la suppression du compte de cet employé');
                }

    }

  
} 

