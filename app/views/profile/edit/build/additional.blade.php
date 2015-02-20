@foreach($additionals as $additional)
<div id="additional_{{$additional->id}}">
    <h3 style="font-weight: bold;"><span class="additional-value">{{$additional->value}}</span></h3>
    {{Form::select('additional_access', $access, $additional->access)}}<br>
    <a onclick="additional.edit('{{$additional->subtype}}',{{$additional->id}})">Редактировать</a><br><br>
</div>
@endforeach