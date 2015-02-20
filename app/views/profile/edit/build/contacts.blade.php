@foreach($contacts as $contact)
<div id="contact_{{$contact->id}}">
    <h3 style="font-weight: bold;"><span class="contact-value">{{$contact->value}}</span></h3>
    {{Form::select('access_contact_'.$contact->id, $access, $contact->access)}}<br>
    <a onclick="contact.edit('{{$contact->subtype}}',{{$contact->id}})">Редактировать</a><br><br>
</div>
@endforeach