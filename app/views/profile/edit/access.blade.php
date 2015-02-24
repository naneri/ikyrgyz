@extends('misc.layout')
@extends('profile.edit.layout')
@section('form')
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Настройка публичности</h3>
        </div>
        <div class="panel-body">
            {{Form::open(array('url' => 'profile/edit/access'))}}
                <fieldset>
                    <div class="form-group" id="access">
                        <table>
                            <thead>
                                <tr>
                                    <td>Основная информация:</td>
                                    <td>Всем</td>
                                    <td>Друзьям</td>
                                    <td>Только мне</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Фамилия</td>
                                    <td>{{Form::radio('names_access', 'all', $user['description']->names_access == 'all')}}</td>
                                    <td>{{Form::radio('names_access', 'friend', $user['description']->names_access == 'friend')}}</td>
                                    <td>{{Form::radio('names_access', 'me', $user['description']->names_access == 'me')}}</td>
                                </tr>
                                <tr>
                                    <td>Дата рождения</td>
                                    <td>{{Form::radio('birthday_access', 'all', $user['description']->birthday_access == 'all')}}</td>
                                    <td>{{Form::radio('birthday_access', 'friend', $user['description']->birthday_access == 'friend')}}</td>
                                    <td>{{Form::radio('birthday_access', 'me', $user['description']->birthday_access == 'me')}}</td>
                                </tr>
                                <tr>
                                    <td>Пол</td>
                                    <td>{{Form::radio('gender_access', 'all', $user['description']->gender_access == 'all')}}</td>
                                    <td>{{Form::radio('gender_access', 'friend', $user['description']->gender_access == 'friend')}}</td>
                                    <td>{{Form::radio('gender_access', 'me', $user['description']->gender_access == 'me')}}</td>
                                </tr>
                                <tr>
                                    <td>Вы проживаете</td>
                                    <td>{{Form::radio('liveplace_access', 'all', $user['description']->liveplace_access == 'all')}}</td>
                                    <td>{{Form::radio('liveplace_access', 'friend', $user['description']->liveplace_access == 'friend')}}</td>
                                    <td>{{Form::radio('liveplace_access', 'me', $user['description']->liveplace_access == 'me')}}</td>
                                </tr>
                                <tr>
                                    <td>Ваша родина</td>
                                    <td>{{Form::radio('birthplace_access', 'all', $user['description']->birthplace_access == 'all')}}</td>
                                    <td>{{Form::radio('birthplace_access', 'friend', $user['description']->birthplace_access == 'friend')}}</td>
                                    <td>{{Form::radio('birthplace_access', 'me', $user['description']->birthplace_access == 'me')}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table>
                            <thead>
                                <tr>
                                    <td>Образование:</td>
                                    <td>Всем</td>
                                    <td>Друзьям</td>
                                    <td>Только мне</td>
                                    <td>По умолчанию</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Средняя школа</td>
                                    <td>{{Form::radio('school_access', 'all')}}</td>
                                    <td>{{Form::radio('school_access', 'friend')}}</td>
                                    <td>{{Form::radio('school_access', 'me')}}</td>
                                    <td>{{Form::radio('school_access', 'default', true)}}</td>
                                </tr>
                                <tr>
                                    <td>Высшее учебное заведение</td>
                                    <td>{{Form::radio('university_access', 'all')}}</td>
                                    <td>{{Form::radio('university_access', 'friend')}}</td>
                                    <td>{{Form::radio('university_access', 'me')}}</td>
                                    <td>{{Form::radio('university_access', 'default', true)}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table>
                            <thead>
                                <tr>
                                    <td>Работа:</td>
                                    <td>Всем</td>
                                    <td>Друзьям</td>
                                    <td>Только мне</td>
                                    <td>По умолчанию</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Места работы</td>
                                    <td>{{Form::radio('job_access', 'all')}}</td>
                                    <td>{{Form::radio('job_access', 'friend')}}</td>
                                    <td>{{Form::radio('job_access', 'me')}}</td>
                                    <td>{{Form::radio('job_access', 'default', true)}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table>
                            <thead>
                                <tr>
                                    <td>Контактная информация:</td>
                                    <td>Всем</td>
                                    <td>Друзьям</td>
                                    <td>Только мне</td>
                                    <td>По умолчанию</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Телефон</td>
                                    <td>{{Form::radio('phone_access', 'all')}}</td>
                                    <td>{{Form::radio('phone_access', 'friend')}}</td>
                                    <td>{{Form::radio('phone_access', 'me')}}</td>
                                    <td>{{Form::radio('phone_access', 'default', true)}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{Form::radio('email_access', 'all')}}</td>
                                    <td>{{Form::radio('email_access', 'friend')}}</td>
                                    <td>{{Form::radio('email_access', 'me')}}</td>
                                    <td>{{Form::radio('email_access', 'default', true)}}</td>
                                </tr>
                                <tr>
                                    <td>Адрес</td>
                                    <td>{{Form::radio('address_access', 'all')}}</td>
                                    <td>{{Form::radio('address_access', 'friend')}}</td>
                                    <td>{{Form::radio('address_access', 'me')}}</td>
                                    <td>{{Form::radio('address_access', 'default', true)}}</td>
                                </tr>
                                <tr>
                                    <td>Мессенджер</td>
                                    <td>{{Form::radio('messenger_access', 'all')}}</td>
                                    <td>{{Form::radio('messenger_access', 'friend')}}</td>
                                    <td>{{Form::radio('messenger_access', 'me')}}</td>
                                    <td>{{Form::radio('messenger_access', 'default', true)}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table>
                            <thead>
                                <tr>
                                    <td>Семья:</td>
                                    <td>Всем</td>
                                    <td>Друзьям</td>
                                    <td>Только мне</td>
                                    <td>По умолчанию</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Члены моей семьи</td>
                                    <td>{{Form::radio('family_access', 'all')}}</td>
                                    <td>{{Form::radio('family_access', 'friend')}}</td>
                                    <td>{{Form::radio('family_access', 'me')}}</td>
                                    <td>{{Form::radio('family_access', 'default', true)}}</td>
                                </tr>
                                <tr>
                                    <td>Семейное положение</td>
                                    <td>{{Form::radio('marital_status_access', 'all', $user['description']->marital_status_access == 'all')}}</td>
                                    <td>{{Form::radio('marital_status_access', 'friend', $user['description']->marital_status_access == 'friend')}}</td>
                                    <td>{{Form::radio('marital_status_access', 'me', $user['description']->marital_status_access == 'me')}}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table>
                            <thead>
                                <tr>
                                    <td>Дополнительно:</td>
                                    <td>Всем</td>
                                    <td>Друзьям</td>
                                    <td>Только мне</td>
                                    <td>По умолчанию</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Увлечения</td>
                                    <td>{{Form::radio('passion_access', 'all')}}</td>
                                    <td>{{Form::radio('passion_access', 'friend')}}</td>
                                    <td>{{Form::radio('passion_access', 'me')}}</td>
                                    <td>{{Form::radio('passion_access', 'default', true)}}</td>
                                </tr>
                                <tr>
                                    <td>О себе</td>
                                    <td>{{Form::radio('about_me_access', 'all', $user['description']->about_me_access == 'all')}}</td>
                                    <td>{{Form::radio('about_me_access', 'friend', $user['description']->about_me_access == 'friend')}}</td>
                                    <td>{{Form::radio('about_me_access', 'me', $user['description']->about_me_access == 'me')}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Други имена, прозвища</td>
                                    <td>{{Form::radio('nickname_access', 'all')}}</td>
                                    <td>{{Form::radio('nickname_access', 'friend')}}</td>
                                    <td>{{Form::radio('nickname_access', 'me')}}</td>
                                    <td>{{Form::radio('nickname_access', 'default', true)}}</td>
                                </tr>
                            </tbody>
                        </table>
                        {{Form::submit('Go!')}}
                    </div>
                </fieldset>
            {{Form::close()}}
        </div>
    </div>
@stop