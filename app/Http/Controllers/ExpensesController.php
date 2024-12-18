<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branches;
use App\Models\CargoBoxes;
use App\Models\CargoService;
use App\Models\CargoLocations;
use App\Models\CargoPrices;
use App\Models\CargoTruck;
use App\Models\Orders;
use App\Models\Delivery;
use App\Models\DeliveryAllowance;
use App\Models\TruckDriver;
use App\Models\Expenses;
use App\Models\Income;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\Vue;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;
use Carbon\Carbon;


class ExpensesController extends Controller
{
    public function expensestable()
    {
        return view('servicemanager.report');
    }






    public function newreport()
    {

        return view('accountant.addexpenses');
    }


    public function createnewreport(Request $request)
    {

        $request->validate([
            'reference' => 'nullable|string',
            'amount' => 'nullable|string',
        ]);


        try {
            if ($request->type === 'income') {
                Income::create([
                    'branch_id' => Auth::user()->branch_id,
                    'category' => 'From report',
                    'reference' => $request->reference,
                    'submitted_by' => Auth::user()->id,
                    'ammount' =>  $request->amount,
                ]);
                return redirect()->route('newreport');
            } else {
                Expenses::create([
                    'branch_id' => Auth::user()->branch_id,
                    'category' => 'From report',
                    'reference' => $request->reference,
                    'approved_by' => Auth::user()->id,
                    'submitted_by' => Auth::user()->id,
                    'amount' =>  $request->amount,
                ]);
                return redirect()->route('newreport');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function allincome(Request $request)
    {

        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);

        $income  = Income::with(['service', 'branch'])->orderBy('created_at', 'desc')->paginate($perPage);

        return view('accountant.allincome', compact('perPage', 'currentPage', 'income'));
    }
    public function allexpenses(Request $request)
    {
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);

        $income  = Expenses::with(['manager', 'branch'])->where('status', 'approved')->orderBy('created_at', 'desc')->paginate($perPage);

        return view('accountant.allexpenses', compact('perPage', 'currentPage', 'income'));
    }
}
