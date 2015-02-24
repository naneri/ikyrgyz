@extends('misc.layout')
@extends('profile.edit.layout')
@section('form')
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Работа</h3>
        </div>
        <div class="panel-body">

                <fieldset>
                    Места работы:
                    <div class="form-group" id="job">
                        <div id="job_items" class="items">
                            @include('profile.edit.build.jobs', array('jobs' => Auth::user()->jobs))
                        </div>
                        <div class="form" style="display: none;">
                            {{Form::open(array('url' => 'profile/edit/job'))}}
                                Компания:<br>
                                {{Form::text('company_name')}}<br>
                                Должность:<br>
                                {{Form::text('job_title')}}<br>
                                Примечания:<br>
                                {{Form::textarea('description')}}<br>
                                с {{Form::text('year_begin')}}
                                по {{Form::text('year_end')}}<br>
                                {{Form::select('job_access', $access)}}<br>
                                {{Form::reset('Очистить')}}
                                <a href="#" onclick="job.save()">Сохранить</a>
                            {{Form::close()}}
                        </div>
                        <a onclick="job.addForm()" style="cursor: pointer;">Добавить место работы</a>
                    </div>
                </fieldset>
        </div>
    </div>
@stop

@section('scripts')
<script>
    var job = {
        save: function(){
            var $form = $('#job form');
            var data = $form.serialize();
            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: data,
                success: function(result){
                    if(!result.errors){
                        $('#job .items').html(result);
                    }
                },
                error: function(){
                    alert('error');
                }
            });
        },
        edit: function(jobId){
            var $job = $('#job_'+jobId);
            var $form = $('#job form');
            $form.find('input[name="company_name"]').val($job.find('.company-name').text());
            $form.find('input[name="year_begin"]').val($job.find('.year-begin').text());
            $form.find('input[name="year_end"]').val($job.find('.year-end').text());
            $form.find('input[name="job_title"]').val($job.find('.job-title').text());
            $form.find('textarea[name="description"]').val($job.find('.description').text());
            var $jobAccess = $job.find('input[name="access"]').val();
            $form.find('select option').each(function(){
                if($(this).val() == $jobAccess){
                    $(this).prop('selected', true);
                }
            });
            $form.append('<input type="hidden" name="job_id" value="'+jobId+'">');
            job.showForm();
        },
        showForm: function(){
            $('#job .form').show();
        },
        addForm:function(){
            var $form = $('#job .form');
            $form.find('input[type="reset"]').click();
            $form.find('input[name="job_id"]').remove();
            $form.show();
        }
    };
</script>
@stop