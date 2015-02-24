@extends('misc.layout')
@extends('profile.edit.layout')
@section('form')
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Семья</h3>
        </div>
        <div class="panel-body">

                <fieldset>
                    Члены моей семьи:
                    <div class="form-group" id="family">
                        <div id="family_items" class="items">
                            @include('profile.edit.build.family', array('members' => Auth::user()->familyMembers))
                        </div>
                        <div class="form" style="display: none;">
                            {{Form::open(array('url' => 'profile/edit/family/members'))}}
                                Имя:
                                {{Form::text('family_member_name')}}<br>
                                Член семьи:
                                {{Form::select('family_member_relative', $relatives)}}<br>
                                {{Form::select('family_member_access', $access)}}<br>
                                {{Form::reset('Очистить')}}
                                <a href="#" onclick="family.saveMember()">Сохранить</a>
                            {{Form::close()}}
                        </div>
                        <a onclick="family.addForm()" style="cursor: pointer;">Добавить члена семьи</a>
                    </div>
                    <br>
                    <br>
                    <div class="form-group" id="marital_status">
                        {{Form::open(array('url' => 'profile/edit/maritalStatus'))}}
                            Семейное положение:
                            {{Form::select('marital_status', $maritalStatuses, $user['description']->marital_status)}}<br>
                            <a href="#" onclick="family.saveMaritalStatus()">Сохранить</a>
                        {{Form::close()}}
                    </div>
                </fieldset>
        </div>
    </div>
@stop

@section('scripts')
<script>
    var family = {
        saveMember: function(){
            var $form = $('#family form');
            var data = $form.serialize();
            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: data,
                success: function(result){
                    if(!result.errors){
                        $('#family .items').html(result);
                    }
                },
                error: function(){
                    alert('error');
                }
            });
        },
        saveMaritalStatus: function(){
            var $form = $('#marital_status form');
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
        edit: function(memberId){
            var $member = $('#member_'+memberId);
            var $form = $('#family form');
            $form.find('input[name="family_member_name"]').val($member.find('.member-name').text());
            var $memberAccess = $member.find('input[name="access"]').val();
            var $memberRelative = $member.find('input[name="relative"]').val();
            $form.find('select option').each(function(){
                if($(this).val() == $memberAccess){
                    $(this).prop('selected', true);
                }
                if($(this).val() == $memberRelative){
                    $(this).prop('selected', true);
                }
            });
            $form.append('<input type="hidden" name="member_id" value="'+memberId+'">');
            family.showForm();
        },
        showForm: function(){
            $('#family .form').show();
        },
        addForm:function(){
            var $form = $('#family .form');
            $form.find('input[type="reset"]').click();
            $form.find('input[name="member_id"]').remove();
            $form.show();
        }
    };
</script>
@stop