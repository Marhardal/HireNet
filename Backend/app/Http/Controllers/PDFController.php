<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Resume;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function load($id)
    {
        $user = auth()->user();
        $resumes = Resume::where('user_id', $id)->get()->first();
        return view('resume.template1')->with(['resumes' => $resumes]);
        // $pdf = PDF::loadView('resume.template1', compact('resumes'));
        // return $pdf->download("Resume.pdf");
        // $pdf = Pdf::loadView('resume.template1', $resumes);
    }

    public function Download($id)
    {
        $resumes = Resume::where('user_id', auth()->user()->id)->get()->first();
        $pdf = PDF::loadView('resume.template1', compact('resumes'));
        return $pdf->download($resumes->user->first_name . " " . $resumes->user->surname . ".pdf");
    }



    public function showResume($postId, $userId)
    {
        $post = Post::find($postId);
        $applicant = $post->users()->wherePivot('user_id', $userId)->get();
        $path = storage_path('app/'.$applicant->first()->pivot->document);
        // if (Storage::disk('public')->exists("storage".$applicant->first()->pivot->document)) {
            // dd($path);
            // return response()->json([$path, $applicant, $post], 200);
            return response()->file($path);
        // }else {
        //     // dd("public/storage/".$applicant->first()->pivot->document);
        //     dd($path);
        // }
    }
}
