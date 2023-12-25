<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Models\Article;
use App\Models\ArticleMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index()
    {
        return view('backend.admin.blog.articles');
    }
    public function getArticles(){

        $data = Article::orderBy('created_at', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('title', function($row){
                return $row->title;                
            })
            ->addColumn('status', function($row){
                if ($row->status == 0) {
                    return '<span class="badge bg-label-danger">not active</span>';
                } else {
                    return '<span class="badge bg-label-success">active</span>';
                }
            })
            ->addColumn('created_at', function($row){
                return $row->created_at->format('Y M D');                
            })
            
            ->addColumn('action', function($row){
                $actionBtn = '<a href="' . route('admin.article.single' ,$row->slug) . '" class="edit btn btn-outline-dark waves-effect btn-sm ">Show</a> ';
                return $actionBtn;
            })
            ->rawColumns(['status','action','created_at','title'])
            ->make(true);

    } 
    public function articleSingle($slug)
    {
        $article = Article::where('slug', $slug)->first();
        return view('backend.admin.blog.articleSingle', compact('article'));

    }
    public function AddArticles()
    {
        return view('backend.admin.blog.createArticles');
    }
    public function storeArticles(Request $request)
    {
        
        $validation = Validator::make($request->all(), [
            'title'    => 'required',
            'content'  => 'required',
        ]);

        if ($validation->fails()) {

            return redirect()->route('admin.add.articles')->withErrors($validation)->withInput();
        }

        try {

            if (!$request->comment_able == 1) {
                $comment_able = 0;
            }

            // dd($request->all());
            $article = Article::create([
                'user_id' => auth()->user()->id,
                'title' => $request->title,
                'content' => $request->content,
                'status' => $request->status,
                'comment_able' => $request->comment_able ? $request->comment_able : $comment_able ,
            ]);

            if($request->banner){
                $file = $request->banner;

                $filename = $article->slug . '_' . time() . '.' . $file->getClientOriginalExtension();
                $filesize = $request->banner->getSize();
                $filetype = $request->banner->getMimeType();

                $path = public_path('assets/blog/' . $filename);
                Image::make($request->banner->getRealPath())->resize(800, null, function($constraint){
                    $constraint->aspectRatio();
                })->save($path, 100);

                $article->media()->create([
                    'file_name' => $filename,
                    'article_id' => $article->id,
                ]);
            }

            return redirect()->back()->with([
                'message' => 'added',
                'alert' => 'success'
            ]);
            
        } catch (Exception $ex) {

            return redirect()->back()->with([
                'message' => 'error',
                'alert' => 'danger'
            ]);

        }
    }
    public function updateArticles(Request $request, $slug)
    {
               
        $validation = Validator::make($request->all(), [
            'title'    => 'required',
            'content'  => 'required',
        ]);

        if ($validation->fails()) {

            return redirect()->back()->withErrors($validation)->withInput();
        }

        try {

            $article = Article::where('slug',$slug);
            if (!$request->status == 1) {
                $status = 0;
            }
            if (!$request->comment_able == 1) {
                $comment_able = 0;
            }

            $data['title']          = $request->title;
            $data['content']        = $request->content;
            $data['status']         = $request->status;
            
            $article->update($data);

            if($request->banner){
                $file = $request->banner;
                $filename = 'news_' . rand(100,10000) . '.' . $file->extension();
                $filesize = $request->banner->getSize();
                $filetype = $request->banner->getMimeType();
                
                $path = public_path('assets/blog/' . $filename);
                Image::make($request->banner->getRealPath())->resize(800, null, function($constraint){
                    $constraint->aspectRatio();
                })->save($path, 100);

                $article->media()->create([
                    'file_name' => $filename,
                ]);
            }

            return redirect()->back()->with([
                'message' => 'saved',
                'alert' => 'success'
            ]);
            
        } catch (Exception $ex) {

            return redirect()->back()->with([
                'message' => 'error',
                'alert' => 'danger'
            ]);

        }
    }
    public function FileDelete($id){
        $img = ArticleMedia::findOrFail($id);
        // dd($img->file_name);
        $image_path = public_path("assets/blog/" . $img->file_name);
        // dd($image_path);
        if (File::exists($image_path)) {
            //File::delete($image_path);
            unlink($image_path);
        }
        $img->delete();
        return redirect()->back()->with([
            'message' => 'done',
            'alert-type' => 'alert-light'
        ]);
    }
}
