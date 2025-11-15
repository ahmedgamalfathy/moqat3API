<?php

namespace App\Http\Controllers\API\V1\Dashboard\Media;

use App\Enums\ResponseCode\HttpStatusCode;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Media\MediaService;
use App\Http\Requests\Media\CreateMediaRequest;
use App\Http\Requests\Media\UpdateMediaRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
// use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use League\Uri\Http;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $mediaService;
    public function __construct(MediaService $mediaService) {
     $this->mediaService =$mediaService;
    }
    // public static function middleware(): array
    // {
    //     return [// medias ,create_medias,edit_meida ,update_meida ,destroy_meida
    //         new Middleware('auth:api'),
    //         new Middleware('permission:medias', only:['index']),
    //         new Middleware('permission:create_medias', only:['create']),
    //         new Middleware('permission:edit_meida', only:['edit']),
    //         new Middleware('permission:update_meida', only:['update']),
    //         new Middleware('permission:destroy_meida', only:['destroy']),
    //         new Middleware('tenant'),
    //     ];
    // }
    public function index(Request $request)
    {
        $category = $request->query('category');
        $media =$this->mediaService->allMedia($category);
        return ApiResponse::success($media);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMediaRequest $createMediaRequest)
    {
        try {
        $this->mediaService->createMedia($createMediaRequest->validated());
        return ApiResponse::success([],__('crud.created'));
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
         return ApiResponse::error(__('crud.not_found'),[],HttpStatusCode::NOT_FOUND);
        }catch (\Throwable $th) {
         return ApiResponse::error(__('crud.server_error'),$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
         $media =$this->mediaService->editMedia($id);
         return ApiResponse::success($media);
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
         return ApiResponse::error(__('crud.not_found'),[],HttpStatusCode::NOT_FOUND);
        }catch (\Throwable $th) {
         return ApiResponse::error(__('crud.server_error'),$th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMediaRequest $updateMediaRequest, int $id)
    {
      try{
            $this->mediaService->updateMedia($id,$updateMediaRequest->validated());
            return ApiResponse::success([],__('crud.updated'));
       }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
         return ApiResponse::error(__('crud.not_found'),[],HttpStatusCode::NOT_FOUND);
        }catch (\Throwable $th) {
         return ApiResponse::error(__('crud.server_error'),$th->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
        $this->mediaService->deleteMedia($id);
        return ApiResponse::success([],__('crud.deleted'));
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
         return ApiResponse::error(__('crud.not_found'),[],HttpStatusCode::NOT_FOUND);
        }catch (\Throwable $th) {
         return ApiResponse::error(__('crud.server_error'),$th->getMessage());
        }

    }
}
