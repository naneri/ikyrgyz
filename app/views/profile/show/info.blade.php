<p class="user-raiting">Рейтинг <span class="num">{{$user->rating}}</span></p>
<p class="user-name">{{$user->getNames()}}</p>
<p class="user-date">
    @if($user->description->checkAccess('birthday_access') && $user->description->birthday)
        {{$user->description->birthday()}},
    @endif
    @if($user->description->checkAccess('gender_access') && $gender)
        {{$gender}},
    @endif
    @if($user->description->checkAccess('marital_status_access') && $maritalStatus)
        {{$maritalStatus}},
    @endif
</p>
@if($user->description->checkAccess('birthplace_access') && $user->description->birthplace_country_id && $user->description->birthplace_city_id)
    <p class="user-date">
        <span class="place-info">{{ trans('network.birth-place') }}:</span> 
        {{Country::find($user->description->birthplace_country_id)->name_ru}}, {{City::find($user->description->birthplace_city_id)->name_ru}}
    </p>
@endif
@if($user->description->checkAccess('liveplace_access') && $user->description->liveplace_country_id && $user->description->liveplace_city_id)
    <p class="user-date">
        <span class="place-info">{{ trans('network.lives-in') }}:</span>
        {{Country::find($user->description->liveplace_country_id)->name_ru}}, {{City::find($user->description->liveplace_city_id)->name_ru}}
    </p>
@endif
@if(array_count_values($addresses = $user->profileItemsGetValues('address')) > 0)
<p class="user-date">
    @foreach($addresses as $address)
        {{$address}}, 
    @endforeach
</p>
@endif
@if(array_count_values($schools = $user->profileItemsGetValues('school')) > 0)
<p class="user-date">
    @foreach($schools as $school)
        {{$school}}, 
    @endforeach
</p>
@endif
@if(array_count_values($universities = $user->profileItemsGetValues('university')) > 0)
<p class="user-date">
    @foreach($universities as $university)
        {{$university}}, 
    @endforeach
</p>
@endif
@if(array_count_values($jobs = $user->profileItemsGetValues('job')) > 0)
<p class="user-date">
    @foreach($jobs as $job)
        {{$job}}, 
    @endforeach
</p>
@endif
@if(array_count_values($phones = $user->profileItemsGetValues('phone')) > 0)
<p class="user-date">
    @foreach($phones as $phone)
        {{$phone}}, 
    @endforeach
</p>
@endif
@if(array_count_values($emails = $user->profileItemsGetValues('email')) > 0)
<p class="user-date">
    @foreach($emails as $email)
        {{$email}}, 
    @endforeach
</p>
@endif

@if($user->id != Auth::id())
<hr>
<div style="text-align: center;">
    @if($user->friends()->count() > 0)
        <a href="{{URL::to('profile/'.$user->id.'/friends')}}">
            <div style="float:left;width:20%;">
                <div style="color: #0086b3; font-size: 30px; font-family: 'PT Sans Caption';">{{$user->friends()->count()}}</div>
                <div class="user-date" style="font-size: 15px;">друзей</div>
            </div>
        </a>
    @endif
    @if($user->mutualFriends()->count() > 0)
        <a href="{{URL::to('profile/'.$user->id.'/mutualFriends')}}">
            <div style="float:left;width:20%;">
                <div style="color: #0086b3; font-size: 30px; font-family: 'PT Sans Caption';">{{$user->mutualFriends()->count()}}</div>
                <div class="user-date" style="font-size: 15px;">общих</div>
            </div>
        </a>
    @endif
    @if($user->subscribers()->count() > 0)
        <a href="{{URL::to('profile/'.$user->id.'/subscribers')}}">
            <div style="float:left;width:20%;">
                <div style="color: #0086b3; font-size: 30px; font-family: 'PT Sans Caption';">{{$user->subscribers()->count()}}</div>
                <div class="user-date" style="font-size: 15px;">подписчика</div>
            </div>
        </a>
    @endif
    @if($user->photos()->count() > 0)
        <a href="{{URL::to('profile/'.$user->id.'/photos')}}">
            <div style="float:left;width:20%;">
                <div style="color: #0086b3; font-size: 30px; font-family: 'PT Sans Caption';">{{$user->photos()->count()}}</div>
                <div class="user-date" style="font-size: 15px;">фото</div>
            </div>
        </a>
    @endif
    @if($user->topicsWithVideo()->count() > 0)
        <a href="{{URL::to('profile/'.$user->id.'/videos')}}">
            <div style="float:left;width:20%;">
                <div style="color: #0086b3; font-size: 30px; font-family: 'PT Sans Caption';">{{$user->topicsWithVideo()->count()}}</div>
                <div class="user-date" style="font-size: 15px;">видео</div>
            </div>
        </a>
    @endif
</div>
@endif

<script>
$(document).ready(function(){
    $('.user-date').each(function(){
        this.innerText = this.innerText.replace(/,\s*$/, '');
    });
});
</script>