<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\DateSetting;
use App\Models\Student;
use App\Models\FeePayment;
use App\Models\DuesAmount;
use App\Models\FeeDiscount;
use App\Models\FeeFree;

use App\Models\Classes;
use App\Models\LastPaymentForReset;
use App\Models\LastDiscountsForReset;
use App\Models\LastFreeFeeForReset;
use App\Models\LastDuesForReset;
use App\Models\HostelFee;
use App\Models\TuitionFee;
use App\Models\VehicleRoot;

class StudentPromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $response;
    public $data;
    public $allData = [];
    public function index(Request $request)
    {
        try {
            $class = $request->class;
            $this->response = Student::where("class", $class)->where("admission_status","admit")->get();
            if (count($this->response) != "0") {
                foreach ($this->response as $this->data) {
                    array_push($this->allData, $this->data);
                }

                return response(array("Student" => $this->allData), 200);
            } else {
                return response()->json(['message' => 'student not found']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function StudentPromote(Request $request)
    {
        try {
            $from_class = $request->input('from_class');
            $promote_class = $request->input('promote_class');

            // date year 
            $dateSetting = DateSetting::first();
            $current_year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->current_year ?? null);

            $PromotedStudent = json_decode($request->input('PromotedStudent'));
            $PromotedStudentlength = count($PromotedStudent);

            $DemotionStudent = json_decode($request->input('DemotionStudent'));
            $DemotionStudentlength = count($DemotionStudent);

            ////// Start Promoted Student //////
            $NotPromotedStudent = [];
            $ArrayPromotedStudent = [];
            for ($i = 0; $i < $PromotedStudentlength; $i++) {

                $PromotedStudentData = Student::where('class', $from_class)->whereIn('id', [$PromotedStudent[$i]])->first();
                $PaymentStudent = FeePayment::where('st_id', [$PromotedStudent[$i]])->where('class', $from_class)->first();
                $class_year = $PromotedStudentData->class_year;


                // if current_year is greater than class_year
                // Same Same than if condition 
                if ($class_year >= $current_year) {
 
                    if ($PaymentStudent->total_payment <= 0) {

                        if ($PromotedStudentData) {

                            // Student Update For Promote
                            $Student = Student::where('id', $PromotedStudentData->id)->first();
                            $Student->class = $promote_class;
                            $Student->class_year = $current_year;
                            $Student->save();


                            // DuesAmount create or Update For Promote 
                            if (!DuesAmount::where('st_id', $PromotedStudentData->id)->where('class_year', $current_year)->exists()) {
                                $DuesAmount = new DuesAmount;
                                $DuesAmount->st_id = $PromotedStudentData->id;
                                $DuesAmount->class = $promote_class;
                                $DuesAmount->class_year = $current_year;
                                $DuesAmount->save();
                            } else {
                                $DuesAmount = DuesAmount::where('st_id', $PromotedStudentData->id)->where("class_year", $current_year)->first();
                                $DuesAmount->class = $promote_class;
                                $DuesAmount->save();
                            }

                            // FeeDiscount create or Update For Promote 
                            if (!FeeDiscount::where('st_id', $PromotedStudentData->id)->where('class_year', $current_year)->exists()) {
                                $FeeDiscount = new FeeDiscount;
                                $FeeDiscount->st_id = $PromotedStudentData->id;
                                $FeeDiscount->class = $promote_class;
                                $FeeDiscount->class_year = $current_year;
                                $FeeDiscount->save();
                            } else {
                                $FeeDiscount = FeeDiscount::where('st_id', $PromotedStudentData->id)->where("class_year", $current_year)->first();
                                $FeeDiscount->class = $promote_class;
                                $FeeDiscount->save();
                            }

                            // FreeFee create or Update For Promote 
                            if (!FeeFree::where('st_id', $PromotedStudentData->id)->where('class_year', $current_year)->exists()) {
                                $FeeFree = new FeeFree;
                                $FeeFree->st_id = $PromotedStudentData->id;
                                $FeeFree->class = $promote_class;
                                $FeeFree->class_year = $current_year;
                                $FeeFree->save();
                            } else {
                                $FeeFree = FeeFree::where('st_id', $PromotedStudentData->id)->where("class_year", $current_year)->first();
                                $FeeFree->class = $promote_class;
                                $FeeFree->save();
                            }

                            // FeePayment create or Update For Promote 
                            if (!FeePayment::where('st_id', $PromotedStudentData->id)->where('class_year', $current_year)->exists()) {
                                $FeePayment = new FeePayment;
                                $FeePayment->st_id = $PromotedStudentData->id;
                                $FeePayment->class = $promote_class;
                                $FeePayment->class_year = $current_year;
                                $FeePayment->total_fee = 0;
                                $FeePayment->total_dues = 0;
                                $FeePayment->total_payment =  0;
                                $FeePayment->total_discount =  0;
                                $FeePayment->free_fee =  0;
                                $FeePayment->save();
                            } else {
                                $FeePayment = FeePayment::where('st_id', $PromotedStudentData->id)->where("class_year", $current_year)->first();
                                $total_paying = $FeePayment->total_payment + $FeePayment->free_fee + $FeePayment->total_discount;
                                $FeePayment->class = $promote_class;
                                $FeePayment->class_year = $current_year;
                                $FeePayment->total_fee = 0;
                                $FeePayment->total_payment =  0;
                                $FeePayment->total_discount =  0;
                                $FeePayment->free_fee =  0;
                                $FeePayment->total_dues = 0;
                                $FeePayment->save();
                            }

                            $LastPaymentForReset = LastPaymentForReset::where('st_id', $PromotedStudentData->id)->first();
                            $LastPaymentForReset->class = $promote_class;
                            $LastPaymentForReset->class_year = $current_year;
                            $LastPaymentForReset->save();

                            $LastPaymentForReset = LastDiscountsForReset::where('st_id', $PromotedStudentData->id)->first();
                            $LastPaymentForReset->class = $promote_class;
                            $LastPaymentForReset->roll_no = $PromotedStudentData->roll_no;
                            $LastPaymentForReset->class_year = $current_year;
                            $LastPaymentForReset->save();

                            $LastPaymentForReset = LastDuesForReset::where('st_id', $PromotedStudentData->id)->first();
                            $LastPaymentForReset->class = $promote_class;
                            $LastPaymentForReset->class_year = $current_year;
                            $LastPaymentForReset->save();

                            $LastFreeFeeForReset = LastFreeFeeForReset::where('st_id', $PromotedStudentData->id)->first();
                            $LastFreeFeeForReset->class = $promote_class;
                            $LastFreeFeeForReset->class_year = $current_year;
                            $LastFreeFeeForReset->save();

                            $first_name = $PromotedStudentData->first_name . " " . $PromotedStudentData->middle_name . " " . $PromotedStudentData->last_name;
                            array_push($ArrayPromotedStudent, $first_name);
                        }
                    } else {
                        $first_name = $PromotedStudentData->first_name . " " . $PromotedStudentData->middle_name . " " . $PromotedStudentData->last_name;
                        array_push($NotPromotedStudent, $first_name);
                    }
                } 
                // New Year create data in else
                else {
                    if ($PromotedStudentData) {
 
                        // Student Update For Promote
                        $Student = Student::where('id', $PromotedStudentData->id)->first();
                        $Student->class = $promote_class;
                        $Student->class_year = $current_year;
                        $Student->save();
 
                    
                        // DuesAmount create or Update For Promote 
                        if (!DuesAmount::where('st_id', $PromotedStudentData->id)->where('class_year', $current_year)->exists()) {
                            $DuesAmount = new DuesAmount;
                            $DuesAmount->st_id = $PromotedStudentData->id;
                            $DuesAmount->class = $promote_class;
                            $DuesAmount->class_year = $current_year;
                            $DuesAmount->save();
                        } else {
                            $DuesAmount = DuesAmount::where('st_id', $PromotedStudentData->id)->where("class_year", $current_year)->first();
                            $DuesAmount->class = $promote_class;
                            $DuesAmount->save();
                        }

                        // FeeDiscount create or Update For Promote 
                        if (!FeeDiscount::where('st_id', $PromotedStudentData->id)->where('class_year', $current_year)->exists()) {
                            $FeeDiscount = new FeeDiscount;
                            $FeeDiscount->st_id = $PromotedStudentData->id;
                            $FeeDiscount->class = $promote_class;
                            $FeeDiscount->class_year = $current_year;
                            $FeeDiscount->save();
                        } else {
                            $FeeDiscount = FeeDiscount::where('st_id', $PromotedStudentData->id)->where("class_year", $current_year)->first();
                            $FeeDiscount->class = $promote_class;
                            $FeeDiscount->save();
                        }

                        // FreeFee create or Update For Promote 
                        if (!FeeFree::where('st_id', $PromotedStudentData->id)->where('class_year', $current_year)->exists()) {
                            $FeeFree = new FeeFree;
                            $FeeFree->st_id = $PromotedStudentData->id;
                            $FeeFree->class = $promote_class;
                            $FeeFree->class_year = $current_year;
                            $FeeFree->save();
                        } else {
                            $FeeFree = FeeFree::where('st_id', $PromotedStudentData->id)->where("class_year", $current_year)->first();
                            $FeeFree->class = $promote_class;
                            $FeeFree->save();
                        }

                        // FeePayment create or Update For Promote 
                        if (!FeePayment::where('st_id', $PromotedStudentData->id)->where('class_year', $current_year)->exists()) {
                            $FeePayment = new FeePayment;
                            $FeePayment->st_id = $PromotedStudentData->id;
                            $FeePayment->class = $promote_class;
                            $FeePayment->class_year = $current_year;
                            $FeePayment->total_fee = 0;
                            $FeePayment->total_dues = 0;
                            $FeePayment->total_payment =  0;
                            $FeePayment->total_discount =  0;
                            $FeePayment->free_fee =  0;
                            $FeePayment->save();


                            // BackYear Total Calculate 
                             $backyeardate = $current_year-1;
                             if (FeePayment::where('st_id', $PromotedStudentData->id)->where('class_year', $backyeardate)->exists()) {
                                $backYearPayment = FeePayment::where('st_id', $PromotedStudentData->id)->where('class_year', $backyeardate)->first();
                                if ($backYearPayment) {
                                    $total_payment = $backYearPayment->month_0 + $backYearPayment->month_1 + $backYearPayment->month_2 + $backYearPayment->month_3 + $backYearPayment->month_4 + $backYearPayment->month_5 + $backYearPayment->month_6 + $backYearPayment->month_7 + $backYearPayment->month_8 + $backYearPayment->month_9 + $backYearPayment->month_10 + $backYearPayment->month_11;
                                    $backYearPayment->total_payment = $total_payment;
                                    $backYearPayment->save();
                                }
                             }                            

                             if (FeeDiscount::where('st_id', $PromotedStudentData->id)->where('class_year', $backyeardate)->exists()) {
                                $backYearFeeDiscount = FeeDiscount::where('st_id', $PromotedStudentData->id)->where('class_year', $backyeardate)->first();
                                $backYearPayment = FeePayment::where('st_id', $PromotedStudentData->id)->where('class_year', $backyeardate)->first();

                                if ($backYearFeeDiscount) {
                                    $total_discount = $backYearFeeDiscount->month_0 + $backYearFeeDiscount->month_1 + $backYearFeeDiscount->month_2 + $backYearFeeDiscount->month_3 + $backYearFeeDiscount->month_4 + $backYearFeeDiscount->month_5 + $backYearFeeDiscount->month_6 + $backYearFeeDiscount->month_7 + $backYearFeeDiscount->month_8 + $backYearFeeDiscount->month_9 + $backYearFeeDiscount->month_10 + $backYearFeeDiscount->month_11;
                                    $backYearPayment->total_discount = $total_discount;
                                    $backYearPayment->save();
                                }
                             }

                             if (FeeFree::where('st_id', $PromotedStudentData->id)->where('class_year', $backyeardate)->exists()) {
                                $backYearFeeFree = FeeFree::where('st_id', $PromotedStudentData->id)->where('class_year', $backyeardate)->first();
                                $backYearPayment = FeePayment::where('st_id', $PromotedStudentData->id)->where('class_year', $backyeardate)->first();
                                if ($backYearFeeFree) {
                                    $total_free_fee = $backYearFeeFree->month_0 + $backYearFeeFree->month_1 + $backYearFeeFree->month_2 + $backYearFeeFree->month_3 + $backYearFeeFree->month_4 + $backYearFeeFree->month_5 + $backYearFeeFree->month_6 + $backYearFeeFree->month_7 + $backYearFeeFree->month_8 + $backYearFeeFree->month_9 + $backYearFeeFree->month_10 + $backYearFeeFree->month_11;
                                    $backYearPayment->free_fee = $total_free_fee;
                                    $backYearPayment->save();
                                }
                             }

                             

                        } else {
                            $FeePayment = FeePayment::where('st_id', $PromotedStudentData->id)->where("class_year", $current_year)->first();
                            $total_paying = $FeePayment->total_payment + $FeePayment->free_fee + $FeePayment->total_discount;
                            $FeePayment->class = $promote_class;
                            $FeePayment->class_year = $current_year;
                            $FeePayment->total_fee = 0;
                            $FeePayment->total_payment =  0;
                            $FeePayment->total_discount =  0;
                            $FeePayment->free_fee =  0;
                            $FeePayment->total_dues = 0;
                            $FeePayment->save();
                        }

                        $LastPaymentForReset = LastPaymentForReset::firstOrNew(['st_id' => $PromotedStudentData->id]);
                        $LastPaymentForReset->class = $promote_class;
                        $LastPaymentForReset->class_year = $current_year;
                        $LastPaymentForReset->save();
                        
                        $LastDiscountsForReset = LastDiscountsForReset::firstOrNew(['st_id' => $PromotedStudentData->id]);
                        $LastDiscountsForReset->class = $promote_class;
                        $LastDiscountsForReset->roll_no = $PromotedStudentData->roll_no;
                        $LastDiscountsForReset->class_year = $current_year;
                        $LastDiscountsForReset->save();
                        
                        $LastDuesForReset = LastDuesForReset::firstOrNew(['st_id' => $PromotedStudentData->id]);
                        $LastDuesForReset->class = $promote_class;
                        $LastDuesForReset->class_year = $current_year;
                        $LastDuesForReset->save();
                        
                        $LastFreeFeeForReset = LastFreeFeeForReset::firstOrNew(['st_id' => $PromotedStudentData->id]);
                        $LastFreeFeeForReset->class = $promote_class;
                        $LastFreeFeeForReset->class_year = $current_year;
                        $LastFreeFeeForReset->save();
                        

                        $first_name = $PromotedStudentData->first_name . " " . $PromotedStudentData->middle_name . " " . $PromotedStudentData->last_name;
                        array_push($ArrayPromotedStudent, $first_name);
                    }
                }
            }
            ////// End Promoted Student //////

            ////// Start Demotion Student //////
            for ($i = 0; $i < $DemotionStudentlength; $i++) {
                $DemotionStudentData = Student::where('class', $from_class)->whereIn('id', [$DemotionStudent[$i]])->first();
                if ($DemotionStudentData) {
                    // Student Update For Demotion 
                    $studentUpdated = Student::where('id', $DemotionStudentData->id)->first();
                    $studentUpdated->class_year = $current_year;
                    $studentUpdated->save();

                    $Student = Student::where('id', $DemotionStudentData->id)->first();
                    $Student->class_year = $current_year;
                    $Student->save();

                    // FeePayment create or Update For Demotion 
                    if (!FeePayment::where('st_id', $DemotionStudentData->id)->where('class_year', $current_year)->exists()) {
                        $FeePayment = new FeePayment;
                        $FeePayment->st_id = $DemotionStudentData->id;
                        $FeePayment->class = $from_class;
                        $FeePayment->class_year = $current_year;
                        $FeePayment->total_fee = 0;
                        $FeePayment->total_dues = 0;
                        $FeePayment->total_payment =  0;
                        $FeePayment->total_discount =  0;
                        $FeePayment->free_fee = 0;
                        // $FeePayment->roll_no = $DemotionStudentData->roll_no;
                        $FeePayment->save();
                    } else {
                        $FeePayment = FeePayment::where('st_id', $DemotionStudentData->id)->where("class_year", $current_year)->first();
                        $total_paying = $FeePayment->total_payment + $FeePayment->free_fee + $FeePayment->total_discount;
                        $FeePayment->class = $from_class;
                        $Student->class_year = $current_year;
                        $FeePayment->total_dues = 0;
                        // $FeePayment->roll_no = $DemotionStudentData->roll_no;
                        $FeePayment->save();
                    }

                    // DuesAmount create or Update For Demotion 
                    if (!DuesAmount::where('st_id', $DemotionStudentData->id)->where('class_year', $current_year)->exists()) {
                        $DuesAmount = new DuesAmount;
                        $DuesAmount->st_id = $DemotionStudentData->id;
                        $DuesAmount->class = $from_class;
                        $DuesAmount->class_year = $current_year;
                        // $DuesAmount->roll_no = $DemotionStudentData->roll_no;
                        $DuesAmount->save();
                    } else {
                        $DuesAmount = DuesAmount::where('st_id', $DemotionStudentData->id)->where("class_year", $current_year)->first();
                        $DuesAmount->class = $from_class;
                        $DuesAmount->class_year = $current_year;
                        // $DuesAmount->roll_no = $DemotionStudentData->roll_no;
                        $DuesAmount->save();
                    }

                    // FeeDiscount create or Update For Demotion 
                    if (!FeeDiscount::where('st_id', $DemotionStudentData->id)->where('class_year', $current_year)->exists()) {
                        $FeeDiscount = new FeeDiscount;
                        $FeeDiscount->st_id = $DemotionStudentData->id;
                        $FeeDiscount->class = $from_class;
                        $FeeDiscount->class_year = $current_year;
                        // $FeeDiscount->roll_no = $DemotionStudentData->roll_no;
                        $FeeDiscount->save();
                    } else {
                        $FeeDiscount = FeeDiscount::where('st_id', $DemotionStudentData->id)->where("class_year", $current_year)->first();
                        $FeeDiscount->class = $from_class;
                        $Student->class_year = $current_year;
                        $FeeDiscount->save();
                    }

                    // FeeFree create or Update For Demotion 
                    if (!FeeFree::where('st_id', $DemotionStudentData->id)->where('class_year', $current_year)->exists()) {
                        $FeeFree = new FeeFree;
                        $FeeFree->st_id = $DemotionStudentData->id;
                        $FeeFree->class = $from_class;
                        $FeeFree->class_year = $current_year;
                        // $FeeFree->roll_no = $DemotionStudentData->roll_no;
                        $FeeFree->save();
                    } else {
                        $FeeFree = FeeFree::where('st_id', $DemotionStudentData->id)->where("class_year", $current_year)->first();
                        $FeeFree->class = $from_class;
                        $Student->class_year = $current_year;
                        $FeeDiscount->save();
                    }

                    $LastPaymentForReset = LastPaymentForReset::firstOrNew(['st_id' => $DemotionStudentData->id]);
                    $LastPaymentForReset->class = $from_class;
                    // $LastPaymentForReset->roll_no = $DemotionStudentData->roll_no;
                    $LastPaymentForReset->class_year = $current_year;
                    $LastPaymentForReset->save();
                    
                    $LastDiscountsForReset = LastDiscountsForReset::firstOrNew(['st_id' => $DemotionStudentData->id]);
                    $LastDiscountsForReset->class = $from_class;
                    // $LastDiscountsForReset->roll_no = $DemotionStudentData->roll_no;
                    $LastDiscountsForReset->class_year = $current_year;
                    $LastDiscountsForReset->save();
                    
                    $LastDuesForReset = LastDuesForReset::firstOrNew(['st_id' => $DemotionStudentData->id]);
                    $LastDuesForReset->class = $from_class;
                    // $LastDuesForReset->roll_no = $DemotionStudentData->roll_no;
                    $LastDuesForReset->class_year = $current_year;
                    $LastDuesForReset->save();
                    
                    $LastFreeFeeForReset = LastFreeFeeForReset::firstOrNew(['st_id' => $DemotionStudentData->id]);
                    $LastFreeFeeForReset->class = $from_class;
                    // $LastFreeFeeForReset->roll_no = $DemotionStudentData->roll_no;
                    $LastFreeFeeForReset->class_year = $current_year;
                    $LastFreeFeeForReset->save();
                    
                }
            }
            ////// End Demotion Student //////

            return response(array('status' => "Promoted Success", "NotPromotedStudent" => $NotPromotedStudent, "PromotedStudent" => $PromotedStudent), 200);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
