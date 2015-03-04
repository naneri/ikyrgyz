@foreach($universities as $university)
    <div id="university_{{$university->id}}">
        <h3 style="font-weight: bold;"><span class="university-name">{{$university->value}}</span></h3> 
        с <span class="year-begin">{{strtok($university->date_begin,'-')}}</span> 
        по <span class="year-end">{{strtok($university->date_end,'-')}}</span><br>
        Доступно: {{$access[$university->access]}}<br>
        {{Form::hidden('access',$university->access)}}
        Специальность: <span class="speciality">{{$university->meta_1}}</span><br>
        Примечания: <span class="description">{{$university->description}}</span><br>
        <a onclick="university.edit({{$university->id}})">Редактировать</a><br><br>
    </div>
@endforeach