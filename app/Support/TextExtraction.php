<?php

namespace App\Support;

use App\Exceptions\ChatBotFailedException;
use Exception;
use PhpOffice\PhpWord\IOFactory;
use Spatie\PdfToText\Pdf;

class TextExtraction
{
    /**
     * @param $path
     * @return string
     * @throws Exception
     */
    public function pdfToText($path): string
    {
        return Pdf::getText($path, config('app.pdf_exe_url'));
    }

    /**
     * @param $path
     * @return mixed|string
     */
    public function docToText($path): string
    {

        $fileHandle = fopen($path, 'r');
        $line = @fread($fileHandle, filesize($path));
        $lines = explode(chr(0x0D), $line);
        $response = '';

        foreach ($lines as $current_line) {
            $pos = strpos($current_line, chr(0x00));
            if (($pos !== false) || (strlen($current_line) == 0)) {
            } else {
                $response .= $current_line . ' ';
            }
        }

        $response = preg_replace('/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/', '', $response);

        return $response;
    }

    /**
     * @return bool|string
     */
    public function docxToText($path): string
    {
        $response = '';
        $phpWord = IOFactory::load($path);

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if (method_exists($element, 'getElements')) {
                    foreach ($element->getElements() as $childElement) {
                        if (method_exists($childElement, 'getText')) {
                            $response .= $childElement->getText() . ' ';
                        } elseif (method_exists($childElement, 'getContent')) {
                            $response .= $childElement->getContent() . ' ';
                        }
                    }
                } elseif (method_exists($element, 'getText')) {
                    $response .= $element->getText() . ' ';
                }
            }
        }
        return $response;
    }

    public function csvToText($path): array
    {
        try {
            $file = fopen($path, 'r');
            $header = fgetcsv($file);
            $data = [];
            while ($row = fgetcsv($file)) {
                $record = array_combine($header, $row);
                $data[] = $record;
            }
            fclose($file);
            return $data;
        } catch (\Exception $e) {
            throw new ChatBotFailedException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @param $url
     * @return bool
     */
    public function fileExists($url): bool
    {
        $handle = @fopen($url, 'r');
        return (bool)$handle;
    }
}
