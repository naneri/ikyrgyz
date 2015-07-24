@extends('misc.layout')
@section('content')
    {{HTML::style('css/bootstrap.css')}}
    {{HTML::script('js/bootstrap.js')}}
    <div class="container">
        <div id="modal-container-ac"></div>
        <div class="col-md-12">
            <div class="panel panel-default" style="height: 40px; padding:0 20px;">
                <h4 style="float: left;">
                    <a href="{{URL::to('profile/'.$audioAlbum->user->id)}}">{{$audioAlbum->user->getNames()}}</a> →
                    <a href="{{URL::to('profile/'.$audioAlbum->user->id.'/audios')}}">Аудиоальбомы</a> →
                    {{$audioAlbum->name}}
                </h4>
                @if($audioAlbum->canEdit())
                    <span style="float: right;line-height: 38px;">
                    <a href="{{URL::to('audioalbum/'.$audioAlbum->id.'/delete')}}">Удалить аудиоальбом</a> |
                    <a href="{{URL::to('audioalbum/'.$audioAlbum->id.'/edit')}}">Изменить аудиоальбом</a> |
                    <a href="{{URL::to('audioalbum/'.$audioAlbum->id.'/upload')}}">Загрузить аудио</a>
                </span>
                @endif
            </div>
            <div style="width: 89%; float: left;">
                @if($audioAlbum->canView())
                    @if($audioAlbum->description)
                        <div class="panel panel-default" style="height: 40px; padding:0 20px;">
                            <h5><b>Описание:</b> {{$audioAlbum->description}}</h5>
                        </div>
                    @endif
                    <div class="panel-default">
                        <audio id="audio-player"></audio>
                    </div>
                    <br/>
                    @if(Auth::id() == $audioAlbum->user_id)
                        @foreach($audioAlbum->audios as $audio)
                            <div style="margin-top: 3px; @if($audio->is_hidden) opacity: 0.5; @endif">
                                <span>
                                    <a class="audio-element" href="{{$audio->url}}">{{$audio->name}}</a> <a class="move-to-album" data-id="{{$audio->id}}" href="#" style="color: red" onclick="return false;">(m)</a> <a class="copy-to-album" data-id="{{$audio->id}}" href="#" style="color: green;" onclick="return false;">(c)</a>
                                </span>
                                <span class="b-user-wall-footer__btn rating" style="float: right; margin: 0">
                                    <input type="submit" onclick="return vote.audio({{$audio->id}},-1);" class="btn btn-minus">
                                    <input type="submit" onclick="return vote.audio({{$audio->id}},1);" class="btn btn-plus">
                                    <span class="likes" style="line-height: 0; min-width: 20px; display: inline-block;"
                                          id="rating_audio_{{$audio->id}}">{{$audio->rating}}</span>
                                    @if($audio->canEdit())
                                        <a onclick="return confirm('Удалить {{htmlentities($audio->name)}}?') " href="{{URL::to('audio/'.$audio->id.'/delete')}}">Удалить</a> |
                                        <a href="{{URL::to('audio/'.$audio->id.'/edit')}}">Изменить</a>
                                    @endif
                                </span>
                            </div>
                            <div class="clear"></div>
                        @endforeach
                    @else
                        @foreach($audioAlbum->audios as $audio)
                            @if(!$audio->is_hidden)
                                <div style="margin-top: 3px;">
                                    <span>
                                        <a class="audio-element" href="{{$audio->url}}">{{$audio->name}}</a> <a class="copy-to-album" data-id="{{$audio->id}}" href="#" style="color: green;">(c)</a>
                                    </span>
                                    <span class="b-user-wall-footer__btn rating" style="float: right; margin: 0">
                                        <input type="submit" onclick="return vote.audio({{$audio->id}},-1);"
                                               class="btn btn-minus">
                                        <input type="submit" onclick="return vote.audio({{$audio->id}},1);"
                                               class="btn btn-plus">
                                        <span class="likes"
                                              style="line-height: 0; min-width: 20px; display: inline-block;"
                                              id="rating_audio_{{$audio->id}}">{{$audio->rating}}</span>
                                        @if($audio->canEdit())
                                            <a href="{{URL::to('audio/'.$audio->id.'/delete')}}">Удалить</a> |
                                            <a href="{{URL::to('audio/'.$audio->id.'/edit')}}">Изменить</a>
                                        @endif
                                    </span>
                                </div>
                                <div class="clear"></div>
                            @endif
                        @endforeach
                    @endif
                    @if(isset($base_config))
                        {{HTML::script('js/notify.js')}}
                    @endif
                    <script type="text/javascript">
                        $(document).ready(function () {
                            MediaElementPlayer.prototype.buildloop = function (player, controls, layers, media) {
                                var loop =
                                        $('<div class="mejs-button mejs-loop-button ' + ((player.options.loop) ? 'mejs-loop-on' : 'mejs-loop-off') + '">' +
                                        '<button type="button" title="Повтор" aria-label="Повтор"></button>' +
                                        '</div>')
                                                .appendTo(controls)
                                                .click(function () {
                                                    player.options.loop = !player.options.loop;
                                                    if (player.options.loop) {
                                                        loop.removeClass('mejs-loop-off').addClass('mejs-loop-on');
                                                    } else {
                                                        loop.removeClass('mejs-loop-on').addClass('mejs-loop-off');
                                                    }
                                                });
                                var prev_button = $('<div class="mejs-button mejs-previous-button">' +
                                '<button type="button" title="Предыдущий" aria-label="Предыдущий"></button>' +
                                '</div>')
                                        .appendTo(controls)
                                        .click(function () {
                                            for (var index = $('.audio-element').length - 1; index > 0; index--) {
                                                if (index > 0 && media.src == $($('.audio-element')[index]).attr('href')) {
                                                    playSrc(
                                                            $($('.audio-element')[index - 1]).attr('href'),
                                                            $($('.audio-element')[index - 1]).text()
                                                    );
                                                    break;
                                                }
                                            }
                                        });
                                var next_button = $('<div class="mejs-button mejs-next-button">' +
                                '<button type="button" title="Следующий" aria-label="Следующий"></button>' +
                                '</div>')
                                        .appendTo(controls)
                                        .click(function () {
                                            for (var index = 0; index < $('.audio-element').length; index++) {
                                                if (index < $('.audio-element').length - 1 && media.src == $($('.audio-element')[index]).attr('href')) {
                                                    playSrc(
                                                            $($('.audio-element')[index + 1]).attr('href'),
                                                            $($('.audio-element')[index + 1]).text()
                                                    );
                                                    break;
                                                }
                                            }
                                        });
                            };

                            var audio = $('#audio-player');
                            var audioPlayer;
                            if ($('.audio-element').length > 0) {
                                initPlayer(audio);
                            }

                            $('.audio-element').on('click', function (e) {
                                e.preventDefault();
                                playSrc($(this).attr('href'), $(this).text());
                            });

                            $('.move-to-album').on('click', function () {
                                var $audioId = $(this).attr('data-id'),
                                    $this = $(this);
                                $.get("{{asset('/audio/moveToAlbum')}}/"+$audioId, function (result) {
                                    if(result.error) {
                                        $.notify(result.error, 'error');
                                    } else {
                                        $('#modal-container-ac').html(result.html);
                                        $('#chooseAlbum').modal('show');

                                        $('#chooseAlbumBtn').click(function(){
                                            $('#chooseAlbum').modal('hide');
                                            var $albumId = $('select[name="chooseAlbum"]').val();
                                            $.post("{{asset('/audio/moveToAlbum')}}/"+$audioId+"/"+$albumId, {}, function (result) {
                                                if(result.error) {
                                                    $.notify(result.error, 'error');
                                                } else if (result.success) {
                                                    $this.parent().parent().remove();
                                                    if ($('.audio-element').length > 0) {
                                                        playSrc($('.audio-element:first').attr('href'), $('.audio-element:first').text());
                                                    } else {
                                                        window.location.reload(true);
                                                    }
                                                    $.notify(result.success, 'success');
                                                }
                                            }, 'json');
                                        });
                                    }
                                }, 'json');
                            });

                            $('.copy-to-album').on('click', function () {
                                var $audioId = $(this).attr('data-id');
                                $.get("{{asset('/audio/copyToAlbum')}}/"+$audioId, function (result) {
                                    if(result.error) {
                                        $.notify(result.error, 'error');
                                    } else {
                                        $('#modal-container-ac').html(result.html);
                                        $('#chooseAlbum').modal('show');

                                        $('#chooseAlbumBtn').click(function(){
                                            $('#chooseAlbum').modal('hide');
                                            var $albumId = $('select[name="chooseAlbum"]').val();
                                            $.post("{{asset('/audio/copyToAlbum')}}/"+$audioId+"/"+$albumId, {}, function (result) {
                                                if(result.error) {
                                                    $.notify(result.error, 'error');
                                                } else if (result.success) {
                                                    $.notify(result.success, 'success');
                                                }
                                            }, 'json');
                                        });
                                    }
                                }, 'json');
                            });

                            function playSrc(src, title) {
                                $('.mejs-offscreen').text(title);
                                audioPlayer.pause();
                                audioPlayer.setSrc(src);
                                audioPlayer.play();
                            }

                            function initPlayer(element) {
                                var playerWidth = 400;
                                if($(window).width() >= 1000) {
                                    playerWidth = 700;
                                } else if($(window).width() >= 650) {
                                    playerWidth = 600;
                                }
                                element.attr('src', $('.audio-element:first').attr('href'));
                                element.mediaelementplayer({
                                    alwaysShowControls: true,
                                    features: ['playpause', 'loop', 'current', 'progress', 'duration', 'volume'],
                                    audioVolume: 'vertical',
                                    audioWidth: playerWidth,
                                    success: function (media, node, player) {
                                        audioPlayer = media;
                                        $('.mejs-offscreen').css('width', playerWidth+'px');
                                        media.addEventListener('ended', function () {
                                            if (!player.options.loop) {
                                                for (var index = 0; index < $('.audio-element').length; index++) {
                                                    if (index < $('.audio-element').length - 1 && audioPlayer.src == $($('.audio-element')[index]).attr('href')) {
                                                        playSrc(
                                                                $($('.audio-element')[index + 1]).attr('href'),
                                                                $($('.audio-element')[index + 1]).text()
                                                        );
                                                        break;
                                                    }
                                                }
                                            }
                                        }, false);
                                    }
                                });
                                playSrc($('.audio-element:first').attr('href'), $('.audio-element:first').text());
                            }
                        })
                    </script>
                    <div class="gamma-overlay"></div>
                @else
                    <div class="panel panel-default" style="height: 40px; padding:0 20px;">
                        <h5 style="">
                            Аудио альбом не доступен для просмотра
                        </h5>
                    </div>
                @endif
            </div>
            <div class="panel panel-default" style="width: 10%; float: right;; text-align: center">
                <b>Список альбомов</b>
                <br/>
                @foreach($audioAlbums as $aa)
                    <a href="{{URL::to('audioalbum/'.$aa->id)}}">{{$aa->name}}</a> <br/>
                @endforeach
            </div>
        </div>
    </div>
@stop