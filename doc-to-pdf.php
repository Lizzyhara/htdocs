<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>DOC To PDF Conversion Results</title>
</head>

<body>

    <?php
    //calling the database
    // note for files smaller then 200kb
    
    // Get submitted form data
    $apiKey ="liz@wellhausen.com_3221807834acdc37cef82ac44f451af97a01c0ed34d9a2b61049388a5df60d5b340f5d10"; // The authentication key (API Key). Get your own by registering at https://app.pdf.co
    

    // 1. RETRIEVE THE PRESIGNED URL TO UPLOAD THE FILE.
    // * If you already have the direct PDF file link, go to the step 3.
    
    // Create URL
    $url = "https://api.pdf.co/v1/file/upload/get-presigned-url" .
        "?name=" . urlencode($_FILES["file"]["name"]) .
        "&contenttype=application/octet-stream";

    // Create request
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apiKey));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // Execute request
    $result = curl_exec($curl);

    if (curl_errno($curl) == 0) {
        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($status_code == 200) {
            $json = json_decode($result, true);

            if (!isset($json["error"]) || $json["error"] == false) {
                // Get URL to use for the file upload
                $uploadFileUrl = $json["presignedUrl"];
                // Get URL of uploaded file to use with later API calls
                $uploadedFileUrl = $json["url"];

                // 2. UPLOAD THE FILE TO CLOUD.
    
                $localFile = $_FILES["file"]["tmp_name"];
                $fileHandle = fopen($localFile, "r");

                curl_setopt($curl, CURLOPT_URL, $uploadFileUrl);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array("content-type: application/octet-stream"));
                curl_setopt($curl, CURLOPT_PUT, true);
                curl_setopt($curl, CURLOPT_INFILE, $fileHandle);
                curl_setopt($curl, CURLOPT_INFILESIZE, filesize($localFile));

                // Execute request
                curl_exec($curl);

                fclose($fileHandle);

                if (curl_errno($curl) == 0) {
                    $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

                    if ($status_code == 200) {
                        // 3. CONVERT UPLOADED DOC FILE TO PDF
    
                        DocToPdf($apiKey, $uploadedFileUrl, '');
                    } else {
                        // Display request error
                        header("Location: templates/to_pdf.php?error= $status_code");
                        exit();
                        ;
                    }
                } else {
                    // Display CURL error
                    header("Location: templates/to_pdf.php?error=" . curl_error($curl));
                    exit();
                    ;
                }
            } else {
                // Display service reported error
                header("Location: templates/to_pdf.php?error=" . $json["message"]);
                exit();
            }
        } else {
            // Display request error
    
            header("Location: templates/to_pdf.php?error= $status_code");
            exit();
            ;
        }

        curl_close($curl);
    } else {
        header("Location: templates/to_pdf.php?error=" . curl_error($curl));
        exit();
        // Display CURL error
    }

    function DocToPdf($apiKey, $uploadedFileUrl, $pages)
    {
        // Create URL
        $url = "https://api.pdf.co/v1/pdf/convert/from/doc";

        // Prepare requests params
        $parameters = array();
        $parameters["url"] = $uploadedFileUrl;
        $parameters["pages"] = $pages;

        // Create Json payload
        $data = json_encode($parameters);

        // Create request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apiKey, "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        // Execute request
        $result = curl_exec($curl);

        if (curl_errno($curl) == 0) {
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($status_code == 200) {
                $json = json_decode($result, true);

                if (!isset($json["error"]) || $json["error"] == false) {
                    $resultFileUrl = $json["url"];

                    // Display link to the file with conversion results
                    header('Content-Type: application/pdf');
                    header("Content-Transfer-Encoding: Binary");
                    header("Content-disposition: attachment;  filename= test.pdf"); //noch Namen anpasen
                    readfile($resultFileUrl);
                } else {
                    // Display service reported error
                    header("Location: templates/to_pdf.php?error=" . $json["message"]);
                    exit();
                }
            } else {
                // Display request error
                header("Location: templates/to_pdf.php?error=" . $status_code);
                exit();
            }
        } else {
            // Display CURL error
            header("Location: templates/to_pdf.php?error=" . curl_error($curl));
            exit();
        }

        // Cleanup
        curl_close($curl);
    }

    ?>

</body>

</html>