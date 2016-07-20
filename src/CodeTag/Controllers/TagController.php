<?php

namespace CodePress\CodeTag\Controllers;

use CodePress\CodeTag\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;

class TagController extends Controller {

    private $response;
    private $tag;

    public function __construct(Tag $tag, ResponseFactory $response) {
        $this->response = $response;
        $this->tag = $tag;
    }

    public function index() {
      $tags = Tag::all();
      return $this->response->view('codetag::index', compact('tags'));
    }

    public function create() {
        $tags = Tag::all();
        return view('codetag::create', compact('tags'));
    }

    public function store(Request $request) {
        Tag::create($request->all());
        return redirect()->route('admin.tags.index');
    }

}
