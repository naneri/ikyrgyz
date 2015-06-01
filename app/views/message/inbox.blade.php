<div class="b-message-ls-mark">
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
                            <a class="b-message-ls-mark-button__item button-select" onclick="message.toggleActionList();" style="width: 160px;cursor:pointer;">Выберите действие</a>
                            <div class="b-message-ls-mark-button-list dropdown-list">
                                <ul>
                                    <li class="b-message-ls-mark-button-list__item"><a onclick="message.setAction('set_watch', this);" style="cursor: pointer;">Все прочитанны</a></li>
                                    <li class="b-message-ls-mark-button-list__item"><a onclick="message.setAction('set_notwatch', this);" style="cursor: pointer;">Все непрочитанны</a></li>
                                    <li class="b-message-ls-mark-button-list__item"><a onclick="message.setAction('blacklist', this);" style="cursor: pointer;">Черный список</a></li>
                                    <li class="b-message-ls-mark-button-list__item"><a onclick="message.setAction('delete', this);" style="cursor: pointer;">Удалить</a></li>
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
                        <a onclick="message.update('inbox')" style="cursor:pointer;"><img src="{{asset('img/refresh-icon.png')}}" alt=""></a>
                    </li>
                    <div class="clear"></div>
                </ul>
            </td>

        </tr>
        @include('message.build.messages', array('messages' => $messages))
    </table>
</div>