@php
   $treeChildren = $tree->children()->get();

   $children = $tree->children()->get()->toArray();
   $filteredChildren = array_filter($children,function($element){
       return $element['parentID']!=null;
   }); 

   if($sortOption==ALL_ASC || $sortOption==CHILDREN_ASC){
        $treeChildren = $treeChildren->sortBy('name');
   }else if($sortOption==ALL_DESC || $sortOption==CHILDREN_DESC){
    $treeChildren = $treeChildren->sortByDesc('name');
   }

@endphp

@if(count($filteredChildren) > 0)
    @include('trees.elements.element',['id'=>$tree->id,'name'=>$tree->name,'haveChildren'=>true])
    @foreach ($treeChildren as $tc)
        @if($tc->parentID !=null)
            <div class="nested" id="{{ $tree->id }}">
                @include('trees.elements.showTrees',['tree'=> $tc])
            </div>
        @endif
    @endforeach
@else 
    @include('trees.elements.element',['id'=>$tree->id,'name'=>$tree->name,'haveChildren'=>false])
@endif
