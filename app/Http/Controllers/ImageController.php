<?php

namespace App\Http\Controllers;

use App\Http\Requests\LibraryRequest;
use App\Library;
use App\Traits\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    use UploadFile;

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $folderId = $request['folder_id'];
        return view('dashboard.library.images.create', compact('folderId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LibraryRequest $request
     * @return Response
     */
    public function store(LibraryRequest $request)
    {
        $image = Library::create($request->all());

        if($request->hasFile('image')){
            $path = $this->upload($request['image']);
            $image->images()->create(['path' => $path]);
        }

        return redirect()->route('folders.show', $image->folder->id)
            ->with('success', 'Image created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $image = Library::whereId($id)->first();
        return view('dashboard.library.images.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LibraryRequest $request
     * @param int $id
     * @return Response
     */
    public function update(LibraryRequest $request, $id)
    {
        $image = Library::whereId($id)->first();
        $image->update($request->all());

        if($request->hasFile('image')){
            $path = $this->upload($request['image']);
            $image->images()->update(['path' => $path]);
        }

        return redirect()->route('folders.show', $image->folder->id)
            ->with('success', 'File created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $image = Library::whereId($id)->first();
        $image->delete();
        return redirect()->route('folders.show', $image->folder->id)
            ->with('success', 'File deleted successfully');
    }
}
