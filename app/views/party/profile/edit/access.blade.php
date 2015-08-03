@extends("{$template}misc.layout")
@extends("{$template}profile.edit.layout")
@section('form')
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('network.public-settings') }}</h3>
        </div>
        <div class="panel-body">
            {{Form::open(array('url' => 'profile/edit/access'))}}
                <fieldset>
                    <div class="form-group" id="access">
                        <table>
                            <thead>
                                <tr>
                                    <td>{{ trans('network.main-info') }}:</td>
                                    <td>{{ trans('network.to-all') }}</td>
                                    <td>{{ trans('network.to-friends') }}</td>
                                    <td>{{ trans('network.to-me') }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ trans('network.last-name') }}</td>
                                    <td>{{Form::radio('names_access', 'all', $user['description']->names_access == 'all')}}</td>
                                    <td>{{Form::radio('names_access', 'friend', $user['description']->names_access == 'friend')}}</td>
                                    <td>{{Form::radio('names_access', 'me', $user['description']->names_access == 'me')}}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('network.birth-date') }}</td>
                                    <td>{{Form::radio('birthday_access', 'all', $user['description']->birthday_access == 'all')}}</td>
                                    <td>{{Form::radio('birthday_access', 'friend', $user['description']->birthday_access == 'friend')}}</td>
                                    <td>{{Form::radio('birthday_access', 'me', $user['description']->birthday_access == 'me')}}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('network.gender') }}</td>
                                    <td>{{Form::radio('gender_access', 'all', $user['description']->gender_access == 'all')}}</td>
                                    <td>{{Form::radio('gender_access', 'friend', $user['description']->gender_access == 'friend')}}</td>
                                    <td>{{Form::radio('gender_access', 'me', $user['description']->gender_access == 'me')}}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('network.you-live-in') }}</td>
                                    <td>{{Form::radio('liveplace_access', 'all', $user['description']->liveplace_access == 'all')}}</td>
                                    <td>{{Form::radio('liveplace_access', 'friend', $user['description']->liveplace_access == 'friend')}}</td>
                                    <td>{{Form::radio('liveplace_access', 'me', $user['description']->liveplace_access == 'me')}}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('network.your-motherland') }}</td>
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
                                    <td>{{ trans('network.education') }}:</td>
                                    <td>{{ trans('network.to-all') }}</td>
                                    <td>{{ trans('network.to-friends') }}</td>
                                    <td>{{ trans('network.to-me') }}</td>
                                    <td>{{ trans('network.default') }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ trans('network.middle-schools') }}</td>
                                    <td>{{Form::radio('school_access', 'all')}}</td>
                                    <td>{{Form::radio('school_access', 'friend')}}</td>
                                    <td>{{Form::radio('school_access', 'me')}}</td>
                                    <td>{{Form::radio('school_access', 'default', true)}}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('network.university') }}</td>
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
                                    <td>{{ trans('network.job') }}:</td>
                                    <td>{{ trans('network.to-all') }}</td>
                                    <td>{{ trans('network.to-friends') }}</td>
                                    <td>{{ trans('network.to-me') }}</td>
                                    <td>{{ trans('network.default') }}</td>
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
                                    <td>{{ trans('network.to-all') }}</td>
                                    <td>{{ trans('network.to-friends') }}</td>
                                    <td>{{ trans('network.to-me') }}</td>
                                    <td>{{ trans('network.default') }}</td>
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
                                    <td>{{ trans('network.to-all') }}</td>
                                    <td>{{ trans('network.to-friends') }}</td>
                                    <td>{{ trans('network.to-me') }}</td>
                                    <td>{{ trans('network.default') }}</td>
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
                                    <td>{{ trans('network.to-all') }}</td>
                                    <td>{{ trans('network.to-friends') }}</td>
                                    <td>{{ trans('network.to-me') }}</td>
                                    <td>{{ trans('network.default') }}</td>
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
                        {{Form::submit(trans('network.save'))}}
                    </div>
                </fieldset>
            {{Form::close()}}
        </div>
    </div>
@stop