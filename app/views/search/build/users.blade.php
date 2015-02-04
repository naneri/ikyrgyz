@foreach($users as $user)
    {{$user->id}}. {{$user->email}}<br>
@endforeach