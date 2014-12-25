C:\xampp2\htdocs\newkyrgyz\app/views/photos/index.blade.php<br>
@foreach($photos as $photo)
    <img src='{{$photo->url}}' />
@endforeach