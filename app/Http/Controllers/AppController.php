<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use App\Models\Departement;
use App\Models\Employer;
use App\Models\User;
use Carbon\Carbon;

class AppController extends Controller
{
    public function index(){
        $totalDepartements = Departement::all()->count();
        $totalEmployers = Employer::all()->count();
        $totalAdministrateurs = User::all()->count();

         //$appName = Configuration::where('type', 'APP_NAME')->first();
       
        $defaultPaymentDate = null;
        $paymentNotifications = "";
        $currentDate = Carbon::now()->day;

        
        $defaultPaymentDateQuery =  Configuration::where('type', 'PAYMENT_DATE')->first();
        
        if($defaultPaymentDateQuery){
            $defaultPaymentDate = $defaultPaymentDateQuery->valeur;
            $convertedPaymentDate = intval($defaultPaymentDate); 
           
            if($currentDate < $convertedPaymentDate){
                $paymentNotifications = " Le paiement doit avoir lieu le ". $defaultPaymentDate ." de ce mois ";
            }else{
                $nextMonth = Carbon::now()->addMonth();
                $nextMonthName = $nextMonth->format('F');
                $paymentNotifications = " Le paiement doit avoir lieu le ". $defaultPaymentDate ." du mois ". $nextMonthName;
            }
            

        }
        
        return view('dashboard', compact('totalDepartements', 'totalEmployers', 'totalAdministrateurs', 'paymentNotifications'));
    }
}
