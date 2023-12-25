<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Article;
use App\Models\ContactUs;
use App\Models\Questions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Notifications\ContactUsNotification;

class HomeController extends Controller
{
    public function index(){
        $articles = Article::where('status',1)->orderBy('created_at', 'desc')->take(3)->get();
        $questions = Questions::where('showLanding',1)->where('status',1)->orderBy('created_at', 'desc')->get();
        return view('frontend.home', compact('articles','questions'));
    }
    public function about(){
        return view('frontend.about');
    }
    public function how_it_work(){
        return view('frontend.how_it_work');
    }
    public function privacy(){
        return view('frontend.privacy');
    }
    public function terms(){
        return view('frontend.terms');
    }
    public function blog(){

        $articles = Article::where('status', 1)->with('media')->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.blog', compact('articles'));
    }
    public function blog_single($slug){
        $article = Article::where('slug', $slug)->with('media')->first();
        return view('frontend.blogSingle', compact('article'));
    }
    public function contact(){
        return view('frontend.contact');
    }
    public function contactStore(Request $request){
        $validation = Validator::make($request->all(), [
            'name'     => 'required|string',
            'email'    => 'required|string',
            'subject'  => 'required|string',
            'message'  => 'required|string',
        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.productType')->withErrors($validation)->withInput();
        }

        $data['name']   = $request->name;
        $data['email']   = $request->email;
        $data['subject']   = $request->subject;
        $data['message']   = $request->message;

        $property = ContactUs::create($data);

        $users = User::whereHas('roles', function($q)
        {
            $q->where('name', 'admin');
        })->get();

        foreach ($users as $key => $user) {
            $user->notify(new ContactUsNotification($data));
        }

        return redirect()->back()->with([
            'message' => 'Added successfully',
            'alert'   => 'success'
        ]);
    }
}
