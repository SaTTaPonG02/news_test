<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\news;
use App\news_category;

class NewsController extends Controller
{
    public function news_category()
    {
        return view('layouts.news_category');
    }

    public function news_category_data(Request $request)
    {
        $data['data'] = [];
        $i = 1;

        $news_category = news_category::get();

        foreach($news_category as $val)
        {
            if($val->details == '' ){
                $details = '';
            }else{
                $details = '<a target="black" href="'.url("asset/images_1/" , array($val->details)).'">
                <img src="asset/images_1/'.$val->details.'" width="100"></a>';
            }

            $data['data'][] = array(
                "no" =>  $i,
                "titles" =>  $val->titles,
                "details" =>  $details,
                "active" => '
                <a href="'.route("news" , array("cat_id"=>$val->id)).'"><button type="button" class="btn btn-info"><i class="fa fa-plus"></i>&nbsp;News</button></a>&nbsp;
                <a href="'.route("edit_news_category" , array("id"=>$val->id)).'"><button type="button" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Edit</button></a>&nbsp;
                <button type="button" class="btn btn-danger" onclick="ConfirmDelete('.$val->id. ',' ."'$val->delete_id'".')"><i class="fa fa-trash-o"></i>&nbsp;Delete</button>
                ',
            );
            $i++; 
        }  


        
        // dd($news_category);
        echo json_encode($data);
    }

    public function insert_news_category()
    {
        return view('layouts.insert_news_category');
    }

    public function save_news_category(Request $request)
    {
        if($request->hasFile('details')){
            $details = $request->file('details');
            $name = $details->getClientOriginalName();
            $destinationPath = public_path('asset/images_1/');
            $details->move($destinationPath, $name);

            $news_category = new news_category;
            $news_category->titles = $request->titles;
            $news_category->details = $name;
            $news_category->save();
            
            return redirect('/news_category')->withSuccess('Insert Successfully');
        }else{

            $news_category = new news_category;
            $news_category->titles = $request->titles;
            $news_category->details = $request->details;
            $news_category->save();
            
            return redirect('/news_category')->withSuccess('Insert Successfully');
        }
        
        
    }

    public function edit_news_category($id)
    {
        $news_category = news_category::find($id);
        return view('layouts.edit_news_category', ['news_category'=>$news_category]);
    }

    public function update_news_category(Request $request)
    {
        if($request->hasFile('details')){
            $details = $request->file('details');
            $name = $details->getClientOriginalName();
            $destinationPath = public_path('asset/images_1/');
            $details->move($destinationPath, $name);
    
            $news_category = news_category::find($request->id);
            $news_category->titles = $request->titles;
            $news_category->details = $name;
            $news_category->save();

            return redirect()->route('edit_news_category',['id' => $request->id])->withSuccess('Update Successfully');

        }else{

            $news_category = news_category::find($request->id);
            $news_category->titles = $request->titles;
            $news_category->name = $name;
            $news_category->save();

            return redirect()->route('edit_news_category',['id' => $request->id])->withSuccess('Update Successfully');
        }
            
    }

    public function delete_news_category(Request $request)
    {
        DB::table('tb_new_category')->where('id','=', $request->id)->delete();
        DB::table('tb_new')->where('cat_id','=', $request->id)->delete();
        return "Delete Successfully"; 
    }





    public function news($cat_id)
    {
        return view('layouts.news',['cat_id'=>$cat_id]);
    }

    public function news_data(Request $request)
    {
        $data['data'] = [];
        $i = 1;

        $news = news::where('cat_id','=',$request->cat_id)->get();

        foreach($news as $val_n)
        {
            if($val_n->images == '' ){
                $images = '';
            }else{
                $images = '<a target="black" href="'.url("asset/images_1/" , array($val_n->images)).'">
                <img src="'.asset('asset/images_1/'.$val_n->images.'').'" width="100"></a>';
            }

            $data['data'][] = array(
                "no" =>  $i,
                "date" =>  $val_n->date,
                "images" =>  $images,
                "titles" =>  $val_n->titles,
                "details" =>  $val_n->details,
                "active" => '
                <a href="'.route("edit_news" , array("id"=>$val_n->id)).'"><button type="button" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Edit</button></a>&nbsp;,
                <button type="button" class="btn btn-danger" onclick="ConfirmDelete('.$val_n->id. ',' ."'$val_n->delete_id'".')"><i class="fa fa-trash-o"></i>&nbsp;Delete</button>
                ',
            );
            $i++; 
        }
        // dd($news);
        echo json_encode($data);
    }

    public function insert_news($cat_id)
    {
        return view('layouts.insert_news',['cat_id'=>$cat_id]);
    }

    public function save_news(Request $request)
    {
        if($request->hasFile('images')){
            $images = $request->file('images');
            $name = $images->getClientOriginalName();
            $destinationPath = public_path('asset/images_1/');
            $images->move($destinationPath, $name);
    
            $news = new news;
            $news->images = $name;
            $news->date = $request->date;
            $news->titles = $request->titles;
            $news->details = $request->details;
            $news->cat_id = $request->cat_id;
            $news->save();
     
            return redirect("news/$request->cat_id")->withSuccess('Insert Successfully');
        }
        else{

            $news = new news;
            $news->date = $request->date;
            $news->titles = $request->titles;
            $news->details = $request->details;
            $news->cat_id = $request->cat_id;
            $news->save();
    
            return redirect("news/$request->cat_id")->withSuccess('Insert Successfully');
        }
    }

    public function edit_news($id)
    {
        $news = news::find($id);
        return view('layouts.edit_news', ['news'=>$news]);
    }

    public function update_news(Request $request)
    {
        if($request->hasFile('images')){
            $images = $request->file('images');
            $name = $images->getClientOriginalName();
            $destinationPath = public_path('asset/images_1/');
            $images->move($destinationPath, $name);

            $news = news::find($request->id);
            $news->images = $name;
            $news->date = $request->date;
            $news->titles = $request->titles;
            $news->details = $request->details;
            $news->save();

            return redirect()->route('edit_news',['id' => $request->id])->withSuccess('Update Successfully');

        }else{

            $news = news::find($request->id);
            $news->date = $request->date;
            $news->titles = $request->titles;
            $news->details = $request->details;
            $news->save();

            return redirect()->route('edit_news',['id' => $request->id])->withSuccess('Update Successfully');
        }

    }

    public function delete_news(Request $request)
    {
        DB::table('tb_new')->where('id','=', $request->id)->delete();
        return "Delete Successfully"; 
    }
}
