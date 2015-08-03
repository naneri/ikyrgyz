@extends('misc.layout')
@section('content')
{{HTML::style('css/bootstrap.css')}}
<div class="container">
    <div class="col-md-12">
        <div class="panel panel-default" style="height: 40px; padding:0 20px;">
            <h4 style="float: left;">
                <a href="{{URL::to('profile/'.$photo->album->user->id)}}">{{$photo->album->user->getNames()}}</a> →
                <a href="{{URL::to('profile/'.$photo->album->user->id.'/photos')}}">Фотоальбомы</a> →
                <a href="{{URL::to('photoalbum/'.$photo->album->id)}}">{{$photo->album->name}}</a> →
                {{$photo->name}}
            </h4>
            @if($photo->canEdit())
            <span style="float: right;line-height: 38px;">
                <a href="{{URL::to('photo/'.$photo->id.'/delete')}}">Удалить</a> |
                <a href="{{URL::to('photo/'.$photo->id.'/edit')}}">Изменить</a>
            </span>
            @endif
        </div>
        <div>
            <div class="panel panel-default" style="height: 40px; padding:0 20px;">
                <h5><b>Название:</b> {{$photo->name}}</h5>
            </div>
            {{HTML::image($photo->url, null, array('style' => 'max-width:1110px;'))}}
        </div>
        <br>
        <br>
        <br>
        <div class="b-profile-about-profile__name" style="height: 20px;">
            <div style="float:left;">Комментарии {{$photo->comments->count()}}</div>
            <div style="float:right;">Сортировка: {{Form::select('sort_by', array('old' => 'Старые', 'new' => 'Новые', 'rating' => 'По рейтингу'))}}</div>
        </div>
        <hr>
        <div style="padding: 20px 0; font-size: 18px;">
            <a href="javascript:;" onclick="comment.postCommentForm()">Оставить комментарий</a>
        </div>
        <div class="post-comment" style="display: none;">
            <div style="height:50px;">
                {{HTML::image(Auth::user()->avatar(), '', array('style' => 'float:left;width:40px;height:40px;margin-right:10px;'))}}
                <span style="line-height: 40px;" class="b-profile-about-profile__name"> {{Auth::user()->getNames()}}</span>
            </div>
            <div id="add_comment_0">
                {{Form::textarea('comment', null, array('class' => 'add_comment_text'))}}
                <div class="b-profile-about-message-button">
                    <input type="button" value="Опубликовать" class="button-default button-submit" onclick="comment.submit(0,{{$photo->id}});">
                </div>
            </div>
        </div>
        <div id="comments_child_0">
            @include('comments.build', array('comments' => $comments, 'parent' => null, 'sort' => 'old'))
        </div>
        @include('comments.scripts', array('commentType' => 'photo'))
    </div>
</div>
@stop