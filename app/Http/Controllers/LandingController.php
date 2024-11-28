<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AboutCard;
use App\Models\Branch;
use App\Models\Career;
use App\Models\City;
use App\Models\ContactImage;
use App\Models\ContactInfo;
use App\Models\Fleet;
use App\Models\Hero;
use App\Models\Offer;
use App\Models\OurValue;
use App\Models\Section;
use App\Models\SocialLink;
use App\Models\Storage;
use App\Models\Subscription;
use App\Models\VisionAndGoal;
use App\Models\VisitorMessage;
use Request;

class LandingController extends Controller
{
    public function index()
    {
        $data['heroes'] = Hero::query()->get();
        $data['ourValues'] = OurValue::query()->get();
        $data['about'] = About::query()->first();
        $data['aboutCards'] = AboutCard::query()->get();
//        $data['departments'] = Section::query()->where('show_in_home',1)->limit(3)->get();
        $data['departments'] = Section::query()->get();
        $data['vision'] = VisionAndGoal::query()->where('slug', 'vision')->first();
        $data['goals'] = VisionAndGoal::query()->where('slug', 'goals')->first();
        $data['storage'] = Storage::query()->first();
        $data['fleet'] = Fleet::query()->first();
        $data['contactInfos'] = ContactInfo::query()->get();
        $data['contact_first_image'] = ContactImage::query()->first();
        $data['contact_second_image'] = ContactImage::all()->last();

        $socialLinks = SocialLink::query()->get();

        return view('index', $data, compact('socialLinks'));
    }

    public function sections()
    {
        $data['departments'] = Section::query()->get();
        return view('sections', $data);
    }

    public function sectionDetails($id)
    {
        $data['section'] = Section::query()->where('id', $id)->first();
        return view('section_details', $data);
    }

    /*public function offers()
    {
        $data['offers'] = Offer::query()
            ->get();
        return view('offers', $data);

        $return = Offer::select('offers.*');

        if (!empty(Request::get('city'))) {
            if (Request::get('city') != 'all') {
                $return = $return->where('offers.branch.city_id', Request::get('city') );
            }
        }

        $data['cities'] = City::all();
        $data['offers'] = $return->get();
        return view('offers', $data);
    }*/

    public function offers()
    {
        $return = Offer::select('offers.*')
            ->join('branches', 'branches.id', '=', 'offers.branch_id')
        ->orderBy('offers.end_date', 'desc');

        if (!empty(Request::get('city'))) {
            if (Request::get('city') != 'all') {
                $return = $return->where('branches.city_id', Request::get('city'));
            }
        }

        $data['cities'] = City::all();
        $data['branches'] = Branch::all();
        $data['offers'] = $return->get();
        return view('offers', $data);
    }



    public function visitorMsg(Request $request)
    {
        VisitorMessage::query()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect('/#contact-us')->with('success', __('landing.Success Message'));
    }

    public function subscribe(Request $request)
    {
        Subscription::query()->create([
            'email' => $request->email,
        ]);

        $referer = request()->headers->get('referer');

        if ($referer && $referer === url('') . '/') {
            return redirect('/#subscribe')->with('success', __('landing.Subscribed Successfully'));
        }

        return redirect()->back()->with('success', __('landing.Subscribed Successfully'));

    }

    public function about()
    {
        $data['about'] = About::query()->first();
        $data['aboutCards'] = AboutCard::query()->get();
        return view('about_us', $data);
    }
    public function jobs()
    {
        $data['job'] = Career::query()
            ->first();
        return view('jobs', $data);
    }
    public function branches()
    {
        $return = Branch::select('branches.*');

        if (!empty(Request::get('city'))) {
            if (Request::get('city') != 'all') {
                $return = $return->where('branches.city_id', Request::get('city') );
            }
        }

        $data['cities'] = City::all();
        $data['branches'] = $return->get();
        return view('branches', $data);
    }
    public function branchOffers($id)
    {
        $data['offers'] = Offer::query()
            ->where('branch_id', $id)
            ->with('branch')
            ->get();
        return view('offers', $data);
    }

    public function contact()
    {
        $data['contactInfos'] = ContactInfo::query()->get();
        $data['contact_first_image'] = ContactImage::query()->first();
        $data['contact_second_image'] = ContactImage::all()->last();
        return view('contact_us', $data);
    }
    public function vision()
    {
        $data['vision'] = VisionAndGoal::query()
            ->where('slug', 'vision')
            ->first();
        return view('vision', $data);
    }
    public function goals()
    {
        $data['goals'] = VisionAndGoal::query()
            ->where('slug', 'goals')
            ->first();
        return view('goals', $data);
    }
    public function fleet()
    {
        $data['fleet'] = Fleet::query()
            ->first();
        return view('fleet', $data);
    }
    public function storage()
    {
        $data['storage'] = Storage::query()
            ->first();
        return view('storage', $data);
    }

    public function viewPdf($id)
    {
        $offer = Offer::query()
            ->where('id', $id)
            ->first();
        if ($offer->pdf_file) {
            return response()->file('storage/' . $offer->pdf_file);
        }

        return view('404');
    }
}


