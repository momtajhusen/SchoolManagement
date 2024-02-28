<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\ItemsCategory;
use App\Models\ItemsPrice;
use App\Models\ItemsInStock;
use App\Models\ItemsAddStockHistory;


class StockStoreController extends Controller
{
 
    public function GetItemsCategory(Request $request) 
    {

        $itemsCategory = ItemsCategory::get();
        
        if ($itemsCategory->count() > 0) {
            return response(['Data' => $itemsCategory], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }
        
        
    }
 
    public function AddItemsCategory(Request $request) 
    {
        $category_name = $request->category_name;

        $ItemsCategory = ItemsCategory::where("categories", $category_name)->first();
        if(!$ItemsCategory)
        {
            $NewItemsCategory = new ItemsCategory;
            $NewItemsCategory->categories = $category_name;
            if($NewItemsCategory->save()){
                return response()->json(['status' => "Add Success"]);
            }
        }
        else{
            return response()->json(['status' => "exists category"]);
        }
    }
 
    public function DeleteCategory(Request $request) 
    {
        try {
            $category_id = $request->category_id;

            $Category = ItemsCategory::find($category_id);
            if ($Category->delete()) {
                return response()->json(['status' => "Delete Success"]);
            } else {
                return response()->json(['status' => "Category not Found"]);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
 
    public function AddItems(Request $request) 
    {
        try {
            $categories = $request->categories;
            $items = $request->items;
            $price = $request->price;

            $itemsPrice = ItemsPrice::where("items", $items)->first();

            if (!$itemsPrice) {
                $newItemsPrice = new ItemsPrice;
                $newItemsPrice->categories = $categories;
                $newItemsPrice->items = $items;
                $newItemsPrice->price = $price;

                if ($newItemsPrice->save()) {
                    return response()->json(['status' => 'Add Success']);
                }
            } else {
                return response()->json(['status' => 'Item already exists']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function GetAllItems(Request $request)
    {
        $ItemsPrice = ItemsPrice::get();
        
        if ($ItemsPrice->count() > 0) {
            return response(['Data' => $ItemsPrice], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

    }

    public function GetItemsCategoryChange(Request $request)
    {
        $category = $request->category;
        $ItemsPrice = ItemsPrice::where('categories', $category)->get();
        if ($ItemsPrice->count() > 0) {
            return response(['Data' => $ItemsPrice], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

    }

    public function DeleteItem(Request $request){
        try {
            $item_id = $request->item_id;

            $ItemsPrice = ItemsPrice::find($item_id);
            if ($ItemsPrice->delete()) {
                return response()->json(['status' => "Delete Success"]);
            } else {
                return response()->json(['status' => "Item not Found"]);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
 
    public function AddItemsInStock(Request $request) 
    {
        try {
         $categories = $request->categories;
         $items = $request->items;
         $quantity = $request->quantity;
         $date = $request->date;
         
         $ItemsInStock = ItemsInStock::where("categories", $categories)->where("items", $items)->first();
         
         if (!$ItemsInStock) {
             $newItemsInStock = ItemsInStock::create([
                 'items' => $items,
                 'categories' => $categories,
                 'stock' => $quantity,
             ]);
         } else {
             $ItemsInStock->stock += $quantity;
             $ItemsInStock->save();
         }
         
         $ItemsAddStockHistory = ItemsAddStockHistory::create([
             'items' => $items,
             'categories' => $categories,
             'quantity' => $quantity,
             'date' => $date,
         ]);
         
        return response()->json(['status' => 'Add Success']);

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function GetItemsInStock(Request $request)
    {
        try {

            $groupedItems = ItemsInStock::all()->groupBy('categories');

            if ($groupedItems->count() > 0) {
                return response(['ItemsInStock' => $groupedItems], Response::HTTP_OK);
            } else {
                return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
            }
            
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function GetItemsAddStockHistory(Request $request)
    {
        $GetItemsAddStockHistory = ItemsAddStockHistory::get();
        
        if ($GetItemsAddStockHistory->count() > 0) {
            return response(['Data' => $GetItemsAddStockHistory], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }
    }
 
    public function destroy(string $id): RedirectResponse
    {
        //
    }
}
