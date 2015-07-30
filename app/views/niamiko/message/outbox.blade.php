<div class="b-message-ls-mark">
    {{Form::open(array('url' => 'messages/action', 'name' => 'messages'))}}
    <table>
        <tr>
            <td>
                <ul>
                    <li class="b-message-ls-mark__list">
                        <div class="b-message-ls-mark__checkbox">
                            <input type="checkbox" onclick="message.checkAll(this);" />
                        </div>
                    </li>
                    <li class="b-message-ls-mark__list b-message-ls-mark__list_border-right">
                        <div class="b-message-ls-mark-button">
                            <a class="b-message-ls-mark-button__item button-select" style="width: 160px;cursor:pointer;" onclick="message.toggleActionList();">{{ trans('network.choose-action') }}</a>
                            <div class="b-message-ls-mark-button-list dropdown-list">
                                <ul>
                                    <!--li class="b-message-ls-mark-button-list__item"><a onclick="message.setAction('set_watch', this);">Все прочитанны</a></li-->
                                    <li class="b-message-ls-mark-button-list__item"><a onclick="message.setAction('delete', this);" style="cursor: pointer;">{{ trans('network.delete') }}</a></li>
                                </ul>
                            </div>
                            <input type="button" class="b-message-ls-mark-button__item button-make" value="Выполнить" onclick="message.doAction();">
                        </div>
                    </li>
                    <!--li class="b-message-ls-mark__list b-message-ls-mark__list_sort">
                        <a href="">Все</a>
                        <a href="">Друзья</a>
                        <a href="">Группы</a>
                        <a href="">События</a>
                    </li-->
                    <li class="b-message-ls-mark__list b-message-ls-mark__list_last">
                        <a onclick="message.update('outbox')" style="cursor:pointer;"><img src="{{asset('img/refresh-icon.png')}}" alt=""></a>
                    </li>
                    <div class="clear"></div>
                </ul>
            </td>

        </tr>
        @include('message.build.messages', array('messages' => $messages))
    </table>
    {{Form::close()}}
</div>