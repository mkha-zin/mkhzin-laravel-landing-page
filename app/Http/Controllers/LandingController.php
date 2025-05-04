<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AboutCard;
use App\Models\Applicator;
use App\Models\Branch;
use App\Models\Career;
use App\Models\City;
use App\Models\ContactImage;
use App\Models\ContactInfo;
use App\Models\Department;
use App\Models\Fleet;
use App\Models\Offer;
use App\Models\Post;
use App\Models\Section;
use App\Models\Storage;
use App\Models\Subscription;
use App\Models\Tag;
use App\Models\VisionAndGoal;
use App\Models\VisitorMessage;
use App\Models\Voucher;
use App\Services\DataFetcherService;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Redirect;
use Request;

class LandingController extends Controller
{
    protected DataFetcherService $dataFetcherService;

    public function __construct(DataFetcherService $dataFetcherService)
    {
        $this->dataFetcherService = $dataFetcherService;
    }

    public function index(): Factory|View|Application|\Illuminate\View\View
    {
        $data = $this->dataFetcherService->fetchData();
        $data['posts'] = Post::query()
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        return view('index', $data);
    }

    public function sections(): Factory|View|Application|\Illuminate\View\View
    {
        $data['departments'] = Section::query()->get();
        return view('sections', $data);
    }

    public function sectionDetails($id): Factory|View|Application|\Illuminate\View\View
    {
        $data['section'] = Section::query()->where('id', $id)->first();
        return view('section_details', $data);
    }

    public function offers(): Factory|View|Application|\Illuminate\View\View
    {
        $city = Request::get('city');
        $data['offers'] = $this->dataFetcherService->getActiveOffers($city);
        $data['cities'] = $this->dataFetcherService->getCities();
        $data['branches'] = $this->dataFetcherService->getBranches();

        return view('offers', $data);
    }

    public function visitorMsg(HttpRequest $request): RedirectResponse
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

    public function subscribe(HttpRequest $request): RedirectResponse
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

    public function about(): Factory|View|Application|\Illuminate\View\View
    {
        $data['about'] = About::query()->first();
        $data['aboutCards'] = AboutCard::query()->get();
        return view('about_us', $data);
    }

    public function jobs(): Factory|View|Application|\Illuminate\View\View
    {
        $data['job'] = Career::query()
            ->first();
        return view('jobs', $data);
    }

    public function blog(HttpRequest $request)
    {
        $tagId = $request->query('tag'); // Correct method to get the query parameter

        // Fetch posts with their tag details and filter if a tag is selected
        $query = Post::with('tag');
        if ($tagId) {
            $query->where('tag_id', $tagId);
        }
        $data['posts'] = $query->orderBy('created_at', 'desc')->get();

        // Fetch all tags with the count of related posts
        $data['tags'] = Tag::withCount('posts')->get();

        return view('blog', $data);
    }

    public function post($id)
    {
        $post = Post::with('tag')->findOrFail($id);

        $relatedPosts = Post::where('tag_id', $post->tag_id)
            ->where('id', '!=', $id)
            ->with('tag')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('post', [
            'post' => $post,
            'posts' => $relatedPosts
        ]);
    }

    public function branches(): Factory|View|Application|\Illuminate\View\View
    {
        $return = Branch::select('branches.*');

        if (!empty(Request::get('city')) && Request::get('city') !== 'all') {
            $return = $return->where('branches.city_id', Request::get('city'));
        }

        $data['cities'] = City::all();
        $data['branches'] = $return->get();
        return view('branches', $data);
    }

    public function branchOffers($id): Factory|View|Application|\Illuminate\View\View
    {
        $data['offers'] = Offer::select('offers.*')
            ->where('offers.is_active', 1)
            ->where('offers.branch_id', $id)
            ->join('branches', 'branches.id', '=', 'offers.branch_id')
            ->orderBy('offers.end_date', 'desc')
            ->get();

        $data['cities'] = City::all();
        return view('offers', $data);
    }

    public function branchDetails($id)
    {
        $data['branch'] = Branch::find($id);
        $data['markers'] = Branch::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get()
            ->map(function ($branch) {
                return [
                    'lat' => (float) $branch->latitude,
                    'lng' => (float) $branch->longitude,
                    'popup' => '<strong>' . e(data_get($branch, \App::currentLocale() === 'ar' ? 'name_ar' : 'name_en', '')) . '</strong>',
                ];
            })
            ->values()
            ->toArray();

        return view('branch', $data);
    }

