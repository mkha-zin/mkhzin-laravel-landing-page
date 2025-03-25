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
    protected $dataFetcherService;

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
            ->where('offers.end_date', '>=', date('Y-m-d'))
            ->where('offers.is_active', 1)
            ->where('offers.branch_id', $id)
            ->join('branches', 'branches.id', '=', 'offers.branch_id')
            ->orderBy('offers.end_date', 'desc')
            ->get();

        $data['cities'] = City::all();
        return view('offers', $data);
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

    public function viewPdf($id)
    {
        $offer = Offer::query()
            ->where('id', $id)
            ->first();
        if ($offer->pdf_file) {
            return Redirect::to('offersfiles/extrcs/' . $offer->id . '/' . 'index.html');
        }

        return view('errors.404');
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

    public function departments($key): Factory|View|Application|\Illuminate\View\View
    {
        $department = Department::query()->where('key', $key)->first();
        $data['department'] = $department;
        $data['branches'] = Branch::query()->where('type', $key)->get();

        $data['header_title'] = $department->title_ar . ' - ' . $department->title_en;

        return view('departments', $data);
    }


    public function joinUs(HttpRequest $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'regex:/^(\S+\s+){2,}\S+$/', // Ensures at least 3 words
                'max:255',
            ],
            'phone' => [
                'required',
                'regex:/^05\d{8}$/', // Ensures the number starts with 05 and is 10 digits
            ],
            'email' => 'required|email|unique:applicators,email',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'social_profiles' => 'required|array|min:1', // At least one social media profile required
            'social_profiles.*' => 'nullable|url',
            'cv' => 'nullable|file|mimes:pdf|max:10240', // Max 10MB PDF
            'license' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'description' => [
                'required',
                'string',
                'min:15', // At least 15 words
            ],
        ], [
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'الاسم يجب أن يكون نصًا',
            'name.regex' => 'الرجاء كتابة الاسم الثلاثي على الأقل',
            'name.max' => 'يجب ألا يتجاوز الاسم 255 حرفًا',

            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.regex' => 'يجب أن يكون رقم الهاتف رقمًا سعوديًا صحيحًا من 10 أرقام ويبدأ بـ 05',

            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'يجب إدخال بريد إلكتروني صحيح',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل',

            'city.required' => 'المدينة مطلوبة',
            'city.string' => 'يجب أن تكون المدينة نصًا',
            'city.max' => 'يجب ألا يتجاوز اسم المدينة 100 حرف',

            'district.required' => 'الحي مطلوب',
            'district.string' => 'يجب أن يكون الحي نصًا',
            'district.max' => 'يجب ألا يتجاوز اسم الحي 100 حرف',

            'social_profiles.required' => 'يجب إدخال رابط واحد على الأقل لوسائل التواصل الاجتماعي',
            'social_profiles.array' => 'يجب أن تكون وسائل التواصل الاجتماعي في شكل قائمة',
            'social_profiles.min' => 'يجب إضافة رابط واحد على الأقل لوسائل التواصل الاجتماعي',
            'social_profiles.*.url' => 'يجب أن يكون الرابط المضاف صحيحًا',

            'cv.file' => 'يجب أن يكون الملف المرفق صالحًا',
            'cv.mimes' => 'يجب أن تكون السيرة الذاتية بصيغة PDF فقط',
            'cv.max' => 'يجب ألا يتجاوز حجم السيرة الذاتية 10 ميغابايت',

            'license.file' => 'يجب أن يكون الملف المرفق صالحًا',
            'license.mimes' => 'يجب أن يكون الترخيص بصيغة JPG أو JPEG أو PNG',
            'license.max' => 'يجب ألا يتجاوز حجم ملف الترخيص 2 ميغابايت',

            'description.required' => 'الوصف مطلوب',
            'description.string' => 'يجب أن يكون الوصف نصًا',
            'description.min' => 'يجب أن يكون الوصف لا يقل عن 15 كلمة',
        ]);

        // Handle file uploads
        $cvPath = $request->file('cv')->store('assets/files/users/cv_uploads', 'public');
        $licensePath = $request->file('license') ? $request->file('license')->store('assets/files/users/license_uploads', 'public') : null;

        // Save application
        Applicator::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'city' => $validated['city'],
            'district' => $validated['district'],
            'social_profiles' => $validated['social_profiles'] ?? [],
            'cv_path' => $cvPath,
            'license_path' => $licensePath,
            'description' => $validated['description'],
        ]);


        return back()->with('success', 'تم إرسال الطلب بنجاح!');
    }
}


