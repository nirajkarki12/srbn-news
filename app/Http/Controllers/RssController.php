<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Common\BaseApiController;
use anlutro\LaravelSettings\Facade as Setting;
use Vedmant\FeedReader\Facades\FeedReader;
use voku\helper\HtmlDomParser;

/**
* @group RSS
*
* fetch record from cache, currently online khabar as demo
* 
*/
class RssController extends BaseApiController
{
   /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct()
   {
      parent::__construct();
   }

   /**
   * Pull RSS Feed
   * @response {
   *  "status": true,
   *  "data": [
   *   {
   *    "title": "News Title",
   *    "description": "News Long Description",
   *    "image_url": "Image URL|null",
   *    "source": "News Source",
   *    "source_url": "Source URL",
   *    "author": "author name|null",
   *    "date": "2020-04-14 15:00"
   *   },
   *   {
   *    "title": "News Title",
   *    "description": "News Long Description",
   *    "image_url": "Image URL|null",
   *    "source": "News Source",
   *    "source_url": "Source URL",
   *    "author": "author name|null",
   *    "date": "2020-04-14 15:10"
   *   }
   *  ],
   * "message": "RSS data fetched successfully",
   * "code": 200
   * }
   * @response 200 {
   *  "status": false,
   *  "message": "RSS not found",
   *  "code": 200
   * }
   */
   public function index()
   {
      try {

         $feed = \FeedReader::read('https://english.onlinekhabar.com/feed');

         $rss = [];
         $tmp = [];

         $source = method_exists($feed, 'get_title') ? $feed->get_title() : 'unknown';

         if($feed && method_exists($feed, 'get_items'))
         {
            foreach ($feed->get_items() as $item) {
               $tmp['title'] = method_exists($item, 'get_title') ? ($item->get_title() ?: null) : null;
               $tmp['description'] = method_exists($item, 'get_description') ? ($item->get_description() ?: null) : null;

               $content = method_exists($item, 'get_content') ? ($item->get_content() ? HtmlDomParser::str_get_html($item->get_content()) : null) : null;
               $image = $content ? ($content->find('img', 0) ?: null) : null;
               $tmp['image_url'] = $image ? ($image->src ?: null) : null;

               $tmp['source'] = $source;
               $tmp['source_url'] = method_exists($item, 'get_link') ? ($item->get_link() ?: null) : null;
               $tmp['author'] = (method_exists($item, 'get_author') && $item->get_author() && method_exists($item->get_author(), 'get_name')) ? ($item->get_author()->get_name() ?: null) : null;
               $tmp['date'] = method_exists($item, 'get_date') ? ($item->get_date() ? $item->get_date(Setting::get('date_format', 'Y-m-d') .' ' .Setting::get('time_format', 'h:i A')) : null) : null;

               array_push($rss, $tmp);
            }
         }

         if (!$rss) throw new \Exception("RSS Posts found", Response::HTTP_OK);

         return $this->successResponse($rss, 'RSS data fetched successfully');

      } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), $e->getCode());
      }
        
   }


}
