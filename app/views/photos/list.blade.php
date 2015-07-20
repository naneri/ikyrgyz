@foreach($photos as $photo)
<div class="list-group-item" style="width:210px;height:210px;float:left;margin:5px;background:url({{$photo->url}}) 50%;background-size: cover;border: 2px solid white;">
    @if(isset($canEdit) && $canEdit)
        <input type="checkbox" name="photo[]" value="{{$photo->id}}">
    @endif
    <a href="{{URL::to('photo/'.$photo->id)}}">
        <div style="height: 50px;  position: absolute;  bottom: 0;  background-color: #bbb;  width: 100%;  left: 0;  padding: 10px;  opacity: 0.8;">
            {{$photo->name}}
        </div>
    </a>
</div>
<img src="{{$photo->url}}" style="display: none;"  data-pb-captionlink="{{$photo->name}}[{{URL::to('photos/'.$photo->id)}}]" id="photo_{{$photo->id}}" data-photo-id="{{$photo->id}}" data-can-edit="{{$photo->canEdit()}}" data-rating="{{$photo->rating}}">
@endforeach