@extends("{$template}misc.layout")
@section('content')
{{HTML::style('css/bootstrap.css')}}
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        @foreach ($errors->all() as $error)
            <div class="b-message b-message-error">
                <a href="javascript: $('.b-message').remove()" class="b-message-close"></a>
                <div class="b-message-icon b-message-error-icon"></div>
                <p class="b-message-p">
                    {{$error}}
                </p>
            </div>
        @endforeach
        <div class="panel" style="padding:10px;">
            {{Form::open(array('files' => true))}}
            <legend>{{ trans('network.upload-audio') }}</legend>
            <div class="form-group">
                {{ trans('network.hidden') }}
                {{Form::checkbox('is_hidden', 0, false)}}
            </div>
            <div class="form-group">
                {{Form::file('audio_files[]', array('class' => 'form-control', 'multiple' => true, 'accept' => 'audio/mp3'))}}
            </div>
            <div class="form-group">
                {{Form::hidden('audio_album_id', $audioAlbum->id)}}
                {{Form::hidden('is_hidden', 0)}}
                {{Form::submit(trans('network.save'))}}
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
<script>
    $('form input[name="is_hidden"]').change(function(){
        $('form input[name="is_hidden"]').val($('form input[name="is_hidden"]').is(":checked")? '1' : '0');
    });
</script>
@stop