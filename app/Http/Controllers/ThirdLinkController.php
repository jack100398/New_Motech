<?php

namespace App\Http\Controllers;

use App\Helpers\UrlHelper;
use App\ThirdLink;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ThirdLinkController extends Controller
{
    /** @var string 主標題 */
    protected const PAGE_CATEGORY = '第三方連結與Banner';

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $links = ThirdLink::query()->get()->map(function (ThirdLink $link) {
            return (new ThirdLink([
                'remark' => $link->remark,
                'image'  => UrlHelper::formatOutPutUrl($link->image),
                'url'    => UrlHelper::formatOutPutUrl($link->url)
            ]))->setAttribute('id', $link->id);
        });

        return view('Backstage.ThirdLink.link', [
            'page_categroy' => self::PAGE_CATEGORY,
            'page_title'    => 'Link總覽',
            'links'       => $links
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('Backstage.ThirdLink.editLink', [
            'page_categroy' => self::PAGE_CATEGORY,
            'page_title'    => 'link',
            'id'       => 0
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(ThirdLink::query()->create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $link = ThirdLink::find($id);

        $link = (new ThirdLink([
            'remark' => $link->remark,
            'image'  => UrlHelper::formatOutPutUrl($link->image),
            'url'    => UrlHelper::formatOutPutUrl($link->url)
        ]))->setAttribute('id', $link->id);

        return response()->json($link);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request $request
     * @return View
     */
    public function edit(Request $request): View
    {
        return view('Backstage.ThirdLink.editLink', [
            'page_categroy' => self::PAGE_CATEGORY,
            'page_title'    => 'link',
            'id'       => $request->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        return response()->json(ThirdLink::find($id)->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ThirdLink  $banner
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json(ThirdLink::find($id)->delete());
    }
}
