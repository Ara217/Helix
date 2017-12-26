<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Article;

class GetArticleController extends Controller
{

	public function index (Request $request) 
	{
    	$newLinkes = [];
		$dom = new \DOMDocument;

		for ($i = 1; count($newLinkes) < 100; $i++) {
	    	$data = $this->send_curl('http://www.tert.am/am/news/' . $i); 
			@$dom->loadHTML($data);
			$rightCol = $dom->getElementById('right-col');
			$links = $rightCol->getElementsByTagName('a');

			foreach ($links as $link) {
				if (strpos($link->getAttribute('href'), 'tert.am/am/news/2017') && 
					!in_array($link->getAttribute('href'), $newLinkes)) {
						array_push($newLinkes, $link->getAttribute('href'));
				}
			}
		}
		$this->save_news($newLinkes);

		return redirect('articles/');
    }

	public function save_news ($data) 
	{
		$news = $this->get_news($data);
		Article::truncate();
		Article::insert($news);
    }

	public function get_news ($urls) 
	{
		$dom = new \DOMDocument;		
		$newsData = [];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_FAILONERROR,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);

		foreach ($urls as $url) {
			$text = '';
			curl_setopt($ch, CURLOPT_URL,$url);
			$page = curl_exec($ch);          
			@$dom->loadHTML($page);

			$imgLink = @$dom->getElementById('i-content')->getElementsByTagName('img')->item(0);
			$title = @$dom->getElementById('item')->getElementsByTagName('h1')->item(0)->textContent;
			$date = @$dom->getElementById('item')->getElementsByTagName('p')->item(0)->textContent;
			$description = @$dom->getElementById('i-content')->getElementsByTagName('p');

			foreach ($description as $node) {
				$text .= $node->textContent;				
			}
			
			$newsData[] = [
				'title' => $title, 
				'description' => $text, 
				'image_link' => $imgLink->getAttribute('src'), 
				'date' => $date, 
				'url' => $url
			];
		}

		curl_close($ch);
		return $newsData;
	}

	public function send_curl ($path)
	{
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL,$path);
	    curl_setopt($ch, CURLOPT_FAILONERROR,1);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	    $retValue = curl_exec($ch);          
	    curl_close($ch);
	    return $retValue;
	}
}
