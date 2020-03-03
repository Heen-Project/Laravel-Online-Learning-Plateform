<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RssController extends Controller
{
	public static function index(){

		$articles = \App\Article::orderBy('created_at', 'desc')->get();
		$rss = '';
		foreach($articles as $article){
			$rss .= '<item>' . "\n";
			$rss .= '<id> '.$article->id.' </id>'. "\n";
			$rss .= '<title> '.$article->title.' </title>'. "\n";
			$rss .= '<description> <![CDATA['.$article->description.' ]]></description>'. "\n";
			$rss .= '</item>'. "\n";
		}
		return response()->view('include.etc.rss', compact('rss'))->header('Content-Type','application/rss+xml; charset=ISO-8859-1');
	}
}
