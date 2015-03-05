@extends('misc.layout')
@extends('message.layout')
@section('form')
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Черный список</h4>
        {{Form::hidden('page', 'blacklist')}}
    </div>
    {{Form::open(array('url' => 'messages/action', 'name' => 'messages'))}}
    <div class="panel-body" id="users">
        @include('message.build.users', array('users' => Auth::user()->bannedUsers()))
    </div>
    {{Form::close()}}
</div>
<script>
function unblockUser(userId){
    $.ajax({
        method: 'POST',
        url: '{{URL::to("messages/blacklist")}}',
        data: {
            'user_id': userId,
            'action': 'out'
        },
        success: function($result){
            if(!$result.error){
                $('#users').html($result.users);
            }
        },
        error: function(){
            console.log('error');
        }
    });
}
</script>
@stop