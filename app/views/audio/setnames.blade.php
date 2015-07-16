@extends('misc.layout')
@section('content')
{{HTML::style('css/bootstrap.css')}}
<div class="container">
    <div class="col-md-12">
        {{Form::open(array('url' => 'audioalbum/'.$albumId.'/upload/setnames'))}}
            <div class="panel panel-default" style="height: 40px; padding:0 20px;">
                <h4 style="float: left;">
                    Загрузка аудио
                </h4>
                <span style="float: right; margin-top: 6px;">
                    {{Form::submit('Сохранить')}}
                </span>
            </div>
            <div>
                @foreach($audios as $audio)
                    <div class="list-group-item"
                         >
                        <div class="form-group">
                            {{Form::text('audio_names['.$audio->id.']', $audio->name, array('class' => 'form-control'))}}
                        </div>
                    </div>
                @endforeach
            </div>
        {{Form::close()}}
    </div>
</div>
@stop