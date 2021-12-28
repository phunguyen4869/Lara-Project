<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\UploadService;

class UploadController extends Controller
{
    protected $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    public function store(Request $request)
    {
        $url = $this->uploadService->store($request);

        if ($url !== false) {
            return response()->json([
                'error' => false,
                'url' => $url,
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Upload failed',
            ]);
        }
    }
}
