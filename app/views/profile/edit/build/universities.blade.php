@foreach($universities as $university)
    <div id="university_{{$university->id}}">
        <h3 style="font-weight: bold;"><span class="university-name">{{$university->name}}</span></h3> 
        с <span class="year-begin">{{date('Y', strtotime($university->date_begin))}}</span> 
        по <span class="year-end">{{date('Y', strtotime($university->date_end))}}</span><br>
        {{Form::select('access_university_'.$university->id, $access, $university->access)}}<br>
        Специальность: <span class="speciality">{{$university->meta_1}}</span><br>
        Примечания: <span class="description">{{$university->description}}</span><br>
        <a onclick="university.edit({{$university->id}})">Редактировать</a><br><br>
    </div>
@endforeach