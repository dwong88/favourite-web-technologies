<?php
header('Access-Control-Allow-Origin: *');
   // Define database connection parameters
   $hn      = 'localhost';
   $un      = 'root';
   $pwd     = '12345678';
   $db      = 'ionic';
   $cs      = 'utf8';

   // Set up the PDO parameters
   $dsn 	= "mysql:host=" . $hn . ";port=3306;dbname=" . $db . ";charset=" . $cs;
   $opt 	= array(
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_EMULATE_PREPARES   => false,
                       );
   // Create a PDO instance (connect to the database)
   $pdo 	= new PDO($dsn, $un, $pwd, $opt);


   // Retrieve the posted data
   $json    =  file_get_contents('php://input');
   $obj     =  json_decode($json);
   $key     =  strip_tags($obj->key);

   // Determine which mode is being requested
   switch($key)
   {

      // Add a new record to the technologies table
      case "create":
          echo "string david";
         // Sanitise URL supplied values
         /*$namaDepan     = filter_var($_REQUEST  ['namaDepan'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $namaBelakang  = filter_var($_REQUEST  ['namaBelakang'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $jenisKelamin  = filter_var($_REQUEST  ['jenisKelamin'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $alamat        = filter_var($_REQUEST  ['alamat'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $noTelp        = filter_var($_REQUEST  ['noTelp'], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
         $email         = filter_var($_REQUEST  ['email'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);*/


         $namaDepan     = filter_var($obj->namaDepan, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $namaBelakang  = filter_var($obj->namaBelakang, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $jenisKelamin  = filter_var($obj->jenisKelamin, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $alamat        = filter_var($obj->alamat, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $noTelp        = filter_var($obj->noTelp, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
         $email         = filter_var($obj->email, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);

         // Attempt to run PDO prepared statement
         try {
            $sql 	= "INSERT INTO biodata(namaDepan,namaBelakang,jenisKelamin,alamat,noTelp,email) VALUES(:namaDepan,:namaBelakang,:jenisKelamin,:alamat,:noTelp,:email)";
            //$sql 	= "INSERT INTO technologies(namaDepan,namaBelakang,jenisKelamin,alamat,noTelp,email) VALUES(:namaDepan,:namaBelakang,:jenisKelamin,:alamat,:noTelp,:email)";
            $stmt 	= $pdo->prepare($sql);
            $stmt->bindParam(':namaDepan', $namaDepan, PDO::PARAM_STR);
            $stmt->bindParam(':namaBelakang', $namaBelakang, PDO::PARAM_STR);
            $stmt->bindParam(':jenisKelamin', $jenisKelamin, PDO::PARAM_STR);
            $stmt->bindParam(':alamat', $alamat, PDO::PARAM_STR);
            $stmt->bindParam(':noTelp', $noTelp, PDO::PARAM_INT);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            echo json_encode(array('message' => 'Congratulations the record ' . $namaDepan . ' was added to the database'));
         }
         // Catch any errors in running the prepared statement
         catch(PDOException $e)
         {
            echo $e->getMessage();
         }

      break;

            // Update an existing record in the technologies table
            case "update":

               // Sanitise URL supplied values
               /*$namaDepan     = filter_var($_REQUEST  ['namaDepan'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
               $namaBelakang  = filter_var($_REQUEST  ['namaBelakang'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
               $jenisKelamin  = filter_var($_REQUEST  ['jenisKelamin'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
               $alamat        = filter_var($_REQUEST  ['alamat'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
               $noTelp        = filter_var($_REQUEST  ['noTelp'], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
               $email         = filter_var($_REQUEST  ['email'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
               $idBiodata     = filter_var($_REQUEST  ['idBiodata'], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);*/

               $namaDepan     = filter_var($obj->namaDepan, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
               $namaBelakang  = filter_var($obj->namaBelakang, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
               $jenisKelamin  = filter_var($obj->jenisKelamin, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
               $alamat        = filter_var($obj->alamat, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
               $noTelp        = filter_var($obj->noTelp, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
               $email         = filter_var($obj->email, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
               $idBiodata     = filter_var($obj->idBiodata, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);

               // Attempt to run PDO prepared statement
               try {
                  $sql 	= "UPDATE biodata SET namaDepan = :namaDepan, namaBelakang = :namaBelakang, jenisKelamin = :jenisKelamin, alamat = :alamat, noTelp = :noTelp, email = :email WHERE idBiodata = :idBiodata";
                  $stmt 	=	$pdo->prepare($sql);
                  $stmt->bindParam(':namaDepan', $namaDepan, PDO::PARAM_STR);
                  $stmt->bindParam(':namaBelakang', $namaBelakang, PDO::PARAM_STR);
                  $stmt->bindParam(':jenisKelamin', $jenisKelamin, PDO::PARAM_STR);
                  $stmt->bindParam(':alamat', $alamat, PDO::PARAM_STR);
                  $stmt->bindParam(':noTelp', $noTelp, PDO::PARAM_INT);
                  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                  $stmt->bindParam(':idBiodata', $idBiodata, PDO::PARAM_INT);
                  $stmt->execute();

                  echo json_encode('Congratulations the record ' . $namaDepan . ' was updated');
               }
               // Catch any errors in running the prepared statement
               catch(PDOException $e)
               {
                  echo $e->getMessage();
               }

            break;



            // Remove an existing record in the technologies table
            case "delete":

               // Sanitise supplied record ID for matching to table record
               //$recordID	=	filter_var($obj->recordID, FILTER_SANITIZE_NUMBER_INT);
               //$idBiodata     = filter_var($_REQUEST  ['idBiodata'], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
                $idBiodata     = filter_var($obj->idBiodata, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
               // Attempt to run PDO prepared statement
               try {
                  $pdo 	= new PDO($dsn, $un, $pwd);
                  $sql 	= "DELETE FROM biodata WHERE idBiodata = :idBiodata";
                  $stmt 	= $pdo->prepare($sql);
                  $stmt->bindParam(':recordID', $idBiodata, PDO::PARAM_INT);
                  $stmt->execute();

                  echo json_encode('Congratulations the record ' . $namaDepan . ' was removed');
               }
               // Catch any errors in running the prepared statement
               catch(PDOException $e)
               {
                  echo $e->getMessage();
               }

            break;
         }
