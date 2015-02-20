@extends('misc.layout')
@section('content')

<div class="container">
    <div class="col-md-4">
        {{HTML::link('profile/edit/main', 'Основная')}}
        {{HTML::link('profile/edit/study', 'Образование')}}
        {{HTML::link('profile/edit/job', 'Работа')}}
        {{HTML::link('profile/edit/contact', 'Контакты')}}
        {{HTML::link('profile/edit/family', 'Семья')}}
        {{HTML::link('profile/edit/additional', 'Дополнительно')}}
        {{HTML::link('profile/edit/access', 'Настройка публичности')}}
    </div>
	<div class="col-md-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Контакты</h3>
                </div>
                <div class="panel-body">
                    <fieldset>
                        <div class="form-group" id="phone">
                            Телефоны:<br>
                            <div id="phone_items" class="items">
                                @include('profile.edit.build.contacts', array('contacts' => Auth::user()->contacts()->where('name', 'phone')->get()))
                            </div>

                            <div class="form" style="display: none;">
                                {{Form::open(array('url' => 'profile/edit/contact'))}}
                                    Телефон:
                                    {{Form::text('value')}}<br>
                                    {{Form::select('contact_access', $access)}}<br>
                                    {{Form::hidden('contact_type')}}
                                    {{Form::reset('Очистить')}}
                                    <a href="#" onclick="contact.save('phone')">Сохранить</a>
                                {{Form::close()}}
                            </div>
                            <a onclick="contact.addForm('phone')" style="cursor: pointer;">Добавить телефон</a>
                        </div>
                        <br>
                        <br>                            
                        <div class="form-group" id="email">
                            Emails:<br>
                            <div id="email_items" class="items">
                                @include('profile.edit.build.contacts', array('contacts' => Auth::user()->contacts()->where('name', 'email')->get()))
                            </div>
                            <div class="form" style="display: none;">
                                {{Form::open(array('url' => 'profile/edit/contact'))}}
                                Email:
                                {{Form::text('value')}}<br>
                                {{Form::select('contact_access', $access)}}<br>
                                {{Form::hidden('contact_type')}}
                                {{Form::reset('Очистить')}}
                                <a href="#" onclick="contact.save('email')">Сохранить</a>
                                {{Form::close()}}
                            </div>
                            <a onclick="contact.addForm('email')" style="cursor: pointer;">Добавить email</a>
                        </div>
                        <br>
                        <br>
                        <div class="form-group" id="address">
                            Address:<br>
                            <div id="address_items" class="items">
                                @include('profile.edit.build.contacts', array('contacts' => Auth::user()->contacts()->where('name', 'address')->get()))
                            </div>
                            <div class="form" style="display: none;">
                                {{Form::open(array('url' => 'profile/edit/contact'))}}
                                Address:
                                {{Form::text('value')}}<br>
                                {{Form::select('contact_access', $access)}}<br>
                                {{Form::hidden('contact_type')}}
                                {{Form::reset('Очистить')}}
                                <a href="#" onclick="contact.save('address')">Сохранить</a>
                                {{Form::close()}}
                            </div>
                            <a onclick="contact.addForm('address')" style="cursor: pointer;">Добавить адрес</a>
                        </div>
                        <br>
                        <br>
                        <div class="form-group" id="messenger">
                            Messengers:<br>
                            <div id="messeger_items" class="items">
                                @include('profile.edit.build.contacts', array('contacts' => Auth::user()->contacts()->where('name', 'messenger')->get()))
                            </div>
                            <div class="form" style="display: none;">
                                {{Form::open(array('url' => 'profile/edit/contact'))}}
                                Messenger:
                                {{Form::text('value')}}<br>
                                {{Form::select('contact_access', $access)}}<br>
                                {{Form::hidden('contact_type')}}
                                {{Form::reset('Очистить')}}
                                <a href="#" onclick="contact.save('messenger')">Сохранить</a>
                                {{Form::close()}}
                            </div>
                            <a onclick="contact.addForm('messenger')" style="cursor: pointer;">Добавить мессенджер</a>
                        </div>
                    </fieldset>
                </div>
            </div>
	</div>
	<div class="col-md-4"></div>

</div>
@stop

@section('scripts')
<script>
    var contact = {
        save: function(contactType){
            var $form = $('#'+contactType+' form');
            var data = $form.serialize();
            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: data,
                success: function(result){
                    if(!result.errors){
                        $('#'+contactType+' .items').html(result);
                    }
                },
                error: function(){
                    alert('error');
                }
            });
        },
        edit: function(contactType, contactId){
            var $contact = $('#contact_'+contactId);
            var $form = $('#'+contactType+' form');
            $form.find('input[name="value"]').val($contact.find('.contact-value').text());
            var $contactAccess = $contact.find('select option:selected');
            $form.find('select option').each(function(){
                if($(this).val() == $contactAccess.val()){
                    $(this).prop('selected', true);
                }
            });
            $form.append('<input type="hidden" name="contact_id" value="'+contactId+'">');
            $form.find('input[name="contact_type"]').val(contactType);
            contact.showForm();
        },
        showForm: function(){
            $('#contact .form').show();
        },
        addForm:function(contactType){
            var $form = $('#'+contactType+' form');
            $form.find('input[type="reset"]').click();
            $form.find('input[name="contact_id"]').remove();
            $form.find('input[name="contact_type"]').val(contactType);
            $('#'+contactType+' .form').show();
        }
    };
</script>
@stop