<?php

namespace App\Http\Controllers\Ripple;

use App\Http\Controllers\Controller;
use App\Models\Ripple;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RippleController extends Controller
{

  /**
  * Display a listing of the resource.
  */
  public function index() {
    //
  }

  /**
  * Show the form for creating a new resource.
  */
  public function create(Request $request, Ripple $ripple) {
    //code to check that user(person making this request) is logged in ...
    //validation
    /*
        $validated = $request->validate([
          'sender_name' => 'string',//same as rippler_name/user's name
          'sender_id' => 'integer',//same as rippler_id..the user sending the message
          'recipient_message_id' => 'integer',//same as ripple_reference_id(if it's empty..then the user is creating a new post)
          'message_body' => 'required|max:255',//the rippler_body
          ]);
          */
    //after basic validation
    //get some required attributes
    //if recipient_message_id is empty...then the user is creating a post..if not he's either replying  post or replying in general
    if ($request->filled('ripple_reference_id')) {
      $rippleIsAPost = false;//this block run if the ripple sent to the backend is a reply/comment/reply of reply /reply to a comment...as long as it's not a post(that's not under any other ripple)
      $recipientMessage = Ripple::where('id', $request->input('ripple_reference_id'))->first(); //get the message being 
      $rippleNestLevel = $recipientMessage->ripple_nest_level;
      //update the tagged list
      $arrayOfRipplersTagged = $recipientMessage->ripplers_tagged; //returns an array
      $arrayOfRipplersTagged[] = $request->input('rippler_reference_id');
      $jsonArrayOfRipplersTagged = json_encode($arrayOfRipplersTagged);
    }else{
      //this else block runs if the ripple sent to the backend is a post
      $rippleIsAPost = true;
    }
    
    try {
      //upload files if present
      $pathToStoredFiles = $this->uploadFiles($request, new Ripple);
      //upload message body
      $messageBodyFilePath= $this->storeMessageBody($request);
      //getting ready to save the ripple to database
      $newMessage = Ripple::make([
        'rippler_id' => $request->input('rippler_id'),
        'rippler_email' => $request->input('rippler_email'),
        'ripple_body' => $messageBodyFilePath,
        ]);
     //file path is saved 
      if(!empty($pathToStoredFiles)){
        $newMessage->ripple_attachments = json_encode($pathToStoredFiles);
      }
      //the next if block only runs for non-post ripples
      else if(!empty($arrayOfRipplersTagged)){
        $newMessage->rippler_reference_id = $request->input("rippler_reference_id");
        $newMessage->ripple_reference_id = $request->input("ripple_reference_id");
        $newMessage->ripplers_tagged = $jsonArrayOfRipplersTagged;
        $newMessage->ripple_nest_level = $rippleNestLevel + 1;
      }
      $newMessage->save(); //persist the ripple in database
      
    }catch(Exception $e) {
      return "Something Went Wrong".$e->getMessage();
    }
  }
  /**
  * 
  * This method stores files
  */
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

  /**
  * store MessageBody
  */
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

  /**
  * Show the form for editing the specified resource.
  */
  public function edit(Ripple $ripple) {
    //
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