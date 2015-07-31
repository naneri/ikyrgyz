@foreach($contacts as $contact)
<div id="contact_{{$contact->id}}">
    <h3 style="font-weight: bold;"><span class="contact-value">{{$contact->value}}</span></h3>
    {{ trans('network.available') }}: {{$access[$contact->access]}}<br>
    {{Form::hidden('access', $contact->access)}}
    <a onclick="contact.edit('{{$contact->subtype}}',{{$contact->id}})">{{ trans('network.edit') }}</a><br><br>
</div>
@endforeach