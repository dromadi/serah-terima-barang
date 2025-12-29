<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AreaUnit;
use App\Models\EscalationMatrix;
use App\Models\Holiday;
use App\Models\SlaSetting;
use App\Models\ToolCategory;
use App\Models\ToolLocation;
use App\Models\Vendor;
use App\Models\WorkType;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index()
    {
        return view('admin.masters', [
            'categories' => ToolCategory::all(),
            'locations' => ToolLocation::all(),
            'areas' => AreaUnit::all(),
            'workTypes' => WorkType::all(),
            'vendors' => Vendor::all(),
            'holidays' => Holiday::all(),
            'slaSettings' => SlaSetting::all(),
            'escalations' => EscalationMatrix::all(),
        ]);
    }

    public function store(Request $request, string $type)
    {
        $models = [
            'categories' => ToolCategory::class,
            'locations' => ToolLocation::class,
            'areas' => AreaUnit::class,
            'work-types' => WorkType::class,
            'vendors' => Vendor::class,
            'holidays' => Holiday::class,
            'sla-settings' => SlaSetting::class,
            'escalation-matrix' => EscalationMatrix::class,
        ];

        if (!isset($models[$type])) {
            abort(404);
        }

        $model = $models[$type];
        $model::create($request->all());

        return back();
    }
}
