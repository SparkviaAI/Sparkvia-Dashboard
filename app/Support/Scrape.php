<?php

namespace App\Support;

use League\HTMLToMarkdown\HtmlConverter;
use Symfony\Component\DomCrawler\Crawler;

class Scrape
{
    public $title;
    private $converter;

    public function __construct()
    {
        $this->converter = new HtmlConverter(array('strip_tags' => true, 'strip_placeholder_links' => true));
    }

    private function removeHrefAttribute($htmlString)
    {
        $pattern = '/<a\b[^>]*\bhref\s*=\s*"[^"]*"[^>]*>/i';
        $replacement = '<a>';
        $result = preg_replace($pattern, $replacement, $htmlString);
        return $result;
    }

    private function cleanHtml($htmlContent)
    {
        // Clean this tags: <style> <script> <span> <footer> <aside> <nav>
        $cleanHtml = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $htmlContent);
        $cleanHtml = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', '', $cleanHtml);
        $cleanHtml = preg_replace('/<svg\b[^>]*>(.*?)<\/svg>/is', '', $cleanHtml);
        $cleanHtml = preg_replace('/<picture\b[^>]*>(.*?)<\/picture>/is', '', $cleanHtml);
        $cleanHtml = preg_replace('/<form\b[^>]*>(.*?)<\/form>/is', '', $cleanHtml);
        $cleanHtml = preg_replace('/<footer\b[^>]*>(.*?)<\/footer>/is', '', $cleanHtml);
        $cleanHtml = preg_replace('/<nav\b[^>]*>(.*?)<\/nav>/is', '', $cleanHtml);
        $cleanHtml = preg_replace('/<span[^>]*>(.*?)<\/span>/is', '$1', $cleanHtml);
        $cleanHtml = $this->removeHrefAttribute($cleanHtml);
        return trim($cleanHtml);
    }

    private function reverseLTGT($input)
    {
        $output = str_replace('&lt;', '<', $input);
        $output = str_replace('&gt;', '>', $output);
        return $output;
    }

    public function handle($url)
    {
        $headers = array(
            'X-Requested-With: XMLHttpRequest',
        );
        $user_agent = "Mozilla/5.0 (X11; Linux i686; rv:24.0) Gecko/20140319 Firefox/24.0 Iceweasel/24.4.0";

        $curl1 = curl_init();
        curl_setopt($curl1, CURLOPT_URL, $url);
        curl_setopt($curl1, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($curl1, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl1, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl1, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl1, CURLOPT_HEADER, 1);
        curl_setopt($curl1, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($curl1, CURLOPT_HTTPHEADER, $headers);
        $htmlContent = curl_exec($curl1);
        curl_close($curl1);

        $cleanHtml = $this->cleanHtml($htmlContent);

        $this->converter->getEnvironment()->addConverter(new PreTagConverter());
        $markdownContent = $this->converter->convert($cleanHtml);
        $markdownContent = $this->reverseLTGT($markdownContent);
        try {
            $dom = new Crawler($htmlContent);
            $this->title = $dom->filter('title')->first()->text();
        } catch (\Exception $e) {
            $this->title = substr($markdownContent, 0, strpos($markdownContent, "\n"));
        }

        return $markdownContent;
    }
}
