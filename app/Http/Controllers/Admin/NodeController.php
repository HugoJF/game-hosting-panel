<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Node;

class NodeController extends Controller
{
    public function index()
    {
        $nodes = Node::query()->paginate(5);

        return view('admins.nodes.index', compact('nodes'));
    }

    public function show(Node $node)
    {
        return view('admins.nodes.show', compact('node'));
    }
}
