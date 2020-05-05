<?php

namespace App\Http\Controllers\Admin;

use App\Forms\NodeForm;
use App\Http\Controllers\Controller;
use App\Node;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class NodeController extends Controller
{
    public function index()
    {
        $nodes = Node::query()->paginate(5);

        return view('admins.nodes.index', compact('nodes'));
    }

    public function edit(FormBuilder $builder, Node $node)
    {
        $form = $builder->create(NodeForm::class, [
            'method' => 'PATCH',
            'url'    => route('admins.nodes.update', $node),
            'model'  => $node,
        ]);

        return view('form', [
            'title'       => 'Update node',
            'form'        => $form,
            'submit_text' => 'Update',
        ]);
    }

    public function update(Request $request, Node $node)
    {
        $node->fill($request->all());
        $node->save();

        flash()->success('Node updated!');

        return redirect()->route('admins.dashboard');
    }

    public function show(Node $node)
    {
        return view('admins.nodes.show', compact('node'));
    }
}
