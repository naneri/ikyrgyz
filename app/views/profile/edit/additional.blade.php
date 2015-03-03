@extends('misc.layout')
@extends('profile.edit.layout')
@section('form')
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Дополнительно о вас</h3>
        </div>
        <div class="panel-body">
                <fieldset>
                    Увлечения:
                    <div class="form-group" id="passion">
                        <div class="items">
                            @include('profile.edit.build.additional', array('additionals' => Auth::user()->additionals()->where('subtype', 'passion')->get()))
                        </div>
                        <div class="form" style="display: none;">
                            {{Form::open(array('url' => 'profile/edit/additional'))}}
                                Увлечение:
                                {{Form::text('value')}}<br>
                                {{Form::select('additional_access', $access)}}<br>
                                {{Form::hidden('additional_type', 'passion')}}
                                {{Form::reset('Очистить')}}
                                <a href="#" onclick="additional.savePassion()">Сохранить</a>
                            {{Form::close()}}
                        </div>
                        <a onclick="additional.addFormPassion()" style="cursor: pointer;">Добавить увлечение</a>
                    </div>
                    <br>
                    <br>
                    Обо мне:
                    <div class='form-group' id='about_me'>
                        {{Form::open(array('url' => 'profile/edit/aboutMe'))}}
                            {{Form::textarea('about_me', $user['description']->about_me)}}<br>
                            <a href="#" onclick="additional.saveAboutMe()">Сохранить</a>
                        {{Form::close()}}
                    </div>
                    <br>
                    <br>
                    Другие имена, прозвища:
                    <div class="form-group" id="nickname">
                        <div class="items">
                            @include('profile.edit.build.additional', array('additionals' => Auth::user()->additionals()->where('subtype', 'nickname')->get()))
                        </div>
                        <div class="form" style="display: none;">
                            {{Form::open(array('url' => 'profile/edit/additional'))}}
                                Другие имена, прозвища:
                                {{Form::text('value')}}<br>
                                {{Form::select('additional_access', $access)}}<br>
                                {{Form::hidden('additional_type', 'nickname')}}
                                {{Form::reset('Очистить')}}
                                <a href="#" onclick="additional.saveNickname()">Сохранить</a>
                            {{Form::close()}}
                        </div>
                        <a onclick="additional.addFormNickname()" style="cursor: pointer;">Добавить увлечение</a>
                    </div>
                </fieldset>
        </div>
    </div>
@stop

@section('scripts')
<script>
    var additional = {
        saveNickname: function(){
            var $form = $('#nickname form');
            var data = $form.serialize();
            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: data,
                success: function(result){
                    if(!result.errors){
                        $('#nickname .items').html(result);
                    }
                },
                error: function(){
                    alert('error');
                }
            });
        },
        savePassion: function(){
            var $form = $('#passion form');
            var data = $form.serialize();
            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: data,
                success: function(result){
                    if(!result.errors){
                        $('#passion .items').html(result);
                    }
                },
                error: function(){
                    alert('error');
                }
            });
        },
        saveAboutMe: function(){
            var $form = $('#about_me form');
            var data = $form.serialize();
            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: data,
                success: function(result){
                    if(!result.errors){
                        alert('success');
                    }
                },
                error: function(){
                    alert('error');
                }
            });
        },
        edit: function(additionalType, additionalId){
            var $member = $('#additional_'+additionalId);
            var $form = $('#'+additionalType+' form');
            $form.find('input[name="value"]').val($member.find('.additional-value').text());
            var $additionalAccess = $member.find('input[name="access"]').val();
            $form.find('select option').each(function(){
                if($(this).val() == $additionalAccess){
                    $(this).prop('selected', true);
                }
            });
            $form.append('<input type="hidden" name="additional_id" value="'+additionalId+'">');
            $('#'+additionalType+' .form').show();
        },
        showForm: function(){
            $('#family .form').show();
        },
        addFormNickname:function(){
            var $form = $('#nickname .form');
            $form.find('input[type="reset"]').click();
            $form.find('input[name="additional_id"]').remove();
            $form.show();
        },
        addFormPassion:function(){
            var $form = $('#passion .form');
            $form.find('input[type="reset"]').click();
            $form.find('input[name="additional_id"]').remove();
            $form.show();
        }
    };
</script>
@stop