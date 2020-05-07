<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Common\BaseApiController;
use anlutro\LaravelSettings\Facade as Setting;
use Vedmant\FeedReader\Facades\FeedReader;
use voku\helper\HtmlDomParser;
use App\Models\Rss;

/**
* @group RSS Feed
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
   * RSS Feed Lists
   * Active RSS Feeds
   * @response {
   *  "status": true,
   *  "data": [
   *   {
   *    "id": 1,
   *    "name": "Feed Name",
   *    "tagline": "Feed Tagline",
   *    "logo": "Feed Logo URL"
   *   }
   *  ],
   * "message": "RSS Feed data fetched successfully",
   * "code": 200
   * }
   * @response 200 {
   *  "status": false,
   *  "message": "RSS Feed data not found",
   *  "code": 200
   * }
   */
   public function index()
   {
      try {

         $data = Rss::orderBy('name', 'asc')
                     ->where(['status' => 1])
                     ->get();

         $data = $data->each(function ($category) {
                     $category->makeHidden([
                        'url',
                        'logo_file',
                        'status',
                        'created_at',
                        'updated_at',
                        'slug'
                     ]);
                  })->toArray();

         if(count($data) === 0) throw new \Exception("RSS Feed data not found", Response::HTTP_OK);
        
         return $this->successResponse($data, 'RSS Feed data fetched successfully');

      } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), $e->getCode());
      }
        
   }

   /**
   * Pull RSS Feed
   * @urlParam /id required rss feed id
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
   * "message": "RSS Feed data fetched successfully",
   * "code": 200
   * }
   * @response 200 {
   *  "status": false,
   *  "message": "RSS Feed data not found",
   *  "code": 200
   * }
   */
   public function getFeedData(int $id)
   {
      try {

         if(!$data = Rss::find($id)) throw new \Exception("RSS Feed data not found", Response::HTTP_OK);

         $feed = \FeedReader::read($data->url);

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

         if (!$rss) throw new \Exception("RSS Feed data not found", Response::HTTP_OK);

         return $this->successResponse($rss, 'RSS Feed data fetched successfully');

      } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), $e->getCode());
      }
        
   }


}
