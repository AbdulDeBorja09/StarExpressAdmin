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
use App\Models\logs;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\Vue;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ExpensesController extends Controller
{

    private function logs($action, $table, $recordId, $oldData, $newData)
    {
        $changes = [];
        foreach ($oldData as $key => $oldValue) {
            if (array_key_exists($key, $newData) && $newData[$key] != $oldValue) {
                $changes[$key] = [
                    'old' => $oldValue,
                    'new' => $newData[$key]
                ];
            }
        }
        Logs::create([
            'branch_id' => Auth::user()->branch_id,
            'action' => $action,
            'table' => $table,
            'record_id' => $recordId,
            'old_data' => $oldData ? json_encode($oldData) : null,
            'new_data' => $newData ? json_encode($newData) : null,
            'user_id' => Auth::user()->id,
        ]);
    }

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
                    'method' =>  $request->method,
                    'submitted_by' => Auth::user()->lname . ', ' . Auth::user()->fname,
                    'received_by' => Auth::user()->lname . ', ' . Auth::user()->fname,
                    'amount' =>  $request->amount,
                    'confirm' => 1,
                    'note' => $request->note,
                ]);
                return redirect()->route('newreport');
            } else {
                Expenses::create([
                    'branch_id' => Auth::user()->branch_id,
                    'category' => 'From report',
                    'reference' => $request->reference,
                    'method' =>  $request->method,
                    'submitted_by' => Auth::user()->lname . ', ' . Auth::user()->fname,
                    'received_by' => Auth::user()->lname . ', ' . Auth::user()->fname,
                    'amount' =>  $request->amount,
                    'confirm' => 1,
                    'note' => $request->note,
                ]);
                return redirect()->route('newreport');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function requestreport(Request $request)
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
                    'method' =>  $request->method,
                    'submitted_by' => Auth::user()->lname . ', ' . Auth::user()->fname,
                    'amount' =>  $request->amount,
                    'confirm' => 0,
                    'note' => $request->note,
                ]);
                return redirect()->back();
            } else {
                Expenses::create([
                    'branch_id' => Auth::user()->branch_id,
                    'category' => 'From report',
                    'reference' => $request->reference,
                    'method' =>  $request->method,
                    'submitted_by' => Auth::user()->lname . ', ' . Auth::user()->fname,
                    'amount' =>  $request->amount,
                    'confirm' => 0,
                    'note' => $request->note,
                ]);
                return redirect()->back();
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function getIncome(Request $request, $category = null)
    {
        $perPage = $request->input('perPage', 20);
        if (Auth::user()->type === 'accountant') {
            $query = Income::with(['service', 'branch'])->where('branch_id', Auth::user()->branch_id)->where('confirm', 1);
        } else {
            $query = Income::with(['service', 'branch'])->where('confirm', 1);
        }

        if ($category) {
            $query->where('category', $category);
        }

        $income = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return view('accountant.allincome', compact('perPage', 'income'));
    }

    public function getExpenses(Request $request, $category = null)
    {
        $perPage = $request->input('perPage', 20);

        if (Auth::user()->type === 'accountant') {
            $query = Expenses::with(['manager', 'branch'])->where('branch_id', Auth::user()->branch_id)->where('confirm', 1);
        } else {
            $query = Expenses::with(['manager', 'branch'])->where('branch_id', Auth::user()->branch_id)->where('confirm', 1);
        }

        if ($category) {
            $query->where('category', $category);
        }

        $expenses = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return view('accountant.allexpenses', compact('perPage', 'expenses'));
    }

    public function allincome(Request $request)
    {
        return $this->getIncome($request);
    }

    public function reportincome(Request $request)
    {
        return $this->getIncome($request, 'From report');
    }

    public function cargoincome(Request $request)
    {
        return $this->getIncome($request, 'Cargo Income');
    }

    public function allexpenses(Request $request)
    {
        return $this->getExpenses($request);
    }

    public function deliveryexpenses(Request $request)
    {
        return $this->getExpenses($request, 'Delivery Allowance');
    }

    public function reportexpenses(Request $request)
    {
        return $this->getExpenses($request, 'From report');
    }

    public function submittedreports(Request $request)
    {
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);


        if (Auth::user()->type === 'accountant' || Auth::user()->type === 'admin') {

            if (Auth::user()->type === 'accountant') {
                $expenses = Expenses::select('*', DB::raw("'Expense' as type"))->whereIn('confirm', [1, 0])->where('branch_id', Auth::user()->branch_id)->where('confirm', 0)
                    ->get()
                    ->toArray();

                $incomes = Income::select('*', DB::raw("'Income' as type"))->whereIn('confirm', [1, 0])->where('branch_id', Auth::user()->branch_id)->where('confirm', 0)
                    ->get()
                    ->toArray();
            } else {
                $expenses = Expenses::select('*', DB::raw("'Expense' as type"))->whereIn('confirm', [1, 0])->where('confirm', 0)
                    ->get()
                    ->toArray();

                $incomes = Income::select('*', DB::raw("'Income' as type"))->whereIn('confirm', [1, 0])->where('confirm', 0)
                    ->get()
                    ->toArray();
            }
        } else {
            $expenses = Expenses::select('*', DB::raw("'Expense' as type"))->where('submitted_by', Auth::user()->lname . ', ' . Auth::user()->fname)->whereIn('confirm', [1, 0])
                ->get()
                ->toArray();

            $incomes = Income::select('*', DB::raw("'Income' as type"))->where('submitted_by', Auth::user()->lname . ', ' . Auth::user()->fname)->whereIn('confirm', [1, 0])
                ->get()
                ->toArray();
        }


        $combinedData = array_merge($expenses, $incomes);
        usort($combinedData, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        $data = new LengthAwarePaginator(
            array_slice($combinedData, ($currentPage - 1) * $perPage, $perPage),
            count($combinedData),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );


        return view('servicemanager.allreports', compact('data', 'perPage', 'currentPage'));
    }
    
    public function reporthistory(Request $request)
    {
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);


        if (Auth::user()->type === 'accountant' || Auth::user()->type === 'admin') {

            if (Auth::user()->type === 'accountant') {
                $expenses = Expenses::select('*', DB::raw("'Expense' as type"))->where('branch_id', Auth::user()->branch_id)->whereIn('confirm', [1, 2])
                    ->get()
                    ->toArray();

                $incomes = Income::select('*', DB::raw("'Income' as type"))->where('branch_id', Auth::user()->branch_id)->whereIn('confirm', [1, 2])
                    ->get()
                    ->toArray();
            } else {
                $expenses = Expenses::select('*', DB::raw("'Expense' as type"))->whereIn('confirm', [1, 2])
                    ->get()
                    ->toArray();

                $incomes = Income::select('*', DB::raw("'Income' as type"))->whereIn('confirm', [1, 2])
                    ->get()
                    ->toArray();
            }
        } else {
            $expenses = Expenses::select('*', DB::raw("'Expense' as type"))->where('submitted_by', Auth::user()->lname . ', ' . Auth::user()->fname)->whereIn('confirm', [1, 2])
                ->get()
                ->toArray();

            $incomes = Income::select('*', DB::raw("'Income' as type"))->where('submitted_by', Auth::user()->lname . ', ' . Auth::user()->fname)->whereIn('confirm', [1, 2])
                ->get()
                ->toArray();
        }


        $combinedData = array_merge($expenses, $incomes);
        usort($combinedData, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        $data = new LengthAwarePaginator(
            array_slice($combinedData, ($currentPage - 1) * $perPage, $perPage),
            count($combinedData),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );


        return view('servicemanager.allreports', compact('data', 'perPage', 'currentPage'));
    }


    public function viewreportdetails($type, $id)
    {

        if ($type === 'Income') {
            $report = Income::find($id);
        } else {
            $report = Expenses::find($id);
        }
        return view('global.viewreport', compact('report', 'type'));
    }


    public function approvereport(Request $request)
    {

        if ($request->type === 'Income') {
            $item =  Income::find($request->id);
            $oldData = $item->toArray();
            Income::where('id', $request->id)->update([
                'confirm' => 1,
                'received_by' => Auth::user()->lname . ', ' . Auth::user()->fname,
            ]);
            $newData = Income::find($request->id)->toArray();

            $this->logs('Edit', 'Approve Income', $request->id, $oldData, $newData);
        } else {
            $item =  Expenses::find($request->id);
            $oldData = $item->toArray();
            Expenses::where('id', $request->id)->update([
                'confirm' => 1,
                'received_by' => $request->received_by,
            ]);
            $newData = Expenses::find($request->id)->toArray();
            $this->logs('Edit', 'Approve Expenses', $request->id, $oldData, $newData);
        }

        return redirect()->back()->with('success', 'Report approved successfully.');
    }

    public function rejectreport(Request $request)
    {

        if ($request->type === 'Income') {
            $item =  Income::find($request->id);
            $oldData = $item->toArray();
            Income::where('id', $request->id)->update([
                'confirm' => 2,
                'received_by' => Auth::user()->lname . ', ' . Auth::user()->fname,
            ]);
            $newData = Income::find($request->id)->toArray();
            $this->logs('Edit', 'Reject Income', $request->id, $oldData, $newData);
        } else {
            $item =  Expenses::find($request->id);
            $oldData = $item->toArray();
            Expenses::where('id', $request->id)->update([
                'confirm' => 2,
                'received_by' => Auth::user()->lname . ', ' . Auth::user()->fname,
            ]);
            $newData = Expenses::find($request->id)->toArray();
            $this->logs('Edit', 'Reject Expenses', $request->id, $oldData, $newData);
        }

        return redirect()->back()->with('success', 'Report approved successfully.');
    }
}
