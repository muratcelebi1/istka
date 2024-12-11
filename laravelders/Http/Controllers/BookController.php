<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Books;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class BookController extends Controller
{
    public function index(){
        $categories = Categories::select('id', 'name')->where('is_active', '=', 'active')->get();
        $books = Books::with('Category:id,name,slug,is_active')->get();

        return view('book.create', compact('categories', 'books'));
    }
    public function create(BookRequest $request)
    {
        
            $image= time(). ".". $request->image->extension();
            $request->image->move(public_path('images'),$image);

            $new_book = new Books;
            $new_book->category_id = $request->category_id;
            $new_book->title = $request->title;
            $new_book->image= "/images/". $image;
            $new_book->description = $request->description;
            $new_book->save();

            if($new_book){
                $message = "Kitap başarıyla eklendi";
                $status = "success";
            }else{
                $message = "Kitap eklenirken hata oluştu";
                $status = "error";
            }

            return redirect('book/')
                ->with('message', $message)
            ->with('status', $status);
        
       
    }
    public function update($uuid,BookRequest $request)
    {
    
            $new_book = Books::where('uuid', $uuid)->first();
            $new_book->category_id = $request->category_id;
            $new_book->title = $request->title;
            $new_book->description = $request->description;
            $new_book->save();

            if($new_book){
                $message = "Kitap başarıyla günellendi";
                $status = "success";
            }else{
                $message = "Kitap güncellenirken hata oluştu";
                $status = "error";
            }

            return redirect('book/')
                ->with('message', $message)
            ->with('status', $status);
        
        
    }
    public function delete($uuid){
        $delete = Books::where('uuid', $uuid)->delete();

        return Response()->json($delete ? true : false);
    }
    public function detail($uuid){
    App::setLocale('tr'); //zaman tr için
    $book = Books::where('uuid', $uuid)->with('comments')->first();

    if(!$book){
        abort(404);
    }
    // Yorumları almak
    $comments = $book->comments;

    return view('book.detail', compact('book', 'comments'));
    }

}
