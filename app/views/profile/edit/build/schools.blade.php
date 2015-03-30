@foreach($schools as $school)
<div id="school_{{$school->id}}">
    <h3 style="font-weight: bold;"><span class="school-name">{{$school->value}}</span></h3> 
    с <span class="year-begin">{{strtok($school->date_begin,'-')}}</span> по <span class="year-end">{{strtok($school->date_end,'-')}}</span><br>
    {{ trans('network.available') }}: {{$access[$school->access]}}<br>
    {{Form::hidden('access', $school->access)}}
    <a onclick="school.edit({{$school->id}})">{{ trans('network.edit') }}</a><br><br>
</div>
@endforeach