<?php

namespace App\Http\Controllers;

use App\Models\CargoBoxes;
use App\Models\WarehouseLimit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    public function warehouse()
    {
        if (Auth::user()->type === 'admin') {
            $results = DB::select("
                SELECT 
                    JSON_UNQUOTE(JSON_EXTRACT(item, '$.Boxid')) AS box_id,
                    SUM(CAST(JSON_UNQUOTE(JSON_EXTRACT(item, '$.qty')) AS UNSIGNED)) AS total_qty
                FROM (
                    SELECT JSON_EXTRACT(items, CONCAT('$[', n.i, ']')) AS item
                    FROM orders
                    CROSS JOIN (
                        SELECT 0 AS i
                    ) n
                    WHERE JSON_VALID(items)
                ) AS extracted_items
                WHERE JSON_EXTRACT(item, '$.Boxid') IS NOT NULL
                GROUP BY box_id
            ");
        } else {
            $results = DB::select("
                SELECT 
                    JSON_UNQUOTE(JSON_EXTRACT(item, '$.Boxid')) AS box_id,
                    SUM(CAST(JSON_UNQUOTE(JSON_EXTRACT(item, '$.qty')) AS UNSIGNED)) AS total_qty
                FROM (
                    SELECT JSON_EXTRACT(items, CONCAT('$[', n.i, ']')) AS item
                    FROM orders
                    CROSS JOIN (
                        SELECT 0 AS i
                    ) n
                    WHERE JSON_VALID(items) AND location = ?
                ) AS extracted_items
                WHERE JSON_EXTRACT(item, '$.Boxid') IS NOT NULL
                GROUP BY box_id
            ", [Auth::user()->branch_id]);
        }

        $quantities = collect($results)->keyBy('box_id');
        $boxes = CargoBoxes::where('branch_id', Auth::user()->branch_id)->get();
        $limits = WarehouseLimit::where('branch_id', Auth::user()->branch_id)->get();
        $progress = [];
        foreach ($limits as $limit) {
            $box = $boxes->firstWhere('id', $limit->box_id);
            $totalQty = $quantities->get($limit->box_id)->total_qty ?? 0; 

            $percentage = ($limit->limit > 0) ? ($totalQty / $limit->limit) * 100 : 0;

            $progress[] = [
                'box_id' => $limit->box_id,
                'box_name' => $box->name ?? 'Unknown', 
                'total_qty' => $totalQty,
                'limit' => $limit->limit,
                'percentage' => $percentage,
            ];
        }

        return view('servicemanager.warehouselimit', compact('boxes', 'progress'));
    }



    public function savelimit(Request $request)
    {
        WarehouseLimit::create([
            'branch_id' => Auth::user()->branch_id,
            'box_id' => $request->box_id,
            'limit' => $request->limit,
        ]);
        return redirect()->back()->with('success', 'Warehouse limit saved successfully');
    }
}
