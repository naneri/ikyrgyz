@foreach($jobs as $job)
<div id="job_{{$job->id}}">
    <h3 style="font-weight: bold;"><span class="company-name">{{$job->value}}</span></h3> 
    с <span class="year-begin">{{strtok($job->date_begin,'-')}}</span> 
    по <span class="year-end">{{strtok($job->date_end,'-')}}</span><br>
    {{ trans('network.available') }}: {{$access[$job->access]}}<br>
    {{Form::hidden('access', $job->access)}}
    {{ trans('network.specialization') }}: <span class="job-title">{{$job->meta_1}}</span><br>
    {{ trans('network.notes') }}: <span class="description">{{$job->description}}</span><br>
    <a onclick="job.edit({{$job->id}})">{{ trans('network.edit') }}</a><br><br>
</div>
@endforeach