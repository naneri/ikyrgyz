@foreach($universities as $university)
    <div id="university_{{$university->id}}">
        <h3 style="font-weight: bold;"><span class="university-name">{{$university->value}}</span></h3> 
        с <span class="year-begin">{{strtok($university->date_begin,'-')}}</span> 
        по <span class="year-end">{{strtok($university->date_end,'-')}}</span><br>
        {{ trans('network.available') }}: {{$access[$university->access]}}<br>
        {{Form::hidden('access',$university->access)}}
        {{ trans('network.specialization') }}: <span class="speciality">{{$university->meta_1}}</span><br>
        {{ trans('network.notes') }}: <span class="description">{{$university->description}}</span><br>
        <a onclick="university.edit({{$university->id}})">{{ trans('network.edit') }}</a><br><br>
    </div>
@endforeach