<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function show(): View
    {
        return view('pages.contact');
    }

    /**
     * Handle contact form submission.
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        try {
            Contact::create($request->validated());

            return redirect()->back()->with('success', 'Pesan berhasil dikirim! Terima kasih telah menghubungi kami.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Pesan gagal dikirim. Silakan coba lagi nanti.')
                ->withInput();
        }
    }
}
