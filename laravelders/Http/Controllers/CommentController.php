<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use App\Models\Books;
use App\Models\Categories;


class CommentController extends Controller
{
  public function add($id,Request $request){

    $comment=new Comments;
    $comment->book_id=$request->bookid;
    $comment->comment=$request->comment;
    $comment->save();
    if($comment){
        $message = "yorum başarıyla eklendi";
        $status = "success";
    }else{
        $message = "yorum eklenirken hata oluştu";
        $status = "error";
    }

    return redirect('book/'.$id)
        ->with('message', $message)
    ->with('status', $status);

  }

  
}
