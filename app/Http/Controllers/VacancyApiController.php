<?php

namespace App\Http\Controllers;
use anlutro\LaravelSettings\Facade as Setting;
use App\Http\Controllers\Common\BaseApiController;
use App\Models\Vacancy;

/**
 * @group Vacancy
 **/
class VacancyApiController extends BaseApiController
{
/**
 * List
 * List all job vacancies
 * @response {
 *   "status": true,
 *   "data": {
 *       "current_page": 1,
 *       "data": [
 *           {
 *               "id": 1,
 *               "title": "Developer",
 *               "title_nepali": "Developer",
 *               "level": "Mid",
 *               "level_nepali": "Mid",
 *               "number": 1,
 *               "employment_type": "Full",
 *               "employment_type_nepali": "Full",
 *               "location": "Baneshwor",
 *               "location_nepali": "Baneshwor",
 *               "salary": "Rs 2500",
 *               "salary_nepali": "2500",
 *               "image": null,
 *               "apply_date": "2020-12-31 12:59:00",
 *               "apply_link": "asdasdas",
 *               "company_id": 1,
 *               "company": {
 *                   "id": 1,
 *                   "name": "Nepali Telicome",
 *                   "name_nepali": "Nepali Telicome Nepali",
 *                   "description": "kjkljkj",
 *                   "description_nepali": "jlkjlkjl",
 *                   "address": "jljljlk",
 *                   "address_nepali": "jlkjlk",
 *                   "image": "http://mynewsgram.test/storage/companies/55b135d855f890952a51ca397a7385868ff49b7c.png",
 *                   "phone": "9084023984092"
 *               },
 *               "job_categories": [
 *                   {
 *                       "id": 1,
 *                       "name": "Information Technology",
 *                       "name_nepali": "Nepali Telicome Nepali",
 *                       "image": "http://mynewsgram.test/storage/jobs/188fc2215db68d49afc47e08fb16ed1ca5ce4743.jpg",
 *                       "position": 0,
 *                       "text": "Information Technology",
 *                       "pivot": {
 *                           "vacancy_id": 1,
 *                           "job_category_id": 1
 *                       }
 *                   }
 *               ]
 *           }
 *       ],
 *       "first_page_url": "http://mynewsgram.test/api/vacancies?page=1",
 *       "from": 1,
 *       "last_page": 1,
 *       "last_page_url": "http://mynewsgram.test/api/vacancies?page=1",
 *       "next_page_url": null,
 *       "path": "http://mynewsgram.test/api/vacancies",
 *       "per_page": 25,
 *       "prev_page_url": null,
 *       "to": 1,
 *       "total": 1
 *   },
 *   "message": "Vacancies fetched successfully",
 *   "code": 200
 *   }
 * */

    public function index() {
        try {
            $vacancies = Vacancy::with(['company' => function($q){
//                $q->select('id','image');
            }])->with( ['jobCategories' => function($q){
//                $q->select('id','image','text');
            }])->where('apply_date','>=', \Carbon\Carbon::now())
                ->paginate(Setting::get('data_per_page', 25));
            return $this->successResponse($vacancies, 'Vacancies fetched successfully');
        }catch(\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
