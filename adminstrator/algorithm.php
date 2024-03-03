
<?php

function extractTextFromPDF($pdfPath)
{
    $pdftotextPath = 'pdftotext';
    $cmd = $pdftotextPath.' '.$pdfPath." -";
    $output = shell_exec($cmd);
    if ($output === null) {
        throw new Exception("Error executing pdftotext command for file: $pdfPath");
    }
    return $output;
}

function calculateJaccardSimilarity($text1, $text2)
{
    // Tokenize the strings into arrays of words
    $tokens1 = explode(' ', $text1);
    $tokens2 = explode(' ', $text2);

    // Convert arrays to sets to eliminate duplicate words
    $set1 = array_unique($tokens1);
    $set2 = array_unique($tokens2);

    // Calculate the intersection and union of sets
    $intersection = count(array_intersect($set1, $set2));
    $union = count($set1) + count($set2) - $intersection;

    // Calculate Jaccard similarity
    $similarity = ($union > 0) ? ($intersection / $union) : 0;

    return $similarity;
}

// Path to the reference PDF file
$referencePdfPath = 'books/65254a82352c8_9f0d9b27071a8cf6.pdf';

// Directory containing other PDF files
$pdfDirectory = 'books';

try {
    // Extract text from the reference PDF
    $referenceText = extractTextFromPDF($referencePdfPath);

    // Iterate through all PDF files in the directory
    $similarityResults = [];

    foreach (glob($pdfDirectory . '/*.pdf') as $pdfFile) {
        $fileInfo = pathinfo($pdfFile);
        if (strtolower($fileInfo['extension']) === 'pdf') {
            // Extract text from the current PDF
            $currentText = extractTextFromPDF($pdfFile);

            // Calculate Jaccard similarity
            $jaccardSimilarity = calculateJaccardSimilarity($referenceText, $currentText);

            // Store the results in an array
            $similarityResults[$pdfFile] = $jaccardSimilarity;
        }
    }

    // Output the similarity scores for all PDF files
    echo "Jaccard Similarity Scores:\n";

    foreach ($similarityResults as $pdfFile => $similarity) {
        if(round($similarity * 100, 2) > 4){

        }
        echo "$pdfFile: " . round($similarity * 100, 2) . "%\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>
