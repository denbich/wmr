<?php

namespace App\Http\Controllers\coordinator;

use App\Models\Prize;
use App\Models\Order_prize;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Translate_form;
use App\Models\Translate_prize;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CPrizesController extends Controller
{

    public function index()
    {
        $prizes = Prize::with('prize_translate')->get();
        return view('coordinator.prizes.list', ['prizes' => $prizes]);
    }

    public function create()
    {
        return view('coordinator.prizes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required|max:255',
            'points' => 'required|numeric',
            'quantity' => 'required|numeric',
            'icon' => 'required',
        ]);

        $image_64 = $request->icon;
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $replace = substr($image_64, 0, strpos($image_64, ',')+1);
        $image = str_replace($replace, '', $image_64);
        $image = str_replace(' ', '+', $image);

        $imageName = Str::random(100).time().'.'.$extension;
        Storage::disk('prizes')->put($imageName, base64_decode($image));

        $prize = Prize::create([
            'quantity' => $request->quantity,
            'points' => $request->points,
            'icon_src' => '/prizes/'.$imageName,
        ]);

        $prize_t = Translate_prize::create([
            'prize_id' => $prize->id,
            'locale' => $request->locale,
            'title' => $request->title,
            'description' => str_replace('"', "'", str_replace(PHP_EOL, '', $request->description)),
            'category' => $request->category,
        ]);

        return redirect(route('c.prize.show', [$prize->id]))->with(['created_prize' => true]);
    }

    public function show($id)
    {
        $prize = Prize::where('id', $id)->with('prize_translate')->first();
        $orders = Order_prize::where('prize_id', $id)->with('volunteer')->get();

        return view('coordinator.prizes.show', ['prize' => $prize, 'orders' => $orders]);
    }

    public function edit($id)
    {
        $prize = Prize::where('id', $id)->with('prize_translate')->first();
        dd(str_replace('"', "'", str_replace("\r\n", '', $prize->prize_translate->description)));
        return view('coordinator.prizes.edit', ['prize' => $prize]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required|max:255',
            'points' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        $prize = Prize::find($id);
        $prize->fill([
            'points' => $request->points,
            'quantity' => $request->quantity,
            ]);
        $prize->save();

        $prize_t = Translate_prize::where('prize_id', $prize->id)->first();
        $prize_t->fill([
            'title' => $request->title,
            'description' => str_replace('"', "'", str_replace(PHP_EOL, '', $request->description)),
            'category' => $request->category,
            ]);
        $prize_t->save();

        return redirect(route('c.prize.edit', [$id]))->with(['edit_prize' => true]);
    }

    public function destroy($id)
    {
        Prize::where('id', $id)->delete();
        return redirect(route('c.prize.list'))->with(['delete_prize' => true]);
    }

    //OTHER FUNCTIONS

    public function update_quantity(Request $request, $id)
    {
        $validated = $request->validate(['quantity' => 'required|numeric']);
        $prize = Prize::where('id', $id)->first();
        $prize->fill(['quantity' => $request->quantity]);
        $prize->save();

        return redirect(route('c.prize.show', [$id]))->with(['update_quantity' => true]);
    }

    public function search()
    {
        if (isset($_GET['q']))
        {
            $q = $_GET['q'];
            $prizes = Prize::with('prize_translate')->whereHas('prize_translate', function ($query) use ($q){
                $query->where('title', 'like', '%'.$q.'%')->orwhere('category', 'like', '%'.$q.'%');})->get();
                return view('coordinator.prizes.search', ['prizes' => $prizes]);
        } else {
            return view('coordinator.prizes.search');
        }
    }

    public function orders()
    {
        $orders = Order_prize::with(['volunteer', 'd_prize', 'prize'])->orderBy('id', 'DESC')->get();
        return view('coordinator.prizes.orders', ['orders' => $orders]);
    }

    public function order($id)
    {
        $order = Order_prize::where('id', $id)->with(['volunteer', 'd_prize', 'prize'])->first();
        return view('coordinator.prizes.order', ['order' => $order]);
    }

    public function change_status(Request $request, $id)
    {
        $order = Order_prize::where('id', $id)->first();
        switch ($order->condition)
        {
            case 0:
                $condition = 1;
                break;
            case 1:
                $condition = 0;
                break;
        }
        $order->fill(['condition' => $condition]);
        $order->save();

        return redirect("/coordinator/prizes/orders/".$id)->with(['change_condition' => true]);
    }
}
