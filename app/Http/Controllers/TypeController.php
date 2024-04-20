<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Company_total;
use App\company;
class TypeController extends Controller
{
    public function index()
    {
    

        // $datas = Type::with(['items.company.revenue' => function ($query) {
        //     $query->whereColumn('type_id','id');
        // }])->get();
        
        $types = Type::with('items')->get();

        $formattedData = [];
    
        foreach ($types as $type) {
            $formattedItems = [];
    
            foreach ($type->items as $item) {
                $formattedCompanies = [];
    
                $companies = Company::query()->where('id',$item->company_id)->get();
            
                foreach ($companies as $company) {
                    $formattedRevenue = [];
    
                    $revenues = Company_total::query()->where('company_id',$company->id)->where('type_id',$type->id)->get();
                    foreach ($revenues as $revenue) {
                        $formattedRevenue[] = [
                            "id" => $revenue->id,
                            "company_id" => $revenue->company_id,
                            "type_id" => $revenue->type_id,
                            "year" => $revenue->year,
                            "total_amount" => $revenue->total_amount
                        ];
                    }
    
                    $formattedCompanies = [
                        "id" => $company->id,
                        "company_name" => $company->company_name,
                        "short_name" => $company->short_name,
                        "company_number" => $company->company_number,
                        "company_amount" => $company->company_amount,
                        "revenue" => $formattedRevenue
                    ];


                }
    
                $formattedItems[] = [
                    "id" => $item->id,
                    "company_id" => $item->company_id,
                    "type_id" => $item->type_id,
                    "company" => $formattedCompanies
                ];
            }
    
            $formattedData[] = [
                "id" => $type->id,
                "type_name" => $type->type_name,
                "type_name_th" => $type->type_name_th,
                "items" => $formattedItems
            ];
        }
    

        // return Lesson::query()
        // ->with([
        //     'course',
        //     'lessonGroup'
        // ])
        // ->orderBy(
        //     LessonGroup::query()
        //         ->select('order')
        //         ->whereColumn('lesson_groups.id', 'lessons.lesson_group_id')
        // )
        // ->orderBy('order')
        // ->whereRelation('course', 'id', $course_id)
        // ->paginate();

        return response()->json($formattedData);
    }
    public function getByIds(Request $request)  
    {
    // รับข้อมูลไอดีที่ต้องการค้นหาจาก request
    $ids = $request->input('ids');

    // ใช้ Eloquent ในการค้นหาข้อมูลโดยใช้ whereIn และ with เพื่อโหลดข้อมูลที่เกี่ยวข้อง
    $datas = Type::with('items.company.revenue')->whereIn('id', $ids)->get();

    // ส่งข้อมูลในรูปแบบ JSON กลับไปยัง client
    return response()->json($datas);
    }

}