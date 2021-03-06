<?php

namespace App\Http\Controllers\volunteer;

use App\Models\User;
use App\Models\Prize;
use App\Mail\NewOrder;
use App\Models\Volunteer;
use App\Models\Order_prize;
use Illuminate\Http\Request;
use App\Mail\NewVolunteerMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VPrizesController extends Controller
{
    public function list()
    {
        $prizes = Prize::with('prize_translate')->get();
        return view('volunteer.prizes.list', ['prizes' => $prizes]);
    }

    public function prize($id)
    {
        $prize = Prize::where('id', $id)->with('prize_translate')->first();
        $points = Volunteer::where('user_id', Auth::id())->pluck('points')->first();

        return view('volunteer.prizes.prize', ['prize' => $prize, 'points' => $points]);
    }

    public function get_prize(Request $request, $id)
    {
        $validated = $request->validate(['info' => 'max:255']);
        $volunteer = Volunteer::where('user_id', Auth::id())->first();
        $prize = Prize::where('id', $id)->first();

        if ($request->info == null)
        {
            $info = "brak informacji";
        } else {
            $info = $request->info;
        }

        if ($volunteer->points >= $prize->points)
        {
            $order = Order_prize::create([
                'volunteer_id' => Auth::id(),
                'prize_id' => $id,
                'info' => $info,
                'condition' => 0,
            ]);

            $new_quantity = $prize->quantity - 1;
            $prize->quantity = $new_quantity;
            $prize->save();

            $new_points = $volunteer->points - $prize->points;
            $volunteer->points = $new_points;
            $volunteer->save();

            $datam = array(
                'name' => 'test',
                'link' => route('c.prize.order', [$order->id]),
            );

            Mail::to(User::where('role', 'coordinator')->get()->pluck('email'))->send(new NewOrder($datam));

            return redirect(route('v.prize', [$id]))->with(['order' => true]);
        } else {
            return redirect(route('v.prize', [$id]))->with(['points_order' => false]);
        }
    }

    public function orders()
    {
        $orders = Order_prize::where('volunteer_id', Auth::id())->with(['d_prize', 'prize'])->orderBy('id', 'DESC')->get();
        return view('volunteer.prizes.orders', ['orders' => $orders]);
    }
}
