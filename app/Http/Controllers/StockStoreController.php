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
use App\Models\ItemsSellHistories;
use App\Models\Student;

use App\Models\DuesAmount;



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

    public function SellItems(Request $request)
    {
        try {
           $fee_input = $request->fee_input;
           $paid_input = $request->paid_input;
           $dues_input = $request->dues_input;
           $percentage = $request->percentage;
           $disc_input = $request->disc_input;
           $pay_date = $request->pay_date;
           $comment_disc = $request->comment_disc;
           $st_id = $request->st_id;
           $particulars_data = $request->particular_data;
           $current_year = $request->current_year;

        //   Stock Items Decrease 
        $particulars_array = json_decode($particulars_data, true);
        foreach ($particulars_array as $particular) {
            $items = $particular['itemName'];
            $quantity = $particular['quantity'];
            $amount = $particular['amount'];
        
            $ItemsInStock = ItemsInStock::where('items', $items)->first();

            if($ItemsInStock)
            {
                // Check if stock is sufficient
                if ($ItemsInStock->stock >= $quantity) {
                    // Update stock
                    $ItemsInStock->stock -= $quantity;
                    $ItemsInStock->save();
                } else {
    
                    echo "Insufficient stock for item: $items";
                    return false;
                }
            }else{
                echo "Insufficient stock for item: $items";
                return false;
            }
        
        }

        // Status Check 
        if($dues_input == 0){
            $status = 'Paid';
        }else{
            $status = 'Dues';
        }

<<<<<<< HEAD
        $duesAmount = DuesAmount::where("st_id", $st_id)
        ->where("class_year", $current_year)
        ->first();
        
        if ($duesAmount) {
            for ($i = 0; $i < 11; $i++){
                $column = 'month_'.$i;
                $value = $duesAmount->$column; // Accessing the value of the column dynamically
=======
        $duesAmountOld = DuesAmount::where("st_id", $st_id)
        ->where("class_year", $current_year)
        ->first();

        
        $duesAmountOld = DuesAmount::where("st_id", $st_id)
        ->where("class_year", $current_year)
        ->first();
        
        if ($duesAmountOld) 
        {
            for ($i = 0; $i < 11; $i++){
                $column = 'month_'.$i;
                $value = $duesAmountOld->$column; // Accessing the value of the column dynamically
>>>>>>> 0981ca2f451b75d53f172842175003e92a932ce3
        
                if ($value === null) {
                    $month = $i;
                    $year = $current_year;
                    break;
                } else {
                    $month = 1;
                    $year = $current_year + 1;
                }
            }
        } else {
            $month = 1;
            $year = $current_year;
        }
    

          $ItemsSellHistories = new ItemsSellHistories;
          $ItemsSellHistories->st_id = $st_id;
          $ItemsSellHistories->fee_year = $year;
          $ItemsSellHistories->month = $month;
          $ItemsSellHistories->particulars_data = $particulars_data;
          $ItemsSellHistories->amount = $fee_input;
          $ItemsSellHistories->paid	 = $paid_input;
          $ItemsSellHistories->disc	 = $disc_input;
          $ItemsSellHistories->paid	 = $paid_input;
          $ItemsSellHistories->dues = $dues_input;
          $ItemsSellHistories->pay_date = $pay_date;
          $ItemsSellHistories->status = $status;
          $ItemsSellHistories->save();


            return response()->json(['status' => 'sell success']);

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function purchaseHistory(Request $request)
    {
        try {

            $ItemsSellHistories = ItemsSellHistories::orderBy('id', 'desc')->get();

            if ($ItemsSellHistories) {
                foreach($ItemsSellHistories as $History){

                    $st_id = $History->st_id;
                    $fee_year = $History->fee_year;
                    $month = $History->month;
                    $status = $History->status;

                    $Student = Student::where('id', $st_id)->first();

                    $History->student_name = $Student->first_name.' '.$Student->middle_name.' '.$Student->last_name;

                    
                     $column = 'month_'.$month; 
                     $duesAmount = DuesAmount::where("st_id", $st_id)->where("class_year", $fee_year)->first();
                     if($duesAmount){
                        if($duesAmount->$column != null){
                            $History->add_month_status = 'Paid';
                         }else{
                            $History->add_month_status = 'Not Paid';
                         }
                     }else{
                        $History->add_month_status = 'Not Paid';
                     }


                }
                return response(['purchaseHistory' => $ItemsSellHistories], Response::HTTP_OK);
            } else {
                return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
            }

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
  

    }

    public function purchaseHistoryReset(Request $request){
        try {

            $hs_id = $request->hs_id;

            $ItemsSellHistories = ItemsSellHistories::find($hs_id);

            if ($ItemsSellHistories->delete()) {
                return response()->json(['status' => "Reset Success"]);
            } else {
                return response()->json(['status' => "Histories not Found"]);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        } 
    }
 
}
