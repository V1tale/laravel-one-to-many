<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();
        $newProject = new Project();
        $newProject->title = $form_data['title'];
        $newProject->content = $form_data['content'];
        $newProject->slug = Str::slug($form_data['title']);


        if ($request->hasFile('image')) {
            $path = Storage::put('images', $request->image);
            $form_data['image'] = $path;
            $newProject->image = $path;
        }

        $newProject->save();
        // dd($form_data);
        return redirect()->route('admin.projects.show', $newProject->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Project  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        if ($request->hasFile('image')) {
            $form_data = $request->all();
            $form_data['slug'] = Str::slug($form_data['title']);
            if ($project->image) {
                Storage::delete($project->image);
            }
            $path = Storage::put('images', $request->image);
            $form_data['image'] = $path;
        }
        $project->update($form_data);
        return redirect()->route('admin.projects.index')->with('message', "Il progetto $project->title è stato aggiornato");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        Storage::delete($project->image);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', "'$project->title' è stato cancellato");
    }
}
