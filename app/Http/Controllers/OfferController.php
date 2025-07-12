<?php

namespace App\Http\Controllers;

use App\Mail\OffersEmail;
use App\Models\Offer;
use App\Models\Subscription;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OfferController extends Controller
{

    public function unsubscribe(Request $request) {
            $email = $request->query('email');

            Subscription::where('email', $email)
                ->update([
                    'is_active' => false,
                    'unsubscribed_at' => now(),
                ]);

            $data['header_title'] = __('dashboard.unsubscribed offers emails');
            return view('emails.unsubscribed', $data);
    }
}
