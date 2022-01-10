<?php

namespace App\Http\Controllers\coordinator;

use App\Models\User;
use App\Models\Volunteer;
use App\Models\Signed_form;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Elibyy\TCPDF\Facades\TCPDF;
use App\Exports\VolunteerExport;
use App\Mail\VolunteerActivation;
use App\Mail\VolunteerDeactivation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\Input;

class CVolunteerController extends Controller
{
    public function list()
    {
        //$volunteers = User::where('role', 'volunteer')->with('volunteer')->get();
        $volunteers = Volunteer::with('user')->get();
        return view('coordinator.volunteers.list', ['volunteers' => $volunteers]);
    }

    public function volunteer($id)
    {
        $volunteer = Volunteer::where('id', $id)->with('user')->first();
        $signed = Signed_form::where('volunteer_id', $volunteer->user_id)->with('trans_form', 'position')->get();

        return view('coordinator.volunteers.volunteer', ['volunteer' => $volunteer, 'signed' => $signed]);
    }

    public function search()
    {
        if (isset($_GET['q']))
        {
            $q = $_GET['q'];
            $volunteers = Volunteer::with('user')->whereHas('user', function ($query) use ($q){
                $query->where('name', 'like', '%'.$q.'%')->orwhere('firstname', 'like', '%'.$q.'%')->orwhere('lastname', 'like', '%'.$q.'%')->orwhere('email', 'like', '%'.$q.'%')->orWhere('telephone', 'like', '%'.$q.'%');})->orWhere('school', 'like', '%'.$q.'%')->get();
                return view('coordinator.volunteers.search', ['volunteers' => $volunteers]);
        } else {
            return view('coordinator.volunteers.search');
        }
    }

    public function export_list(Request $request, Excel $excel)
    {
        switch ($request->filetype)
        {
            case 'pdf':
                $volunteers = Volunteer::with('user')->get();
                $pdf = new TCPDF();
                $pdf::SetTitle('Lista wolontariuszy');
                $pdf::AddPage("L");
                $lg['a_meta_charset'] = 'UTF-8';
                $pdf::setLanguageArray($lg);
                $pdf::SetFont('dejavusans','b',15);

                $pdf::Cell(0, 15, 'Lista wolontariuszy - WMR na dzień '.date('d.m.Y'), 0, '1', 'C', 0, '', 0, false, 'M', 'M');

                $pdf::SetFont('dejavusans','b',10);

                $pdf::cell('15','10','ID','1','0','C');
                $pdf::cell('40','10','Login','1','0','C');
                $pdf::cell('45','10','Imię','1','0','C');
                $pdf::cell('45','10','Nazwisko','1','0','C');
                $pdf::cell('40','10','Nr telefonu','1','0','C');
                $pdf::cell('70','10','email','1','0','C');
                $pdf::cell('20','10','Roz. kosz.','1','1','C');

                $pdf::SetFont('dejavusans','',10);

                foreach ($volunteers as $volunteer)
                {
                    $pdf::cell('15','10', $volunteer->id,'1','0','C');
                    $pdf::cell('40','10', $volunteer->user->name,'1','0','C');
                    $pdf::cell('45','10', $volunteer->user->firstname,'1','0','C');
                    $pdf::cell('45','10', $volunteer->user->lastname,'1','0','C');
                    $pdf::cell('40','10' ,$volunteer->user->telephone,'1','0','C');
                    $pdf::cell('70','10', $volunteer->user->email,'1','0','C');
                    $pdf::cell('20','10', strtoupper($volunteer->tshirt_size),'1','1','C');
                }

                $pdf::Output('lista_wolontariuszy.pdf');
            break;

            case 'excel':
                return $excel->download(new VolunteerExport, 'wolontariusze_'.date('d.m.Y H.i').'.xlsx');
            break;

            case 'html':
                return $excel->download(new VolunteerExport, 'wolontariusze_'.date('d.m.Y H.i').'.html');
            break;
        }

    }

    public function active()
    {
        $volunteers = Volunteer::with('user')->whereHas('user', function ($query){
            $query->where('condition', '0');})->get();

        return view('coordinator.volunteers.active', ['volunteers' => $volunteers]);
    }

    public function activation(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|after:'.date('Y-m-d'),
        ]);
        $user = User::where('id', $request->id)->first();
        $user->update(['condition' => '1', 'agreement_date' => $request->date]);
        $datam = array('name' => $user->name);

        Mail::to($user->email)->send(new VolunteerActivation($datam));

        return redirect(route('c.v.active'))->with(['activation' => true]);
    }

    public function dactivation(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->update([
            'agreement_date' => date('Y-m-d', strtotime(date('Y-m-d')." - 1 day")),
            'condition' => 1,
        ]);

        switch ($request->reason) {
            case 1: $text = "Brak przedziału od kiedy można wykonywać wolontariat."; break;
            case 2: $text = "Wysłany plik to nie jest wypełniona zgoda."; break;
            case 3: $text = "Zgoda jest niewyraźna."; break;
            case 4: $text = "Brak podpisu rodzica/opiekuna prawnego."; break;
            case 5: $text = "Źle wypełniona zgoda."; break;
        }

        $datam = array(
            'name' => $user->name,
            'reason' => $text,
    );
        Mail::to($user->email)->send(new VolunteerDeactivation($datam));
        return redirect(route('c.v.active'))->with(['deactivation' => true]);
    }

    public function birthday()
    {
        $volunteers = Volunteer::with('user')->get();
        return response(view('coordinator.volunteers.birthday'));
    }

    public function agreement($volunteer)
    {
        $code = [
            substr($volunteer, 0, 1), //firstname
            substr($volunteer, 1, 1), //lastname
            substr($volunteer, 2, 4), //created_at
            substr($volunteer, 6, 1), //gender
            substr($volunteer, 7, 4), //agreement_src
            substr($volunteer, 11), //ID
        ];

        $volunteer_agreement = User::where('id', $code[5])->first();
        $ok = true;

        if ($code[0] != substr($volunteer_agreement->firstname, 0, 1)) $ok = false;
        if ($code[1] != substr($volunteer_agreement->lastname, 0, 1)) $ok = false;
        if ($code[2] != date('dm', strtotime($volunteer_agreement->created_at))) $ok = false;
        if ($code[3] != $volunteer_agreement->gender) $ok = false;
        if ($code[4] != date('dm', strtotime($volunteer_agreement->agreement_date))) $ok = false;

        if ($ok == true)
        {
            return response()->file(substr($volunteer_agreement->agreement_src, 1));
        } else {
            return redirect(route('c.v.active'));
        }
    }
}
