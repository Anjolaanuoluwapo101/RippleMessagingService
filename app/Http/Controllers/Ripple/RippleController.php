<?php

namespace App\Http\Controllers\Ripple;

use App\Http\Controllers\Controller;
use App\Models\Ripple;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Resources\RippleResource;

class RippleController extends Controller
{

  /**
  * Display a listing of the resource.
  */
  public function index() {
    //
  }

  /**
  * This creates a new message of whatever nest level.
  */
  public function create(Request $request, Ripple $ripple) {
    //code to check that user(person making this request) is logged in ...
    //validation

    $validated = $request->validate([
      'ripple_reference_id' => 'string', //(if it's empty..then the user is creating a new post)
      'rippler_reference_id' => 'string', //(if it's empty..then the user is creating a new post)
      'ripple_body' => 'max:150', //the rippler_body
    ]);

    //after basic validation
    //check if it's a nested ripple(message) that's..a reply to an older message
    if ($request->filled('ripple_reference_id')) {
      //if it's...we will need to get some data from the older message
      $recipientMessage = Ripple::where('ripple_id', request()->input('ripple_reference_id'))->first(); //get the message being
      $rippleNestLevel = $recipientMessage->ripple_nest_level;
      //update the tagged list...
      $arrayOfRipplersTagged = unserialize($recipientMessage->ripplers_tagged); //returns an array
      $arrayOfRipplersTagged[] = request()->input('rippler_reference_id');
      $jsonArrayOfRipplersTagged = serialize($arrayOfRipplersTagged);
    }



    //upload files if present
    $pathToStoredFiles = $this->uploadFiles($request, new Ripple);
    //upload message body if present
    $messageBodyFilePath = $this->storeMessageBody($request);
    //getting ready to save the ripple to database
    $newMessage = Ripple::make([
      //'rippler_id' => auth()->user()->rippler_id,
      //'rippler_id' => request('rippler_id'),
      'ripple_body' => $messageBodyFilePath,
      'encrypted_url' => request()->route('encrypted_url'),
    ]);


    if (!empty(request()->session()->get('rippler_id'))) {
      //we a user logs in normally(not via api)..his rippler id is put in a session data
      $newMessage->rippler_id = request()->session()->get('rippler_id');
    } else {
      $newMessage->rippler_id = request('rippler_id');
    }
    //saves file path if ripple contained media..
    if (!empty($pathToStoredFiles)) {
      $newMessage->ripple_attachments = serialize($pathToStoredFiles);
    }
    //the next if block only runs for non-post ripples
    if (!empty($arrayOfRipplersTagged)) {
      $newMessage->rippler_reference_id = request()->input("rippler_reference_id");
      $newMessage->ripple_reference_id = request()->input("ripple_reference_id");
      $newMessage->ripplers_tagged = $jsonArrayOfRipplersTagged;
      $newMessage->ripple_nest_level = $rippleNestLevel + 1;
    }
    
    
    $newMessage->save(); //persist the ripple in database
    return "saved";


  }

  // This method helps process&store the files attached to a ripple
  public function uploadFiles(Request $request, Ripple $ripple):array {
    //a variable that stores all uploaded files
    $pathToStoredFiles = [];
    // Get the array of uploaded files...
    //Note to frontend...ensure that the file input(s) has a name of "files[]"
    $uploadedFiles = $request->file('files');
    // Check if files were uploaded
    if ($uploadedFiles) {
      //loop through each files
      foreach ($uploadedFiles as $file) {
        // Check if the file is valid
        if ($file->isValid()) {
          //we get the mime type of the uploaded file to determine were to store the file
          if (in_array($file->extension(), $ripple->imageMimeTypes)) {
            $fileNewPath = "app/Ripple/ripple_attachments/Images/".Str::random(10).".".$file->extension();
            move_uploaded_file($file->path(), "../storage/".$fileNewPath);
            $pathToStoredFiles[] = $fileNewPath; //stores image in Image folder
          } else if (in_array($file->extension(), $ripple->videoMimeTypes)) {
            $fileNewPath = "app/Ripple/ripple_attachments/Videos/".Str::random(10).".".$file->extension();
            move_uploaded_file($file->path(), "../storage/".$fileNewPath);
            $pathToStoredFiles[] = $fileNewPath; //stores image in Image folder
            //$pathToStoredFiles[] = $file->store("app/Ripple/ripple_attachments/Videos");
          } else if (in_array($file->extension(), $ripple->audioMimeTypes)) {
            $fileNewPath = "app/Ripple/ripple_attachments/Audios/".Str::random(10).".".$file->extension();
            move_uploaded_file($file->path(), "../storage/".$fileNewPath);
            $pathToStoredFiles[] = $fileNewPath; //stores image in Image folder
            //$pathToStoredFiles[] = $file->store("app/Ripple/ripple_attachments/Audios");
          }
        }
      }
    }
    return $pathToStoredFiles;
  }

  //This method helps process&store the message body (text) of the ripple
  public function storeMessageBody(Request $request) {
    //laravel storage function not working so I'm using the normo PHP function
    try {
      $messageBodyFilePath = "app/Ripple/ripple_body/".Str::random(10).".txt";
      $fp = fopen("../storage/".$messageBodyFilePath, "w");
      fwrite($fp, $request->input('ripple_body'));
      fclose($fp);
      return $messageBodyFilePath;
    }catch(Exception $e) {
      return false;
    }
  }

  //get nest level 0 ripples..e.g the comment on a fb post
  public function getRipplesForUrl() {
    $url = Url::where('encrypted_url', '=', request()->route('encrypted_url'))->first();
    return $url->getRipplesAssociatedToPost();
  }

  /**
  * gets any other nest level n+1 ripples related to a particular ripple of nest level n
  */
  public function getRelatedRipples() {
    return new RippleResource(Ripple::findOrfail(request()->route('ripple_id')));
  }

  /**
  * Update the specified resource in storage.
  */
  public function update(Request $request, Rippler $rippler) {
    //
  }

  /**
  * Remove the specified resource from storage.
  */
  public function destroy(Rippler $rippler) {
    //
  }
}