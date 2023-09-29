<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\storeAdminRequest;
use App\Http\Requests\submitDefineAccessRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\ResetCodePassword;
use App\Notifications\SendEmailToAdminAfterRegistrationNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index(){
        $admins = User::paginate(10);
        return view('admin/index', compact('admins'));
    }

    public function create(){
        return view('admin/create');
    }

    public function edit(User $user){
        return view('admin/edit', compact('user'));
    }

    // Enregistrer un administrateur en BD et envoyer un mail;
    public function store(storeAdminRequest $request)
{
    
     try{
        $user = new User();

          //Remplissez les champs de l'utilisateur
          $user->name = $request->name;
          $user->email = $request->email;
          $user->password = Hash::make('default'); 
         $user->save();

         // Envoyez un code par e-mail pour la vérification
         if ($user) {
             
             try{
                
                ResetCodePassword::where('email', $user->email)->delete();

            // Générez un code aléatoire
             $code = rand(1000, 4000);

             // Créez un enregistrement de code de réinitialisation
             $data = [
                 'code' => $code,
                 'email' => $user->email,
             ];
             ResetCodePassword::create($data);
             
             // Envoyez un e-mail avec le code
            
             Notification::route('mail', $user->email)->notify(new SendEmailToAdminAfterRegistrationNotification($code, $user->email)); 
             
             return redirect()->route('administrateurs')->with('success_message', 'Administrateur ajouté avec succès');
             }catch(Exception $e){
                 dd($e);
                 throw new Exception("Une erreur est survenue lors de l'envoi du mail");
             }
            
         }
       }catch (Exception $e){
         dd($e);
         return redirect()->back()->with('error_message', 'Une erreur est survenue lors de la création de cet administrateur');
    }
}

    public function update(User $user, UpdateAdminRequest $request)
     {

        try{
            //La logique de mis à jours
        $user->name = $request->name;
        $user->update();
        return redirect()->route('departements.index')
                         ->with('success_message','Departement mis à jours');;
        }catch (Exception $e){
            //dd($e);
            throw new Exception('Une erreur est survenue lors de la mis à jours des informations de cet administrateur');
        }
    }


    public function delete(User $user)
    {

              try{
                //La logique de suppression

                $connectedAdminId = Auth::user()->id;

                if($connectedAdminId != $user->id){
                    $user->delete();
                    return redirect()->back()->with('success_message', 'Ladministrateur a été retiré');
                }else{
                    return redirect()->back()->with('error_message', 'Vous ne pouvez pas supprimer votre compte administrateur');
                }
                
               }catch (Exception $e){
                
                 throw new Exception('Une erreur est survenue lors de la suppression du compte de cet administrateur');
                }

    }

    public function defineAccess($email){
       

        $scheckUserExist = User::where('email', $email)->first();
        
        if($scheckUserExist){
            return view('auth.validate-account', compact('email'));
        }else{
            return redirect()->route('login');
        }
    }

    public function submitDefineAccess(submitDefineAccessRequest $request, $email){
          
          try{
            $user = User::where('email', $request->email)->first();
            if($user){
                $user->password = Hash::make($request->password);
                $user->email_verified_at = Carbon::now();
                $user->update();

                //Si la mise à jours s'est fait correctement
                if ($user) {
                    $existingCode = ResetCodePassword::where('email', $user->email)->count();

                    if($existingCode > 1){
                        $existingCode = ResetCodePassword::where('email', $user->email)->delte();
                    }
                    
                }

                return redirect()->route('defineAccess', ['email' => $email])->with('success_message','Vos accès ont été correctement défini');;
            }else{
                //404
            }
          }catch(Exception $e){
          
          }
    }
}
