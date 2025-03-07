<?php

namespace App\Http\Controllers\Admin\Setting\NewsLetter;

use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsLetterEmail;
use App\Models\NewsLetter;
use Exception;

class NewsLetterCreateComponent extends Component
{
    use LivewireAlert, WithFileUploads;

    public $image;

    /**
     * Handle the form submission.
     *
     * @return void
     */

    public function save()
    {
        $validated = $this->validate([
            'image' => 'required|image|max:1024', // Validate image is required and of maximum 1MB
        ]);

        try {
            // Retrieve the image file from Livewire
            $image = $this->image;

            if (!$image) {
                throw new \Exception('Image is null or not properly uploaded.');
            }


            $imagePath = $image->store('newsletter_image', 'public');

            // <img src="{{ $message->embed(public().'/2_Banner.jpg') }}">
            // Get all email addresses from the NewsLetter model
            $emails = NewsLetter::pluck('email');

            if ($emails->isEmpty()) {
                $this->alert('info', 'No recipients found.');
                return;
            }

            // Send the email to each address
            foreach ($emails as $email) {
                Mail::to($email)->cc('swainmr20@gmail.com')->send(new NewsLetterEmail($imagePath));
            }

            $this->alert('success', Lang::get('messages.newsletter_save'));
        } catch (\Exception $e) {
            $this->alert('error', 'Failed to process the newsletter. Please try again.');
            \Log::error('Error processing newsletter: ' . $e->getMessage());
        }

        return redirect()->route('admin.newsletter.create');
    }
    /**
     * Render the component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('admin.setting.news-letter.news-letter-create-component');
    }
}
