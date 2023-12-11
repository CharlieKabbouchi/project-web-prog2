<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;



use Kreait\Laravel\Firebase\Facades\Firebase;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Storage;

// use Kreait\Firebase\Database;

class FirebaseController extends Controller {

    public function index() {
        $firebase = (new Factory)
            ->withServiceAccount(__DIR__ . '/fir-test-8bd2c-firebase-adminsdk-2xqtn-9215548462.json')
            ->withDatabaseUri('https://fir-test-8bd2c-default-rtdb.europe-west1.firebasedatabase.app/');

        $database = $firebase->createDatabase();

        $blog = $database
            ->getReference('blog');

        echo '<pre>';
        print_r($blog->getvalue());
        echo '</pre>';
    }

    public function showUploadForm() {
        return view('upload');
    }


    public function uploadImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $fileContents = file_get_contents($image->getPathname());
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $filePath = 'images/' . $imageName;

        // Laravel Storage operations
        $laravelDisk = Storage::disk('gcs');

        // Upload the image using Laravel Storage
        $laravelDisk->put($filePath, $fileContents);

        // Check if the uploaded image exists
        $exists = $laravelDisk->exists($filePath);

        // Get the last modified time of the uploaded image
        $time = $laravelDisk->lastModified($filePath);

        // Firebase Storage operations
        $firebaseStorage = Firebase::storage();
        $firebaseBucket = $firebaseStorage->getBucket();

        // Upload the image to Firebase Storage
        $firebaseObject = $firebaseBucket->upload($fileContents, [
            'name' => $filePath,
        ]);

        // Get the public URL of the uploaded image from Firebase
        $firebaseImageUrl = $firebaseObject->signedUrl(new \DateTime('+5 minutes'));

        // You can save $firebaseImageUrl to your database if needed

        return response()->json(['success' => true, 'url' => $firebaseImageUrl,]);
    }



    public function showImageGallery()
    {
        // Firebase Storage operations
        $firebaseStorage = Firebase::storage();
        $firebaseBucket = $firebaseStorage->getBucket();

        // Specify the path to the directory where your images are stored
        $directory = 'images/';

        // Get the list of objects (files) in the specified directory
        $objects = $firebaseBucket->objects(['prefix' => $directory]);

        // Retrieve the signed URLs and image names for the images
        $images = [];
        foreach ($objects as $object) {
            $imageUrls[] = $object->signedUrl(new \DateTime('+5 minutes'));
            $imageName = basename($object->name());
            if ($imageName !== 'images') {
                $images[] = ['url' => $object->signedUrl(new \DateTime('+5 minutes')), 'name' => $imageName];
            }
            // $images[] = ['url' => $object->signedUrl(new \DateTime('+5 minutes')), 'name' => $imageName];
        }
        // dd($images);

        return view('image-gallery', compact('images'));
    }
}


