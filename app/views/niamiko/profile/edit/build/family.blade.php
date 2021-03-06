@foreach($members as $member)
<div id="member_{{$member->id}}">
    <h3 style="font-weight: bold;">{{$relatives[$member->subtype]}}: <span class="member-name">{{$member->value}}</span></h3>
    {{Form::hidden('relative', $member->subtype)}}
    {{ trans('network.available') }}: {{$access[$member->access]}}<br>
    {{Form::hidden('access', $member->access)}}
    <a onclick="family.edit({{$member->id}})">{{ trans('network.edit') }}</a><br><br>
</div>
@endforeach