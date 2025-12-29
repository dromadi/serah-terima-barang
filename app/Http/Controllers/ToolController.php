<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        return view('tools.index', [
            'tools' => Tool::with(['category', 'location'])->get(),
        ]);
    }

    public function show(Tool $tool)
    {
        return view('tools.show', [
            'tool' => $tool,
        ]);
    }

    public function scan(Request $request)
    {
        $tool = null;
        if ($request->filled('asset_no')) {
            $tool = Tool::where('asset_no', $request->input('asset_no'))
                ->orWhere('barcode', $request->input('asset_no'))
                ->first();
        }

        return view('tools.scan', [
            'tool' => $tool,
        ]);
    }
}