    public function contact(): Factory|View|Application|\Illuminate\View\View
    {
        $data['contactInfos'] = ContactInfo::query()->get();
        $data['contact_first_image'] = ContactImage::query()->first();
        $data['contact_second_image'] = ContactImage::all()->last();
        return view('contact_us', $data);
    }

    public function vision(): Factory|View|Application|\Illuminate\View\View
    {
        $data['vision'] = VisionAndGoal::query()
            ->where('slug', 'vision')
            ->first();
        return view('vision', $data);
    }

    public function goals(): Factory|View|Application|\Illuminate\View\View
    {
        $data['goals'] = VisionAndGoal::query()
            ->where('slug', 'goals')
            ->first();
        return view('goals', $data);
    }

    public function fleet(): Factory|View|Application|\Illuminate\View\View
    {
        $data['fleet'] = Fleet::query()
            ->first();
        return view('fleet', $data);
    }

    public function storage(): Factory|View|Application|\Illuminate\View\View
    {
        $data['storage'] = Storage::query()
            ->first();
        return view('storage', $data);
    }

    /**
     * @noinspection PhpVoidFunctionResultUsedInspection
     * @noinspection UnknownColumnInspection
     */
    public function viewPdf($id)
    {
        $offer = Offer::query()
            ->where('id', $id)
            ->first();
        if ($offer->pdf_file) {
            return Redirect::to('offersfiles/extrcs/' . $offer->id . '/' . 'index.html');
        }

        return abort(404);
    }

    public function vouchers(): Factory|View|Application|\Illuminate\View\View
    {
        return view('vouchers');
    }

    public function checkVouchers(): RedirectResponse
    {
        $vocherNumber = request()->voucher_number;
        $is_allowed = Voucher::query()
            ->where('voucher', $vocherNumber)
            ->where('used', false)
            ->exists();

        if ($is_allowed) {
            session()->put('voucher', $vocherNumber);
            return redirect()->back()->with('success', __('landing.Voucher Found'));
        }

        return redirect()->back()->with('error', __('landing.Not Found or Already Used'));
    }

    public function useVoucher(): RedirectResponse
    {
        $voucher = session()->get('voucher');
        $c_name = request()->c_name;
        $phone = request()->phone;

        if ($voucher) {
            $is_allowed = Voucher::query()
                ->where('voucher', $voucher)
                ->where('used', false)
                ->exists();
            if ($is_allowed) {
                Voucher::query()
                    ->where('voucher', $voucher)
                    ->update([
                        'used' => true,
                        'c_name' => $c_name,
                        'phone' => $phone,
                        'using_date' => now(),
                    ]);
                session()->remove('voucher');
                return redirect()->back()->with('success', __('landing.Used Successfully'));
            }

            session()->remove('voucher');
            return redirect()->back()->with('error', __('landing.Already Used'));
        }

        return redirect()->back();
    }

    public function cancelVoucher(): RedirectResponse
    {
        session()->remove('voucher');
        return redirect()->back();
    }

    public function downloadApplicatorFiles()
    {
        $filePath = public_path("storage/" . request()->record);

        if (!file_exists($filePath)) {
            Notification::make()
                ->title(__('dashboard.file not found'))
                ->danger()
                ->send();

            return redirect()->back();
        }
        return response()->download($filePath);
    }

    public function download()
    {
        $filePath = public_path("storage/filament_exports/" . request()->key . "/" . request()->record . ".xlsx");

//        dd($filePath . " - " . file_exists($filePath));
        if (!file_exists($filePath)) {
            Notification::make()
                ->title(__('dashboard.file not found'))
                ->danger()
                ->send();

            return redirect()->back();
        }

        return response()->download($filePath);
    }

    public function departments($key): Factory|View|Application|\Illuminate\View\View
    {
        $department = Department::query()->where('key', $key)->first();
        $data['department'] = $department;
        $data['branches'] = Branch::query()->where('type', $key)->get();

        $data['header_title'] = $department->title_ar . ' - ' . $department->title_en;

        return view('departments', $data);
    }
}


