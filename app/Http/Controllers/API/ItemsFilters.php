<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Subcat;
use Illuminate\Http\Request;

class ItemsFilters extends Controller
{
    public function myFilter(Request $request){
//        $lostItemCount=Item::where('is_found','0')->count();
//        $foundItemCount=Item::where('is_found','1')->count();
//        dd($request->itemSearch,$lostItemCount,$foundItemCount);
            $cats=Category::all();
            for($i=0;$i<sizeof($cats);$i++){
                echo '--------------------------------';
                foreach ($cats[$i]->subcat as $subcat){
                    echo '<br>'.$subcat->name.'<br>';
//                    foreach ($subcat->items as $item){
//                        echo '/n'.$item.'/n';
//
//
//
//                    }












                }








            }













    }//end of myFilter


}//end of Class
