<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Configuration;
use App\Models\Employer;
use Carbon\Carbon;
use Exception;
use PDF;
use Illuminate\Support\Str;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index(){

        $defaultPaymentDateQuery =  Configuration::where('type', 'PAYMENT_DATE')->first();
        $defaultPaymentDate = $defaultPaymentDateQuery->valeur;
        $convertedPaymentDate = intval($defaultPaymentDate);
        $today = date('d');
        
        $isPaymentDay = false;
        if($today == $convertedPaymentDate){
            $isPaymentDay = true;
        }
        $paiements = Paiement::latest()->orderBy('id', 'desc')->paginate(10);
        return view('paiements.index', compact('paiements', 'isPaymentDay'));
    }

    public function initPayment(){
       $monthMapping = [
        'JANUARY' => 'JANVIER', 
        'FEBRUARY' => 'FEVRIER', 
        'MARCH' => 'MARS', 
        'APRIL' => 'AVRIL', 
        'MAY' => 'MAI', 
        'JUNE' => 'JUIN', 
        'JULY' => 'JUILLET', 
        'AUGUST' => 'AOUT', 
        'SEPTEMBER' => 'SEPTEMBRE', 
        'OCTOBER' => 'OCTOBRE', 
        'NOVEMBER' => 'NOVEMBRE', 
        'DECEMBER' => 'DECEMBRE'];

        $currentMonth = strtoupper(Carbon::now()->formatLocalized('%B'));
        
        $currentMonthInFrench = $monthMapping[$currentMonth] ?? '';
       
        $currentYear = Carbon::now()->format('Y');
        
        //Simuler des paiements pour tous les employés dans le mois en cours. Les paiements concernent les employés qui n'ont pas encore été payé dans le mois actuel.
        
        //Recuperer la liste des employés qui n'ont pas encore été payé pour le mois en cours
        $employers = Employer::whereDoesntHave('payments', function($query) use($currentMonthInFrench, $currentYear){
            $query -> where('mois', '=', $currentMonthInFrench)->where('annee', '=', $currentYear);

        })->get();
       
        if($employers->count() == 0){
            return redirect()->back()->with('success_message', ' Tous les employés ont été payés pour ce mois de ' . $currentMonthInFrench );
        }
        // Faire les paiements pour ces employés

        foreach($employers as $employer){
            $aEtePayer = $employer->payments()-> where('mois', '=', $currentMonthInFrench)->where('annee', '=', $currentYear)->exists(); 
        

        if(!$aEtePayer){
            $salaire = $employer->montant_journalier * 31;

            $payment = new Paiement([
                'reference' => strtoupper(Str::random(10)),
                'employer_id' => $employer->id,
                'montant' => $salaire,
                'date_lancement' => now(),
                'done_time' => now(),
                'status' => 'SUCCESS',
                'mois' => $currentMonthInFrench,
                'annee' => $currentYear 
            ]);
            $payment->save();
        }
       
    }
    //Rediriger
    return redirect()->back()->with('success_message', 'Paiement des employés effectué pour le mois de ' . $currentMonthInFrench);
  }

    public function downloadInvoice(Paiement $paiement){
        try{
            $fullPaymentInfo = Paiement::with('employer')->find($paiement->id);


            // return view('paiements.facture', compact('fullPaymentInfo'));

            $pdf = PDF::loadView('paiements.facture', compact('fullPaymentInfo'));
            return $pdf->download('facture_' .$fullPaymentInfo->employer->firstname.'.pdf');
        }catch(Exception $e){
            throw new Exception("Une erreur est survenue lors du téléchargement de la facture");
        }

    }
}