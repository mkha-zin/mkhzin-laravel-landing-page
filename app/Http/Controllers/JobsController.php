<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Career;
use Filament\Notifications\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JobsController extends Controller
{

    public function index()
    {
        $jobs = Career::where('is_active', true)->latest()->get();
        return view('jobs.index', compact('jobs'));
    }

    public function apply($job)
    {
        if (!($job instanceof Career)) {
            $job = Career::findOrFail($job);
        }

        if (is_string($job->questions)) {
            $job->questions = json_decode($job->questions, true);
        }

        return view('jobs.apply', compact('job'));
    }


    public function storeGeneral(Request $request): RedirectResponse
    {
        $messages = [
            'name.required' => __('validation.required', ['attribute' => __('home.Your Name')]),
            'email.required' => __('validation.required', ['attribute' => __('home.Your Email')]),
            'email.email' => __('validation.email', ['attribute' => __('home.Your Email')]),
            'phone.required' => __('validation.required', ['attribute' => __('home.Phone Number')]),
            'phone.regex' => __('validation.phone_format', ['attribute' => __('home.Phone Number')]),
            'address.required' => __('validation.required', ['attribute' => __('home.Address')]),
            'resume.required' => __('validation.required', ['attribute' => __('home.Upload Resume')]),
            'resume.file' => __('validation.file', ['attribute' => __('home.Upload Resume')]),
            'resume.mimes' => __('validation.mimes', ['attribute' => __('home.Upload Resume'), 'values' => 'pdf, doc, docx']),
            'resume.max' => __('validation.max.file', ['attribute' => __('home.Upload Resume'), 'max' => 10240]),
            'last_job.required' => __('validation.required', ['attribute' => __('home.Last Job')]),
            'last_job.max' => __('validation.max.string', ['attribute' => __('home.Last Job'), 'max' => 255]),
            'about_you.required' => __('validation.required', ['attribute' => __('home.why hire')]),
            'about_you.max' => __('validation.max.string', ['attribute' => __('home.why hire'), 'max' => 1000]),
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => ['required', 'string', 'regex:/^\+\d{10,15}$/'],
            'address' => 'required|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'last_job' => 'required|string|max:255',
            'about_you' => 'required|string|max:1000',
        ], $messages);

        $path = $request->file('resume')->store('resumes', 'public');

        $answers = [
            [
                'question' => __('home.Last Job'),
                'answer' => $validated['last_job'],
                'type' => 'text',
            ],
            [
                'question' => __('home.why hire'),
                'answer' => $validated['about_you'],
                'type' => 'text',
            ],
        ];

        Application::create([
            'job_id' => null,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'resume_link' => $path,
            'answers' => json_encode($answers),
        ]);

        return redirect()->route('jobs.index')->with('success', __('home.Application submitted successfully!'));
    }


    public function store(Request $request, Career $job): RedirectResponse
    {
        // Validation with custom error messages using __() for translation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => [
                'required',
                'string',
                'regex:/^\+\d{10,15}$/'
            ],
            'address' => 'required|string|max:255',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'questions' => 'nullable|array',
            'questions.*.answer' => 'required_with:questions|string',
            'questions.*.question' => 'required_with:questions|string',
            'questions.*.type' => 'required_with:questions|string',
        ], [
            'name.required' => __('validation.required', ['attribute' => __('home.Your Name')]),
            'email.required' => __('validation.required', ['attribute' => __('home.Your Email')]),
            'phone.required' => __('validation.required', ['attribute' => __('home.Phone Number')]),
            'address.required' => __('validation.required', ['attribute' => __('home.Address')]),
            'resume.required' => __('validation.required', ['attribute' => __('home.resume')]),
            'resume.mimes' => __('validation.mimes', ['attribute' => __('home.Upload Resume'), 'values' => 'pdf, doc, docx']),
            'questions.*.answer.required_with' => __('validation.required', ['attribute' => __('home.answer')]),
            'questions.*.question.required_with' => __('validation.required', ['attribute' => __('home.Job Questions')]),
            'questions.*.type.required_with' => __('validation.required', ['attribute' => __('home.Type')]),
            'phone.regex' => __('validation.phone_format', ['attribute' => __('home.Phone Number')]),
        ]);

        // Handle resume file upload
        $resumePath = $request->file('resume')->store('resumes', 'public');

        // Create Job Application record
        $application = Application::create([
            'job_id' => $job->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'resume_link' => $resumePath,
        ]);

        // Save questions as JSON if present
        if (!empty($validated['questions'])) {
            $application->answers = json_encode($validated['questions'], JSON_UNESCAPED_UNICODE);
            $application->save();
        }

        return redirect()->back()->with('success', __('home.Application submitted successfully!'));
    }

    public function download()
    {
        $filePath = public_path('storage/' . request()->resume_link);

        /*dd($filePath);*/
        if (!file_exists($filePath)) {
            Notification::make()
                ->title(__('dashboard.file not found'))
                ->danger()
                ->send();

            return redirect()->back();
        }

        Notification::make()
            ->title(__('dashboard.Resume was downloaded successfully'))
            ->success()
            ->send();

        return response()->download($filePath);
    }


}
