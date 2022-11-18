<?php

namespace App\Http\Controllers\Backend;

use App\Models\Bill;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\DetailedBills;
use App\Models\AttributeValue;
use App\Models\Address\District;
use App\Http\Controllers\Controller;
use App\Models\Address\CityProvince;
use App\Models\Address\CommuneWardTown;
use Illuminate\Support\Facades\Response;

// use function GuzzleHttp\Promise\all;

class OrderBillController extends Controller
{
    public function view_detail_bill()
    {
        if (isset($_GET['id_bill_order'])) {

            $id_bill_order = $_GET['id_bill_order'];
            $bills  = Bill::find($id_bill_order);
            $detail_bills = DetailedBills::where('bill_id', $id_bill_order)->get();

            $products = Product::select('id_product', 'img_product')->get();
            // dd($city_provinces);
            return view(
                'backend.page.order_bill.view_detail_bill',
                compact(
                    'bills',
                    'detail_bills',

                    'products',
                )
            );
        }
    }
    public function update_status_bill(Request $request)
    {
        $order_bills = Bill::all();
        // dd($request->all());
        $id_bill = $request->id_bill;
        $status_bill = $request->status_bill;
        if (empty($status_bill)) {
            return response()->json(['warning' => 'Bạn chưa chọn trạng thái đơn !', 'code' => 1]);
        } else {
            Bill::find($id_bill)->update([
                'status_bill' => $status_bill,
            ]);
            // return view('backend.page.order_bill.include.table_conten_bill', compact('order_bills'));
            return response()->json(['success' => 'Cập nhập trạng thái thành công !', 'code' => 2]);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_bills = Bill::orderBy('created_at', 'desc')->get();
        // dd($order_bills);
        return view('backend.page.order_bill.list_bill', compact(
            'order_bills',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        if (isset($_GET['id_bill'])) {
            $id_bill = $_GET['id_bill'];
            $bill = Bill::find($id_bill);
            $detail_bills = $bill->detail_bill->sum('quantily');;

            dump($detail_bills);
            dump($bill);
            die;
        }
    }
}