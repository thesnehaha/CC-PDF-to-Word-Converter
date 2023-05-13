<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['pdfFile']) && $_FILES['pdfFile']['error'] === UPLOAD_ERR_OK) {
        $tempFile = $_FILES['pdfFile']['tmp_name'];
        $outputFile = 'Word-File.docx';

        if (convertfile($tempFile, $outputFile)) {
            
            header('Content-Type: application/docx');
            header('Content-Disposition: attachment; filename="' . $outputFile . '"');
            readfile($outputFile);

            
            unlink($tempFile);
            unlink($outputFile);

            exit;
        } 
        
        else {
            echo 'Process failed.';
        }
    } 
    
    else {
        echo 'The File type should be PDF.';
    }
}

function convertfile($pdfPath, $outputPath)
{

    return copy($pdfPath, $outputPath);
}

?>