@foreach($members as $member)
<div id="member_{{$member->id}}">
    <h3 style="font-weight: bold;"><span class="member-name">{{$member->meta_1}}</span></h3>
    {{Form::select('member_relative', $relatives, $member->name)}}
    {{Form::select('member_access', $access, $member->access)}}<br>
    <a onclick="family.edit({{$member->id}})">Редактировать</a><br><br>
</div>
@endforeach