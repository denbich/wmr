<?php

namespace App\Http\Controllers\coordinator;

use App\Models\Form;
use App\Models\Calendar;
use App\Models\Signed_form;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Position_form;
use App\Models\Translate_form;
use Elibyy\TCPDF\Facades\TCPDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Translate_position_form;
use Illuminate\Support\Facades\Storage;

class CFormsController extends Controller
{
    public function index()
    {
        $forms = Form::with(['form_translate'])->withCount('signed_form')->get();

        return view('coordinator.forms.list', ['forms' => $forms]);
    }

    public function archive()
    {
        return "archive";
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

        dd($imageName);
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
            'description' => str_replace('"', "'", str_replace(PHP_EOL, '', $request->pl_description)),
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

        return redirect(route('c.form.list'))->with(['created_form' => true]);

    }

    public function show($id)
    {
        $form = Form::where('id', $id)->with('form_translate')->first(); //'form_position', 'form_position'
        $form_positions = Position_form::where('form_id', $id)->with('translate_form_position')->withCount('signed_form')->get();
        $signed_volunteers = Signed_form::where('form_id', $id)->with(['volunteer', 'position'])->get();

        //dd($form);

        return view('coordinator.forms.show', ['form' => $form,'form_positions' => $form_positions, 'signed_volunteers' => $signed_volunteers]);
    }

    public function edit($id)
    {
        $form = Form::where('id', $id)->with(['form_translate', 'calendar'])->first();
        $form_positions = Position_form::where('form_id', $id)->with('translate_form_position')->get();

        //dd($form->calendar);

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
            'description' => $request->description,
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
        $signed_volunteers = Signed_form::where('form_id', $id)->with(['volunteer', 'position'])->get();

        //echo base_path() . '/vendor/tecnickcom\tcpdf\TCPDF';

        //$pdf = new TCPDF();
        //$pdf::SetTitle('Lista wolontariuszy');
        //$pdf::AddPage("L");

        //$pdf::Cell(0, 10, $form->form_translate->title.' - Lista zapisanych wolontariuszy', 0, '1', 'C', 0, '', 0, false, 'M', 'M');

        //$pdf::Output('hello.pdf');
    }
}
