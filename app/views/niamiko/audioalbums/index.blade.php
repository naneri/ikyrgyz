@extends("{$template}misc.layout")
@section('content')
{{HTML::style('css/bootstrap.css')}}
<div class="container">
    <div class="col-md-12">
        <div class="panel panel-default" style="height: 40px; padding:0 20px;">
            <h4 style="float: left;"><a href="{{URL::to('profile/'.$user->id)}}">{{$user->getNames()}}</a> → Аудиоальбомы</h4>
            @if(Auth::id() == $user->id)
                <span style="float: right;line-height: 38px;"><a href="{{URL::to('audioalbum/create')}}">{{ trans('network.create') }} аудиоальбом</a></span>
            @endif
        </div>
        <div>
            @foreach($audioAlbums as $audioAlbum)
                <div style="float: left;">
                    @if($audioAlbum->canView())
                        <div class="b-user-wall-footer__btn rating" style="margin-left: 7px;padding: 3px; background: rgba(255,255,255, 0.6); z-index: 2; position:absolute;">
                            <input type="submit" onclick="return vote.audioalbum({{$audioAlbum->id}},-1);" class="btn btn-minus">
                            <input type="submit" onclick="return vote.audioalbum({{$audioAlbum->id}},1);" class="btn btn-plus">
                            {{--{{var_dump($audio)}}--}}
                            <span class="likes" style="line-height: 0" id="rating_audioalbum_{{$audioAlbum->id}}">{{$audioAlbum->rating}}</span>
                        </div>
                    @endif
                    <a href="{{URL::to('audioalbum/'.$audioAlbum->id)}}">
                        <div class="list-group-item" style="width:210px;height:210px;margin:5px;background:url({{$audioAlbum->cover}});background-size: cover;border: 2px solid white;">
                            <div style="height: 50px;  position: absolute;  bottom: 0;  background-color: #bbb;  width: 100%;  left: 0;  padding: 5px;  opacity: 0.8;">
                                {{$audioAlbum->name}}<br>
                                @if(!$audioAlbum->canView())
                                    {{HTML::image('img/lock.png', null, array('style' => 'width: 20px; height:20px;'))}}
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@stop