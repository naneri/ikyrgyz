@extends('misc.layout')
@section('content')

<div class="container">
    <div class="col-md-4">
        {{HTML::link('profile/edit/main', 'Основная')}}
        {{HTML::link('profile/edit/study', 'Образование')}}
        {{HTML::link('profile/edit/job', 'Работа')}}
        {{HTML::link('profile/edit/contact', 'Контакты')}}
        {{HTML::link('profile/edit/family', 'Семья')}}
        {{HTML::link('profile/edit/additional', 'Дополнительно')}}
    </div>
	<div class="col-md-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Образование</h3>
                </div>
                <div class="panel-body">
                    
                        <fieldset>
                            Средняя школа
                            <div class="form-group" id="school">
                                <div id="school_items" class="items">
                                    @include('profile.edit.build.schools', array('schools' => Auth::user()->schools))
                                </div>
                                <div class="form" style="display: none;">
                                    {{Form::open(array('url' => 'profile/edit/study/school', 'id' => 'add_school'))}}
                                        Школа:<br>
                                        {{Form::text('school_name')}}<br>
                                        Годы обучения:<br>
                                        с {{Form::text('year_begin')}}
                                        по {{Form::text('year_end')}}<br>
                                        {{Form::select('school_access', $access)}}<br>
                                        {{Form::reset('Очистить')}}
                                        <a href="#" onclick="school.save()">Сохранить</a>
                                    {{Form::close()}}
                                </div>
                                <a onclick="school.addForm()" style="cursor: pointer;">Добавить школу</a>
                            </div>
                            <br>
                            <br>
                            ВУЗ:
                            <div class="form-group" id="university">
                                <div id="university_items" class="items">
                                    @include('profile.edit.build.universities', array('universities' => Auth::user()->universities))
                                </div>
                                <div class="form" style="display: none;">
                                    {{Form::open(array('url' => 'profile/edit/study/university', 'id' => 'add_university'))}}
                                    ВУЗ:<br>
                                    {{Form::text('university_name')}}<br>
                                    Годы обучения:<br>
                                    с {{Form::text('year_begin')}}
                                    по {{Form::text('year_end')}}<br>
                                    Специальность:<br>
                                    {{Form::text('speciality')}}<br>
                                    Примечания:<br>
                                    {{Form::textarea('description')}}<br>
                                    {{Form::select('university_access', $access)}}<br>
                                    {{Form::reset('Очистить')}}
                                    <a href="#" onclick="university.save()">Сохранить</a>
                                    {{Form::close()}}
                                </div>
                                <a onclick="university.addForm()" style="cursor: pointer;">Добавить университет</a>
                            </div>
                            {{Form::submit('Go!')}}
                        </fieldset>
                    {{Form::close()}}
                </div>
            </div>
	</div>
	<div class="col-md-4"></div>

</div>
@stop

@section('scripts')
<script>
    var school = {
        save: function(){
            var $form = $('#school form');
            var data = $form.serialize();
            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: data,
                success: function(result){
                    if(!result.errors){
                        $('#school .items').html(result);
                    }
                },
                error: function(){
                    alert('error');
                }
            });
        },
        edit: function(schoolId){
            var $school = $('#school_'+schoolId);
            var $form = $('#school form');
            $form.find('input[name="school_name"]').val($school.find('.school-name').text());
            $form.find('input[name="year_begin"]').val($school.find('.year-begin').text());
            $form.find('input[name="year_end"]').val($school.find('.year-end').text());
            var $schoolAccess = $school.find('select option:selected');
            $form.find('select option').each(function(){
                if($(this).val() == $schoolAccess.val()){
                    $(this).prop('selected', true);
                }
            });
            $form.append('<input type="hidden" name="school_id" value="'+schoolId+'">');
            school.showForm();
        },
        showForm: function(){
            $('#school .form').show();
        },
        addForm:function(){
            var $form = $('#school .form');
            $form.find('input[type="reset"]').click();
            $form.find('input[name="school_id"]').remove();
            $form.show();
        }
    };
    var university = {
        save: function(){
            var $item = $('#university');
            var $form = $('#university form');
            var data = $form.serialize();
            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: data,
                success: function(result){
                    if(!result.errors){
                        $('#university .items').html(result);
                    }
                },
                error: function(){
                    alert('error');
                }
            });
        },
        edit: function(universityId){
            var $school = $('#university_'+universityId)
            var $form = $('#university form');
            $form.find('input[name="university_name"]').val($school.find('.university-name').text());
            $form.find('input[name="year_begin"]').val($school.find('.year-begin').text());
            $form.find('input[name="year_end"]').val($school.find('.year-end').text());
            $form.find('input[name="speciality"]').val($school.find('.speciality').text());
            $form.find('textarea[name="description"]').val($school.find('.description').text());
            var $univerAccess = $school.find('select option:selected');
            $form.find('select option').each(function(){
                if($(this).val() == $univerAccess.val()){
                    $(this).prop('selected', true);
                }
            });
            $form.append('<input type="hidden" name="university_id" value="'+universityId+'">');
            university.showForm();
        },
        showForm: function(){
            $('#university .form').show();
        },
        addForm:function(){
            var $form = $('#university .form');
            $form.find('input[type="reset"]').click();
            $form.find('input[name="university_id"]').remove();
            $form.show();
        }
    };
</script>
@stop