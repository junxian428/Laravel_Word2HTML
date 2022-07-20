<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use PDF;
use Illuminate\Support\Facades\Storage;

require "pdfcrowd.php";

class UploadFileController extends Controller
{
    public function index() {
        return view('uploadfile');
     }
     public function showUploadFile(Request $request) {
        $file = $request->file('image');
        $content = $request->file('image')->get();
        $fileName = $file->getClientOriginalName();
         //Move Uploaded File
        $destinationPath = 'uploads';
        $file->move($destinationPath,$file->getClientOriginalName());


        
        $template = new \PhpOffice\PhpWord\TemplateProcessor(public_path('uploads/'.$fileName));
        /*@ Save Temporary Word File With New Name */
        $saveDocPath = public_path('new-result.docx');
        $template->saveAs($saveDocPath);
        $Content = \PhpOffice\PhpWord\IOFactory::load($saveDocPath); 

        // Load temporarily create word file
        $templates = \PhpOffice\PhpWord\IOFactory::load($saveDocPath); 
 
        //Save it into PDF
        $savePdfPath = public_path('storage/new-result.html');
 
        /*@ If already PDF exists then delete it */
        if ( file_exists($savePdfPath) ) {
            unlink($savePdfPath);
        }
 
        //Save it into PDF
        $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content,'HTML');
        $PDFWriter->save($savePdfPath); 

        //try
      //{
         // create the API client instance
         //$client = new \Pdfcrowd\HtmlToPdfClient("demo", "ce544b6ea52a5621fb9d55f8b542d14d");

         // run the conversion and write the result to a file
         //$client->convertUrlToFile("new-result.html", "example.pdf");
         //echo "<script>window.open(public_path('new-result.html'), '_blank')</script>";
         //$client -> convertFile('C:/Users/junxian428/Desktop/WORD_PDF/WORD_PDF_EXCEL/public/new-result.html', "example.pdf");
         //echo '<script>window.open("http://addr.com", "_blank", "width=400,height=500")</script>';
         //echo route('download');

         //$client->convertUrlToFile("https://45ba-2001-e68-540b-fc41-710a-df82-a640-a03a.ap.ngrok.io/storage/new-result.html", "hello.pdf");

      //}
      //catch(\Pdfcrowd\Error $why)
      //{
         // report the error
         //error_log("Pdfcrowd Error: {$why}\n");

          // rethrow or handle the exception
         //throw $why;
      //}

        echo 'File has been successfully converted';
        //echo Storage::url($file);
        //echo '<br>';
        //echo '<button><a href="new-result" download>Download</button>';
         
        /*@ Remove temporarily created word file */
        if ( file_exists($saveDocPath) ) {
            unlink($saveDocPath);
        }

        //$saveDocPath = public_path('new-result.docx');
        //$content->saveAs($saveDocPath);
        //echo $content;
        //echo '<br>';

        //Display File Name
        //echo 'File Name: '.$file->getClientOriginalName();
        //echo '<br>';
     
        //Display File Extension
        //echo 'File Extension: '.$file->getClientOriginalExtension();
        //echo '<br>';
     
        //Display File Real Path
        //echo 'File Real Path: '.$file->getRealPath();
        //echo '<br>';
     
        //Display File Size
        //echo 'File Size: '.$file->getSize();
        //echo '<br>';
     
        //Display File Mime Type
        //echo 'File Mime Type: '.$file->getMimeType();
     
    

     }

  
}
