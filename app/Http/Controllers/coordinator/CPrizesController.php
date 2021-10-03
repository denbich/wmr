<?php

namespace App\Http\Controllers\coordinator;

use App\Models\Prize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order_prize;
use App\Models\Translate_form;
use App\Models\Translate_prize;

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
        ]);

        $prize = Prize::create([
            'quantity' => $request->quantity,
            'points' => $request->points,
            'icon_src' => 'https://panel.wolontariat.rybnik.pl/zdjecia/nag/KZpPxSIT0XdFFqII5iEtA0c5PwQUqukbzMkXY9lkGOuZSTVdiBAvkfMfs86kB0Imo6d6Q8pkmyqYYuu1xPEGbTMSkt3WwdCQK92B1612354027.png',
        ]);

        $prize_t = Translate_prize::create([
            'prize_id' => $prize->id,
            'locale' => $request->locale,
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
        ]);

        return redirect(route('c.prize.show', [$prize->id]))->with(['created_prize' => true]);
    }

    public function show($id)
    {
        $prize = Prize::find($id)->with('prize_translate')->first();
        $orders = Order_prize::where('prize_id', $id)->with('volunteer')->get();

        return view('coordinator.prizes.show', ['prize' => $prize, 'orders' => $orders]);
    }

    public function edit($id)
    {
        $prize = Prize::find($id)->with('prize_translate')->first();

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
            'description' => $request->description,
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
        $prize = Prize::find($id);
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
        $orders = Order_prize::with(['volunteer', 'd_prize', 'prize'])->get();
        return view('coordinator.prizes.orders', ['orders' => $orders]);
    }

    public function order($id)
    {
        $order = Order_prize::find($id)->with(['volunteer', 'd_prize', 'prize'])->first();
        return view('coordinator.prizes.order', ['order' => $order]);
    }

    public function change_status(Request $request, $id)
    {
        $order = Order_prize::find($id);
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
