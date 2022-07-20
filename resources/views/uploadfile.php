<html>
   <body>
      <?php
        echo '<h1>Word to PDF</h1>';
    

         echo Form::open(array('url' => '/uploadfile','files'=>'true'));
         echo 'Select the file to upload.';
         echo Form::file('image');
         echo Form::submit('Upload File');
         echo Form::close();
      ?>

      
   </body>
</html>