<?php

namespace App\Http\Controllers;

use App\Mail\JobSeekerCVMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendCV() {
        Mail::to(auth()->user()->email)->send(new JobSeekerCVMail());
    }
}
