<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//model 
use App\UsaState;
use Session;
use App\UsaRates;
class UsaRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRates = UsaRates::all();
//        echo '<pre>';
//        print_r($allRates->all());
//        echo '<br>'.$allRates->is_active;
//        exit;        
        $viewdata['allRates'] = $allRates;
        return view('admin/statewiseRateListing',$viewdata);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = UsaState::all();        
        $viewdata['states'] = $states;
        return view('admin/addStateWiseRates',$viewdata);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //add new rate
         $messages = [
            'required' => 'Field Value is required.',
            'numeric' => 'It must be decimal value.',
        ];
        $this->validate($request, [
            'usa_state_id' => 'required',
            'base_fee' => 'required|numeric|between:0,99.99',
            'time_fee' => 'required|numeric|between:0,99.99',
            'mile_fee' => 'required|numeric|between:0,99.99',
            'cancel_fee' => 'required|numeric|between:0,99.99',
            'overmile_fee' => 'required|numeric|between:0,99.99',            
                ], $messages);
        $rate_exist = UsaRates::where('usa_state_id', $request->usa_state_id)->count();         
//        echo '<pre>';
//        print_r($rate_exist);
//        exit;
        if($rate_exist > 0){
            return redirect(route('admin.rates.index'))->with('Error', 'Rate is already exist please update it.');
        }else{
            $usa_rates = new UsaRates();
            $usa_rates->usa_state_id = $request->usa_state_id;
            $usa_rates->base_fee = $request->base_fee;
            $usa_rates->time_fee = $request->time_fee;
            $usa_rates->mile_fee = $request->mile_fee;
            $usa_rates->cancel_fee = $request->cancel_fee;
            $usa_rates->overmile_fee = $request->overmile_fee;
            if ($usa_rates->save()) {            
                return redirect()->back()->with('success', 'New Rate is added.');
            } else {            
                return redirect()->back()->withInput($request);
            }
        }
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rate = UsaRates::find($id);
        $states = UsaState::all();        
        $viewdata['states'] = $states;
//        echo '<pre>';
//        print_r($rate);
//        exit;
        $viewdata['edit_rate'] = $rate;        
        return view('admin/updateStateWiseRate',$viewdata);        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        echo '<pre>';
//        print_r($request->all());
//        exit;
        
        $usa_rates_update = UsaRates::find($id);
        $messages = [
            'required' => 'Rate :attribute is required.',
            'numeric' => 'It must be decimal value.',
        ];
        $this->validate($request, [
            'usa_state_id' => 'required',
            'base_fee' => 'required|numeric|between:0,99.99',
            'time_fee' => 'required|numeric|between:0,99.99',
            'mile_fee' => 'required|numeric|between:0,99.99',
            'cancel_fee' => 'required|numeric|between:0,99.99',
            'overmile_fee' => 'required|numeric|between:0,99.99',
                ], $messages);
//        $usa_rates_update = new UsaRates();
        $usa_rates_update->usa_state_id = $request->usa_state_id;
        $usa_rates_update->base_fee = $request->base_fee;
        $usa_rates_update->time_fee = $request->time_fee;
        $usa_rates_update->mile_fee = $request->mile_fee;
        $usa_rates_update->cancel_fee = $request->cancel_fee;
        $usa_rates_update->overmile_fee = $request->overmile_fee;
        $usa_rates_update->is_active = $request->is_active;
//        echo $usa_rates_update->is_active;
//        exit;
        if ($usa_rates_update->save()) {            
            return redirect()->back()->with('success', 'Rate is Updated.');
        } else {            
            return redirect()->back()->withInput($request);
        }
        
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //rate in active on delete
        $usa_rates_inactive = UsaRates::find($id);
        if($usa_rates_inactive->is_active == 1){
            $status = 0;
        }else{
            $status = 1;
        }
        
        $usa_rates_inactive->is_active = $status;
        $usa_rates_inactive->save();
//        print_r($usa_rates_inactive);        
//        return redirect()->back()->with('error', 'Rate is Deleted.');
        return redirect(route('admin.rates.index'));
        
    }
}
