@foreach($members as $member)
<div id="member_{{$member->id}}">
    <h3 style="font-weight: bold;"><span class="member-name">{{$member->value}}</span></h3>
    {{Form::select('member_relative', $relatives, $member->subtype)}}
    {{Form::select('member_access', $access, $member->access)}}<br>
    <a onclick="family.edit({{$member->id}})">Редактировать</a><br><br>
</div>
@endforeach