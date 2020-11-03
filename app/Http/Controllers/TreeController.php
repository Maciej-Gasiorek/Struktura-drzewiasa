<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tree;

class TreeController extends Controller
{
    //Display home page
    public function index()
    {
        return view('trees.index',['trees'=>Tree::all()]);
    }

    //Display form for creating root element
    public function create()
    {
        return view('trees.create');
    }

    //Display form for creating children
    public function createChildren($id)
    {
        $tree = Tree::findOrFail($id);
        return view('trees.createChildren',['tree'=>$tree]);
    }

    // Method for create a both kind of elements
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
        ]);

        $name = $request->input('name');
        $id = $request->input('id');

        $tree = new Tree();
        $tree->name = $name;
        $tree->parentID = $id;
        $tree->save();

        $request->session()->flash('status','Element utworzony poprawnie');

        return redirect()->route('trees.index', ['trees' => Tree::all()]);
    }

    // Display form for edit elements
    public function edit($id)
    {
        $tree = Tree::findOrFail($id);
        return view("trees.edit",['tree'=> $tree,'selectTree'=> $this->getChildrenForSelect($id)]);
    }

    //Method for update 
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
        ]);

        $parentID = $request->input('select');
        $name = $request->input('name');
        $treeToUpdate = Tree::find($id);

        if($parentID == 'root'){
            $treeToUpdate->parentID = null;
        } else {
            $treeToUpdate->parentID = $parentID;
        }

        $treeToUpdate->name = $name;
        $treeToUpdate->save();

        $request->session()->flash('status','Poprawna edycja elementu');

        return redirect()->route("trees.index",['trees'=>Tree::all()]);
    }

    //Display deleteForm
    public function deleteForm(Request $request, $id)
    {
        $tree = Tree::findOrFail($id);
        return view("trees.delete",['tree'=> $tree]);
    }

    //Remove tree with children form database
    public function destroy(Request $request,$id)
    {
        $tree = Tree::findOrFail($id);
        $this->deleteChildren($tree);

        $request->session()->flash('status','Poprawnie usunięto');

        return redirect()->route('trees.index', ['trees' => Tree::all()]);
    }

    //Method for deleting children
    private function deleteChildren(Tree $tree){
        $treeChildren = $tree->children()->get();

        if(count($treeChildren)>0){
            foreach( $treeChildren as $t){
                $this->deleteChildren($t);
            }
        }
        $tree->delete();
    }

    //Method for displaying possible parents , when editing an item
    //This method prevent from select element children
    private function getChildrenForSelect($id){
        $list = $this->deleteChildrenFromLIst(Tree::all(),Tree::find($id));

        return $list->filter(function($item) use (&$id){
            return $item->id !=$id;
        });
    }

    //Recursive deleting children from list
    private function deleteChildrenFromLIst($treeList,$tree){
        $treeChildren = $tree->children()->get();

        foreach($treeChildren as $child){

            if(count($treeChildren)> 0 && $child->id!=$tree->id){
                $treeList = $this->deleteChildrenFromLIst($treeList,$child);
            }
            
            $treeList = $treeList->filter(function($el) use (&$child){
                return $el->id!=$child->id;
            });

        }
        
        return $treeList;
    }

}
