<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use DB;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    public function unsubscribe(Request $request)
    {
        $email = $request->query('email');

        Subscription::where('email', $email)
            ->update([
                'is_active' => false,
                'unsubscribed_at' => now(),
            ]);

        $data['header_title'] = __('dashboard.unsubscribed offers emails');
        return view('emails.unsubscribed', $data);
    }

    public function removeDuplicates()
    {
        // Get the unique IDs to keep (minimum ID per email)
        $idsToKeep = DB::table('subscriptions')
            ->select(DB::raw('MIN(id) as id'))
            ->groupBy('email')
            ->pluck('id')
            ->toArray();

        // Delete all others
        $deleted = DB::table('subscriptions')
            ->whereNotIn('id', $idsToKeep)
            ->delete();

        return redirect('/')
            ->with('success', "$deleted duplicate subscriptions removed.");
    }
}
