@foreach($additionals as $additional)
<div id="additional_{{$additional->id}}">
    <h3 style="font-weight: bold;"><span class="additional-value">{{$additional->value}}</span></h3>
    {{ trans('network.available') }}: {{$access[$additional->access]}}<br>
    {{Form::hidden('access', $additional->access)}}
    <a onclick="additional.edit('{{$additional->subtype}}',{{$additional->id}})">{{ trans('network.edit') }}</a><br><br>
</div>
@endforeach