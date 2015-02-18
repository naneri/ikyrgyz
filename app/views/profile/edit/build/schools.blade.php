@foreach($schools as $school)
<div id="school_{{$school->id}}">
    <h3 style="font-weight: bold;"><span class="school-name">{{$school->name}}</span></h3> 
    с <span class="year-begin">{{strtok($school->date_begin,'-')}}</span> по <span class="year-end">{{strtok($school->date_end,'-')}}</span><br>
    {{Form::select('access_school_'.$school->id, $access, $school->access)}}<br>
    <a onclick="school.edit({{$school->id}})">Редактировать</a><br><br>
</div>
@endforeach