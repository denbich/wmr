<?php

namespace App\Http\Controllers\coordinator;

use App\Models\Form;
use App\Models\User;
use App\Mail\NewForm;
use App\Models\Calendar;
use App\Models\Volunteer;
use App\Models\Signed_form;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Position_form;
use App\Models\Translate_form;
use Elibyy\TCPDF\Facades\TCPDF;
use App\Http\Controllers\Controller;
use App\Mail\SetPositions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Translate_position_form;
use Illuminate\Support\Facades\Storage;

class CFormsController extends Controller
{
    public function index()
    {
        $forms = Form::with(['form_translate'])->whereHas('calendar', function ($query) {
            return $query->where('end', '>', date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').' - 7 days')));
        })->withCount('signed_form')->get();

        return view('coordinator.forms.list', ['forms' => $forms]);
    }

    public function create()
    {
        return view('coordinator.forms.new');
    }

    public function store(Request $request)
    {

        //if ($request->locale == "pl") {
            if ($request->positions_count != 0)
            {
                for ($i = 1; $i <= $request->positions_count; $i++)
                {
                    if ($i == 1) $vali_positions = [
                        'name_position_pol'.$i => 'required|max:255',
                        'desc_position_pol'.$i => 'required|max:255',
                        'points_position_pol'.$i => 'required|numeric|min:1',
                        'max_position_pol'.$i => 'required|numeric|min:1',
                    ];

                    $vali = [
                        'name_position_pol'.$i => 'required|max:255',
                        'desc_position_pol'.$i => 'required|max:255',
                        'points_position_pol'.$i => 'required|numeric|min:1',
                        'max_position_pol'.$i => 'required|numeric|min:1',
                    ];

                    $vali_positions = array_merge($vali_positions, $vali);

                }

            } else {
                $vali_positions = [
                    'positions_count' => 'required|numeric|min:1',
                ];
            }

        $vali_options = [
            'pl_title' => 'required|max:255',
            'pl_description' => 'required',
            'expiration' => 'required|date',
            'start' => 'required|date|after:expiration',
            'stop' => 'required|date|after:start',
            'place_longitude_pol' => 'required',
            'place_latitude_pol' => 'required',
            'icon' => 'required',
        ];

        $validator = array_merge($vali_options, $vali_positions);

        $validated = $request->validate($validator);

        $image_64 = $request->icon;
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $replace = substr($image_64, 0, strpos($image_64, ',')+1);
        $image = str_replace($replace, '', $image_64);
        $image = str_replace(' ', '+', $image);

        $imageName = Str::random(100).time().'.'.$extension;
        Storage::disk('forms')->put($imageName, base64_decode($image));

        $form = Form::create([
            'expiration' => $request->expiration,
            'place_longitude' => $request->place_longitude_pol,
            'place_latitude' => $request->place_latitude_pol,
            'icon_src' => '/forms/'.$imageName,
            'tag' => 'MOSiR',
            'author_id' => Auth::id(),
            'condition' => '0',
        ]);

        $form_tf = Translate_form::create([
            'form_id' => $form->id,
            'locale' => 'pl',
            'title' => $request->pl_title,
            'description' => str_replace('"', "'", str_replace("\r\n", '', $request->pl_description)),
        ]);

        for ($i = 1; $i <= $request->positions_count; $i++)
        {
            $p_points = 'points_position_pol'.$i;
            $p_max = 'max_position_pol'.$i;
            $position = Position_form::create([
                'form_id' => $form->id,
                'points' => $request->$p_points,
                'max_volunteer' => $request->$p_max,
            ]);

            $p_title = 'name_position_pol'.$i;
            $p_desc = 'desc_position_pol'.$i;
            $position_t = Translate_position_form::create([
                'position_id' => $position->id,
                'locale' => 'pl',
                'title' => $request->$p_title,
                'description' => $request->$p_desc,
            ]);
        }

        $calendar = Calendar::create([
            'form_id' => $form->id,
            'start' => $request->start,
            'end' => $request->stop,
            'title' => $request->pl_title,
        ]);

        $datam = array(
            'subject' => 'Nowy formularz - '.$request->pl_title,
            'title' => $request->pl_title,
            'expiration' => $request->expiration,
            'button-text' => 'Zapisz się',
            'button-link' => route('v.form.show', [$form->id])
        );

        Mail::bcc(User::where('role', 'volunteer')->pluck('email'))->send(new NewForm($datam));

        return redirect(route('c.form.list'))->with(['created_form' => true]);

    }

    public function show($id)
    {
        $form = Form::where('id', $id)->with('form_translate')->first(); //'form_position', 'form_position'
        $form_positions = Position_form::where('form_id', $id)->with('translate_form_position')->withCount('signed_form')->get();
        $signed_volunteers = Signed_form::where('form_id', $id)->with(['volunteer', 'position'])->get();

        $count = [
            'z' => Signed_form::where([['form_id', $id], ['condition', 0]])->count(),
            'o' => Signed_form::where([['form_id', $id], ['condition', 1]])->count(),
        ];

        return view('coordinator.forms.show', ['form' => $form,'form_positions' => $form_positions, 'signed_volunteers' => $signed_volunteers, 'count' => $count]);
    }

    public function edit($id)
    {
        $form = Form::where('id', $id)->with(['form_translate', 'calendar'])->first();
        $form_positions = Position_form::where('form_id', $id)->with('translate_form_position')->get();

        return view('coordinator.forms.edit', ['form' => $form,'form_positions' => $form_positions]);
    }

    public function update(Request $request, $id)
    {
        $form = Form::find($id);
        $form->fill([
            'place_longitude' => $request->place_longitude,
            'place_latitude' => $request->place_latitude,
        ]);
        $form->save();

        $translate_form = Translate_form::where('form_id', $id)->first();
        $translate_form->fill([
            'title' => $request->title,
            'description' => str_replace('"', "'", str_replace("\r\n", '', $request->description)),
        ])->save();

        for ($i = 1; $i <= $request->positions_number; $i++)
        {
            $tmp = "position_".$i;
            $tmp1 = "points_position".$i;
            $tmp2 = "max_position".$i;
            $position = Position_form::where('id', $request->$tmp)->first();
            $position->fill([
                'points' => $request->$tmp1,
                'max_volunteer' => $request->$tmp2,
            ]);
            $position->save();

            $tmp1 = "name_position".$i;
            $tmp2 = "desc_position".$i;
            $translate_position = Translate_position_form::where('position_id', $request->$tmp)->first();
            $translate_position->fill([
                'title' => $request->$tmp1,
                'description' => $request->$tmp2,
            ])->save();
        }
        return redirect(route('c.form.edit', [$id]))->with(['edit_form' => true]);
    }

    public function destroy($id)
    {
        Form::where('id', $id)->delete();
        return redirect(route('c.form.list'))->with(['delete_form' => true]);
    }

    public function volunteer_list($id)
    {
        $form = Form::where('id', $id)->with('form_translate')->first();
        $form_positions = Position_form::where('form_id', $id)->with('translate_form_position')->withCount('signed_form')->get();
        $signed_volunteers = Signed_form::where('form_id', $id)->with(['volunteer', 'position', 'volun'])->get();

        $pdf = new TCPDF();
        $pdf::SetTitle('Lista wolontariuszy');
        $pdf::AddPage("L");
        $lg['a_meta_charset'] = 'UTF-8';
        $pdf::setLanguageArray($lg);
        $pdf::SetFont('dejavusans','b',15);

        $pdf::Cell(0, 15, $form->form_translate->title.' - Lista zapisanych wolontariuszy', 0, '1', 'C', 0, '', 0, false, 'M', 'M');

        $pdf::SetFont('dejavusans','',10);
        $pdf::Cell(0, 10, 'Podpisując się niżej, oświadczasz iż jesteś zdrowy/a (w dniu imprezy nie wykazuję/ą objawów infekcji oraz objawów chorobowych sugerujących chorobę zakaźną) ', 0, '1', 'C', 0, '', 0, false, 'M', 'M');
        $pdf::Cell(0, 10, 'oraz w okresie 14 dni przed imprezą nie przebywałem/am/ali z osobą na kwarantannie oraz nie miałem/am/mieli kontaktu z osobą podejrzaną o zakażenie.', 0, '1', 'C', 0, '', 0, false, 'M', 'M');

        $pdf::SetFont('dejavusans','b',10);

        $pdf::cell('35','10','Login','1','0','C');
        $pdf::cell('45','10','Imię','1','0','C');
        $pdf::cell('45','10','Nazwisko','1','0','C');
        $pdf::cell('35','10','Nr telefonu','1','0','C');
        $pdf::cell('20','10','Koszulka','1','0','C');
        $pdf::cell('55','10','Stanowisko','1','0','C');
        $pdf::cell('40','10','Podpis','1','1','C');

        $pdf::SetFont('dejavusans','',10);

        foreach ($signed_volunteers as $sign)
        {
            $pdf::cell('35','10', $sign->volunteer->name,'1','0','C');
            $pdf::cell('45','10', $sign->volunteer->firstname,'1','0','C');
            $pdf::cell('45','10', $sign->volunteer->lastname,'1','0','C');
            $pdf::cell('35','10' ,$sign->volunteer->telephone,'1','0','C');
            $pdf::cell('20','10', $sign->volun->tshirt_size,'1','0','C');
            $pdf::cell('55','10', $sign->position->title,'1','0','C');
            $pdf::cell('40','10', "",'1','1','C');
        }

        $pdf::Output( $form->form_translate->title.'_lista_wolontariuszy.pdf');
    }

    public function stop_sign(Request $request, $id)
    {
        $form = Form::find($id);
        $form->expiration = date('Y-m-d H:i');
        $form->save();

        return redirect(route('c.form.show', [$id]))->with(['succes_stop' => true]);
    }

    public function archive()
    {
        $forms = Form::with(['form_translate'])->whereHas('calendar', function ($query) {
            return $query->where('end', '>', date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').' + 7 days')));
        })->withCount('signed_form')->get();

        return view('coordinator.forms.archive', ['forms' => $forms]);
    }

    public function start_sign(Request $request, $id)
    {
        $validated = $request->validate(['end' => 'required|after: '.date('Y-m-d H:i')]);

        $form = Form::find($id);
        $form->expiration = $request->end;
        $form->save();

        return redirect(route('c.form.show', [$id]))->with(['succes_start' => true]);
    }

    public function positions($id)
    {
        $form = Form::where('id', $id)->with('form_translate')->first();
        $form_positions = Position_form::where('form_id', $id)->with('translate_form_position')->withCount('signed_form')->get();
        $signed_volunteers = Signed_form::where('form_id', $id)->with(['volunteer', 'position'])->get();

        return view('coordinator.forms.positions', ['form' => $form,'form_positions' => $form_positions, 'signed_volunteers' => $signed_volunteers]);
    }

    public function set_positions(Request $request, $id)
    {
        $signed_volunteers = Signed_form::where('form_id', $id)->with('form')->get();
        $form = Form::where('id', $id)->with('form_translate')->first();
        foreach ($signed_volunteers as $sign)
        {
            $v_id = $sign->id;
            $sign->position_id = $request->$v_id;
            $sign->condition = 1;
            $sign->save();
        }

        $datam = array(
            'subject' => 'Stanowiska zostały przydzielone na imprezę '.$form->form_translate->title,
            'title' => $form->form_translate->title,
            'link' => route('v.form.show', [$id]),
        );

        Mail::bcc(Signed_form::where('form_id', $id)->with('volunteer')->get()->pluck('volunteer.email'))->send(new SetPositions($datam));
        return redirect(route('c.form.positions', [$id]))->with(['succes_set' => true]);
    }

    public function presence($id)
    {
        $form = Form::where('id', $id)->with('form_translate')->first();
        $form_positions = Position_form::where('form_id', $id)->with('translate_form_position')->withCount('signed_form')->get();
        $signed_volunteers = Signed_form::where('form_id', $id)->with(['volunteer', 'position'])->get();

        return view('coordinator.forms.presence', ['form' => $form,'form_positions' => $form_positions, 'signed_volunteers' => $signed_volunteers]);
    }

    public function save_presence(Request $request, $id)
    {
        $signed_volunteers = Signed_form::where('form_id', $id)->get();
        foreach ($signed_volunteers as $sign)
        {
            $v_id = $sign->id;
            if ($request->$v_id == "true")
            {
                $sign->condition = 3;

                $volunteer = Volunteer::where('user_id', $sign->volunteer_id)->first();
                $points = $volunteer->points + $sign->post_form->points;
                $volunteer->points = $points;

                $volunteer->save();
            } elseif ($request->$v_id == "false") {
                $sign->condition = 2;
            }

            $sign->save();
        }

        return redirect(route('c.form.show', [$id]))->with(['succes_presence' => true]);

    }

    public function view_presence($id)
    {
        $form = Form::where('id', $id)->with('form_translate')->first();
        $form_positions = Position_form::where('form_id', $id)->with('translate_form_position')->withCount('signed_form')->get();
        $signed_volunteers = Signed_form::where('form_id', $id)->with(['volunteer', 'position'])->get();

        return view('coordinator.forms.viewpresence', ['form' => $form,'form_positions' => $form_positions, 'signed_volunteers' => $signed_volunteers]);
    }
}
