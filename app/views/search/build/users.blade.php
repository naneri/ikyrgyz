@if($users)
    @foreach($users as $user)
        {{$user->id}}. {{$user->email}}<br>
    @endforeach
@else
    По данным критериям пользователей не найдено
@endif