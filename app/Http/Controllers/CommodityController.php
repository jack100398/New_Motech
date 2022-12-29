<?php

namespace App\Http\Controllers;

use App\Commodity;
use App\Http\Services\CommodityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommodityController extends Controller
{
    /** @var CommodityService */
    private $service;


    public function __construct(CommodityService $service)
    {
        $this->service = $service;
    }

    public function index() {
        return view('commodity');
    }

    public function show($id) {
        return Commodity::query()->where('id', $id)->first();
    }

    public function update($id, Request $request) {
        Commodity::query()->where('id', $id)->update($request->all());
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        $commodity = Commodity::query()->create($data);
        
        return response()->json($commodity->id);
    }

    public function getCommodities()
    {
        $commodities = Commodity::query()->get()->map(function (Commodity $commodity) {
            return view('component.card', ['id' => $commodity->id, 'name' => $commodity->name, 'src' => $commodity->picture_one])->toHtml();
        });

        return response($commodities);
    }

    public function destroy(Commodity $commodity) {
        $commodity->delete();
    }

    public function search(Request $request)
    {
        $data = $request->validate([
            'video' => 'required',
            'direction' => 'required',
            'resolution' => 'required',
            'weight' => 'required',
            'acceleration' => 'required',
            'acceleration_time' => 'required',
            'constant_time' => 'required',
            'distance' => 'required',
            'linear_ruler' => 'required',
        ]);
        if ($data['direction'] === "0") {
            $data['weight'] = $data['weight'] * 2;
        }

        $commodities = $this->service->searchCommoditiesByInfo($data);

        $speeding_up = $this->service->countSpeedingUp($data);
        $speeding_up_time = $this->service->countSpeedUpTime($speeding_up, $data);
        $constant_time = $this->service->countConstantTime($data);
        $data['total_time'] = $speeding_up_time * 2 + $constant_time;
        $data['speeding_up'] = $speeding_up;

        $commodity = $this->service->transformCommodities($commodities, $data)->first();

        if ($commodity === null) {
            return '沒有符合的產品';
        } else {
            return view('component.searchCard', ['id' => $commodity->id, 'name' => $commodity->name, 'src' => $commodity->picture_one])->toHtml();
        }
    }
}
