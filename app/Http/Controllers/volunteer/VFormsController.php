<?php

namespace App\Http\Controllers\volunteer;

use App\Models\Form;
use App\Models\Signed_form;
use Illuminate\Http\Request;
use App\Models\Position_form;
use Elibyy\TCPDF\Facades\TCPDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VFormsController extends Controller
{
    public function list()
    {
        $forms = Form::with(['form_translate'])->withCount('signed_form')->get();

        return view('volunteer.forms.list', ['forms' => $forms]);

    }

    public function form($id)
    {
        $form = Form::where('id', $id)->with('form_translate', 'calendar')->first();
        $form_positions = Position_form::where('form_id', $id)->with('translate_form_position')->withCount('signed_form')->get();
        $signed_volunteers = Signed_form::where('form_id', $id)->with(['volunteer', 'position'])->get();
        $signed_volunteer = Signed_form::where([
            ['volunteer_id', '=', Auth::id()],
            ['form_id', '=', $id],
        ])->with(['post_form', 'trans_position'])->first();

        dd($form);

        return view('volunteer.forms.form', ['form' => $form,'form_positions' => $form_positions, 'signed_volunteers' => $signed_volunteers, 'signed_volunteer' => $signed_volunteer]);
    }

    public function signto(Request $request, $id)
    {
        $position = Position_form::where([
            ['id', '=', $request->position],
            ['form_id', '=', $id],
        ])->count();

        if ($position == 1)
        {

            $signed = Signed_form::create([
                'volunteer_id' => Auth::id(),
                'form_id' => $id,
                'position_id' => $request->position,
                'condition' => 0
            ]);

            return redirect(route('v.form.show', [$id]))->with(['signed_form' => true]);

        } else {

        }
    }

    public function unsign(Request $request, $id)
    {
        $signed = Signed_form::where([
            ['id', '=', $request->position],
            ['form_id', '=', $id],
            ['volunteer_id', '=', Auth::id()]
        ])->delete();

        return redirect(route('v.form.show', [$id]))->with(['delete_sign' => true]);
    }

    public function certificate(Request $request)
    {
        $form = Form::where('id', $request->form)->with('form_translate', 'calendar')->first();
        $signed = Signed_form::where([
            ['form_id', $form->id],
            ['volunteer_id', Auth::id()]
        ])->first();

        $pdf = new TCPDF();
        $pdf::SetTitle('Lista wolontariuszy');
        $pdf::AddPage("P");
        $lg['a_meta_charset'] = 'UTF-8';
        $pdf::setLanguageArray($lg);
        $pdf::SetFont('dejavusans', '', 12, '', true);

        if (Auth::user()->gender == "f")
            {
                $p = array("Odbyła", "realizowała", "jej", "Wykazała", "przyczyniła");
            } else if (Auth::user()->gender = "m")
            {
                $p = array("Odbył", "realizował", "mu", "Wykazał", "przyczynił");
            }

        //$pdf::Image('https://panel.wolontariat.rybnik.pl/assets/img/herb-rybnika-k.png', '', '15', '', 17, 'PNG');
            //$pdf::Image('https://panel.wolontariat.rybnik.pl/assets/img/logo-wmr.png', '', '', '', 23, 'PNG', '', '', false, 300, 'C', false, false, 1, false, false, false);
            //$pdf::Image('https://wolontariat.rybnik.pl/assets/images/4cfc1f8e1d2bd343736a91af28784171_mosirlogo.png', '', '16', '', 13, 'PNG', '', '', false, 300, 'R', false, false, 1, false, false, false);
            $html = '
            <p style="text-align:right;">Rybnik, dnia '.date("d.m.Y", strtotime($form->calendar->end)).'r. </p>
            <p style="text-align:right">Zaświadczenie nr '.$signed->id.'</p>
            <p></p>
            <p style="text-align:center">Zaświadcza się, że</p>
            <p></p>
            <p style="text-align:center; font-weight:bold">'.Auth::user()->firstname.' '.Auth::user()->lastname.'</p>
            <p></p>
            <p style="text-align:center">'.$p[0].' wolontariat w dniu w trakcie organizacji</p>
            <p></p>
            <p style="text-align:center; font-weight:bold">'.$form->form_translate->title.'</p>
            <p></p>
            <p style="text-align:center;">'.Auth::user()->firstname.' '.$p[1].' powierzone '.$p[2].' powierzone zadania z należytą starannością i zaangażowaniem. '.$p[3].' się również otwartością oraz umiejętnością współpracy w zespole, czym '.$p[4].' się do sukcesu imprezy. </p>
            <p></p><p></p><p></p>
            <table style="width: 100%;">
            <tr style="font-weight:bold;"><td>Administrator systemu</td><td style="text-align:right;">Dział organizacji imprez</td></tr>
            <tr><td></td></tr>
            <tr><td>Denis Bichler</td><td style="text-align:right;">Wiktoria Wistuba</td></tr>
            </table>';
            //<<<EOD EOD;
            $pdf::writeHTML($html, true, false, true, false, '');

            $text1 = '<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>';
            $text11 = '<p style="font-size:8px; text-align:center;">Zaświadczenie zostało wygenerowane automatycznie.</p>';
            $text2 = '<p style="font-size:8px; text-align:center;">By zweryfikować prawdziwość zaświadczenia, proszę napisać na adres: administrator@wolontariat.rybnik.pl</p>';
            $pdf::writeHTML($text1, true, false, true, false, '');
            $pdf::writeHTML($text11, true, false, true, false, '');
            $pdf::writeHTML($text2, true, false, true, false, '');

        $pdf::Output('hello.pdf');
    }

}
