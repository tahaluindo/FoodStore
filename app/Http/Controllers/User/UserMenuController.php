<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Food;
use App\Models\Menu;
use App\Models\Survey;
use App\Models\Student;
use App\Models\Guardian;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Gloudemans\Shoppingcart\Facades\Cart;

class UserMenuController extends Controller
{
    public function index(Student $student){

        
        $restricts = $student->restriction;

        $food = Menu::with('food')->get();

        $parent = Guardian::where('user_id', auth()->id())->get();
        $students = DB::select('SELECT * FROM students WHERE parent_id = ?', [$parent[0]->id]);
        $notifications = DB::select('SELECT * FROM notifications WHERE parent_id = ?', [$parent[0]->id]);
        
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');

        $survey = Survey::where('parent_id', $parent[0]->id)
            ->whereBetween('created_at', [$weekStartDate, $weekEndDate])->get();
        if(!empty($survey)){
            $isSurveyAvail = 1;
        }
        return view('user.menu', [
            'anak' => $student,
            'foods' => $food,
            'notifications' => $notifications,
            'students' => $students,
            'isSurveyAvail' => $isSurveyAvail,
            'restricts' => $restricts
        ]);

    }

    //For landing page
    public function landing(){

        $parent = Guardian::where('user_id', auth()->id())->get();

        $notifications = DB::select('SELECT * FROM notifications WHERE parent_id = ?', [$parent[0]->id]);
        $student = DB::select('SELECT * FROM students WHERE parent_id = ?', [$parent[0]->id]);
        
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');

        $survey = Survey::where('parent_id', $parent[0]->id)
            ->whereBetween('created_at', [$weekStartDate, $weekEndDate])->get();
        if(!empty($survey)){
            $isSurveyAvail = 1;
        }
        return view('user.menu-landing', [
            'notifications' => $notifications,
            'isSurveyAvail' => $isSurveyAvail,
            'students' => $student
        ]);

    }

    public function addtocart(Request $request){

        $food_id = $request->input('food-id');

        $item = Food::findOrFail($food_id);
        $rice = Food::findOrFail(2);

        if($item->type == 3){
            Cart::add(
                $item->id,
                $item->name,
                1,
                $item->price,
                0,
                ['image' => $item->image,
                'type' => $item->type
                ]
            );
    
            Cart::add(
                $rice->id,
                $rice->name,
                1,
                $rice->price,
                0,
                ['image' => $rice->image,
                'type' => $rice->type
                ]
            );
        }
        else{
            Cart::add(
                $item->id,
                $item->name,
                1,
                $item->price,
                0,
                ['image' => $item->image,
                'type' => $item->type
                ]
            );
        }
       
        return response()->json(['status' => 'Success']);
    }

    public function addtorestrict(Request $request){
        
        $food_id = $request->input('food-id');
        $anak_id = $request->input('anak-id');

        $restrict = DB::select('SELECT restriction FROM students WHERE id = ?' , [$anak_id]);
        $restrict = $restrict[0]->restriction;
        
        $id = $restrict.$food_id . ',';
        DB::update('UPDATE students SET restriction = ? where id = ?', [$id, $anak_id]);
        
        return response()->json(['status' => 'Success']);
    }
    
}
