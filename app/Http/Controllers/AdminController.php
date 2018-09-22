<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Genre;
use App\Movie;

class AdminController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    public function index()
    {
    	return view('admin.dashboard');
    }

    public function users()
    {
    	$users = User::all();

    	return view('admin.users', compact('users'));
    }

    public function deleteUser(User $user)
    {
    	$user->delete();

    	return back()->with('success', 'Deleted');
    }

    public function uploadVideo(Request $request)
    {
        $this->validate($request, [
        	'video' => 'required|mimetypes:video/mp4,video/mpeg',
        	'title' => 'required',
        ]);
       
        $video = $request->file('video');
        $ext = $video->getClientOriginalExtension();

        $destination = public_path('/movies/');
        
        $filename = str_slug($request->title).'-'.time().'-'.date('Y-m-d').'.'.$ext;
        $url = asset('movies/'.$filename);

        try {
            $video->move($destination, $filename);
        } catch (\Exception $e) {

            report($e);
            return back()->with('error','Video failed to upload');
            
        }

        $newVideo = new Movie();

        $newVideo->genre_id = $request->genre_id;
        $newVideo->url = $url;
        $newVideo->description = $request->description;
        $newVideo->title = $request->title;
        $newVideo->save();

        if ($newVideo) {
           
            return back()->with('success', 'Uploaded');
        }
            return back()->with('error', 'failed to upload');
    }

    public function editVideo(Request $request, Movie $movie)
    {
        

        $this->validate($request, [
        	'poster' => 'required|mimetypes:image/jpeg,image/jpg, image/png, image/gif',
        	'title' => 'required',
        ]);

        $poster = $request->file('poster');
        $ext = $poster->getClientOriginalExtension();

        $destination = public_path('/posters/');
        
        $filename = str_slug($request->title).'-'.time().'-'.date('Y-m-d').'.'.$ext;
        $url = asset('posters/'.$filename);

        try {
            $poster->move($destination, $filename);
        } catch (\Exception $e) {

            report($e);
            return back()->with('error','Poster failed to upload');
            
        }

        $movie->poster = $url;
        $movie->description = $request->description;
        $movie->title = $request->title;

        if ($movie->save()) {
           
            return back()->with('success', 'Edited');
        }
            return back()->with('error', 'failed to upload');
    }
    public function videos()
    {
    	$genres = Genre::all();
    	$videos = Movie::all();

    	return view('admin.videos', compact('genres', 'videos'));
    }

    public function addGenre(Request $request)
    {
    	$genre = new Genre();
    	$genre->name = $request->name;
    	$genre->save();

    	return back()->with('success', 'Added');
    }

    public function genres(Request $request)
    {
    	$genres = Genre::all();

    	return view('admin.genres', compact('genres'));
    }

    public function deleteMovie(Movie $movie, Request $request)
    {	
    	
    	$file = explode(url('/'), $movie->url);

    	$file_path= public_path($file[1]);

    	if ($file_path) {

    		try {
    			unlink($file_path);
    		} catch (\Exception $e) {

    			return back()->with('error', $e->getMessage());
    			
    		}
    	}

    	if ($movie->poster){

    		$poster_path = public_path(explode(url('/'), $movie->poster)[1]);

    		try {
    			unlink($poster_path);
    		} catch (\Exception $e) {

    			return back()->with('error', $e->getMessage());
    		}
    	}

    	if ($movie->delete()) {

    		return back()->with('success', 'Deleted');
    	}

    	return back()->with('error', 'Failed to delete');
    }
}
