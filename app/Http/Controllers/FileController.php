<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\FileProcessingService;

class FileController extends Controller
{
    protected $fileProcessingService;

    public function __construct(FileProcessingService $fileProcessingService)
    {
        $this->fileProcessingService = $fileProcessingService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('upload');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function upload(Request $request): RedirectResponse
    {
        $request->validate([
            'dictionary' => 'required|file|mimes:txt',
        ]);

        $path = $request->file('dictionary')->store('src');

        $this->fileProcessingService->processFile(storage_path('app/' . $path));

        return redirect()->route('file.index')->with('success', 'File processed successfully.');
    }
}
