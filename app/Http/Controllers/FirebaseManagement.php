<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Storage;
use Illuminate\Support\Facades\Storage as LaravelStorage;

class FirebaseManagement extends Controller
{
    /**
     * Display the form for file upload.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('uploadtest');
    }

    /**
     * Handle the file upload.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:doc,docx,pdf|max:10240', // Adjust the allowed file types and maximum size
        ]);

        $file = $request->file('file');

        // Generate a unique filename
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        // Upload the file to Firebase Storage
        $firebaseStorage = Firebase::storage();
        $firebaseStorage->getBucket()->upload(
            $file->getContent(),
            ['name' => 'uploads/' . $filename]
        );

        return redirect()->back()->with('success', 'File uploaded successfully!');
    }

    /**
     * Download a file from Firebase Storage.
     *
     * @param  string  $filename
     * @return \Illuminate\Http\Response
     */
    public function download($filename)
    {
        $firebaseStorage = Firebase::storage();
        $file = $firebaseStorage->getBucket()->object('uploads/' . $filename);

        // Download the file to a local temporary file
        $tempFilePath = tempnam(sys_get_temp_dir(), 'downloaded_file');
        $file->downloadToFile($tempFilePath);

        // Return the file as a response
        return LaravelStorage::download($tempFilePath, $filename);
    }
}
