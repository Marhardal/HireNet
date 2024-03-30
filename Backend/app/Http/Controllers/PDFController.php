<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Resume;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function loadResume()
    {
        $user = User::get()->first();
        $resume = Resume::where('user_id', 6)->get();
        // dd($resume);
        return view('resume.template1')->with(['resumes'=>$resume]);

        // dd($resumes);
        // $pdf = PDF::loadView('resume.template1', compact('resumes'));
        // return $pdf->download("Resume.pdf");
        // $pdf = Pdf::loadView('pdf.invoice', $data);
    }

    public function showResume($postId, $userId)
    {
        $post = Post::find($postId);
        $applicant = $post->users()->wherePivot('user_id', $userId)->get();
        $path=storage_path($applicant->first()->pivot->document);
        return response()->file($path);
    }
}
