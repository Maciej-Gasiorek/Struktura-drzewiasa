<div  class="element" id={{$id}} onclick="toggleChildren(event)">
    @if ($haveChildren)
        <i class="fas fa-angle-down"></i>
    @else
        <i class="fas fa-asterisk"></i>
    @endif
    <span>{{$name}}</span>
    <div class="element__divider"></div>
    <div class="element__icons">
        <a href="{{route("trees.createChildren",['id'=>$id])}}">
            <i class="far fa-plus-square"></i>
        </a>
        <a href="{{route("trees.edit",['tree'=>$id])}}">
            <i class="fas fa-exchange-alt"></i>
        </a>
         <a href={{route("trees.deleteForm",['id'=>$id])}}>
            <i class="fas fa-skull-crossbones"></i>
        </a>
    </div>
</div>

