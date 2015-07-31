<div class="b-settings">
	<div class="b-settings__left">
		<div class="b-settings-top">
			<img src="{{ asset('img/237.png') }}" alt="" class="b-settings-top__image">
			<span class="b-settings-top__name">Настройки</span>
		</div>
		<div class="b-settings-list">
			<ul class="tab">
				<li class="b-settings-list__list b-settings-list__list_first tab-link currents" data-tab="tab-1" ><a href="#">Учетная запись</a></li>
				<li class="b-settings-list__list tab-link "data-tab="tab-2"><a href="#">Основная информация</a></li>
				<li class="b-settings-list__list tab-link" data-tab="tab-3"><a href="">Образование</a></li>
				<li class="b-settings-list__list"><a href="">Контакты</a></li>
				<li class="b-settings-list__list"><a href="">Семья</a></li>
				<li class="b-settings-list__list"><a href="">Дополнительно</a></li>
				<li class="b-settings-list__list"><a href=""></a></li>
			</ul>
		</div>
	</div>

	<div class="b-settings__right">
		<div class="b-settings-inner tab-contents currents" id="tab-1" >
			<span class="b-settings-inner__name">Учетная запись</span>
			<div class="b-settings-inner-list">
				<ul>
					<li class="b-settings-inner-list__list">
						<div class="b-settings-inner-list-login">
							<div class="b-settings-inner-list-login__name setting-name">Логин</div>
							<input type="text" value="login@domain.com" class="b-settings-inner-list-login__login setting-input">
						</div>
					</li>
					<li class="b-settings-inner-list__list">
						<div class="b-settings-inner-list-button">
							<a href="" class="b-settins-inner-list-button__item">Изменить</a>
						</div>
					</li>
					<li class="b-settings-inner-list__list">
						<div class="b-settings-inner-list-password">
							<div class="b-settings-inner-list-password__name setting-name">Текущий пароль:</div>
							<input type="text" class="b-settings-inner-list-password__item setting-input">
						</div>
					</li>
					<li class="b-settings-inner-list__list">
						<div class="b-settings-inner-list-password">
							<div class="b-settings-inner-list-password__name setting-name">Новый пароль:</div>
							<input type="text" class="b-settings-inner-list-password__item setting-input">
						</div>
					</li>
					<li class="b-settings-inner-list__list">
						<div class="b-settings-inner-list-password">
							<div class="b-settings-inner-list-password__name setting-name">Повторите новый пароль:</div>
							<input type="text" class="b-settings-inner-list-password__item setting-input">
						</div>
					</li>
					<li class="b-settings-inner-list__list">
						<div class="b-settings-inner-list-notification">
							Вы можете использовать латинские буквы, цифры и специальные символы ! @ # $ % ^ & * ( ) _ - + в любом их сочетании. Пароль должен быть не короче 6 символов.
						</div>
					</li>
				</ul>
			</div>
			<div class="b-settings-inner-button">
				<a href="#" class="b-settings-inner-button__cancel">Отмена</a>
				<a href="" class="b-settings-inner-button__submit">Сохранить</a>
			</div>
		</div>

		<div class="b-settings-inner tab-contents " id="tab-2" >
			<span class="b-settings-inner__name">Основная информация</span>
			<div class="b-settings-inner-list">
				<ul>
					<li class="b-settings-inner-list__list">
						<table>
							<tr>
								<td>
									<div class="b-settings-inner-list-name">
									<div class="b-settings-inner-list-name__name setting-name">Имя</div>
									<input type="text" class="b-settings-inner-list-name__item setting-input" value="Введите имя">
									</div>
								</td>
								<td>
									<div class="b-settings-inner-list-name">
									<div class="b-settings-inner-list-name__name setting-name">Фамилия</div>
									<input type="text" class="b-settings-inner-list-name__item setting-input" value="Введите фамилию">
									</div>
								</td>
							</tr>
						</table>
					</li>
					<li class="b-settings-inner-list__list">
						<div class="b-settings-inner-list-title">Дата рождения</div>
						<table>
							<td>
								<td>
									<div class="b-settings-inner-list-birth">
										<div class="b-settings-inner-list-birth__name setting-name">День</div>
										<select name="" id="" class="b-settings-inner-list-birth__item"></select>
									</div>
								</td>
								<td>
									<div class="b-settings-inner-list-birth">
										<div class="b-settings-inner-list-birth__name setting-name">Месяц</div>
										<select name="" id="" class="b-settings-inner-list-birth__item"></select>
									</div>
								</td>
								<td>
									<div class="b-settings-inner-list-birth">
										<div class="b-settings-inner-list-birth__name setting-name">Год</div>
										<select name="" id="" class="b-settings-inner-list-birth__item"></select>
									</div>
								</td>
								<td>
									<div class="b-settings-inner-list-birth">
										<div class="b-settings-inner-list-birth__name setting-name">Доступно</div>
										<select name="" id="" class="b-settings-inner-list-birth__item"></select>
									</div>
								</td>
							</td>
						</table>
					</li>
					<li class="b-settings-inner-list__list">
						<div class="b-settings-inner-list-title">Пол</div>
						<table>
							<tr>
								<td>								
									<div class="b-settings-inner-list-gender">
										<input type="radio" class="b-settings-inner-list-gender__item">
										<span class="b-settings-inner-list-gender__name setting-name">Мужской</span>
									</div>
								</td>
								<td>
									<div class="b-settings-inner-list-gender">
										<input type="radio" class="b-settings-inner-list-gender__item">
										<span class="b-settings-inner-list-gender__name setting-name">Женский</span>
									</div>
								</td>
								<td>
									<div class="b-settings-inner-list-gender">
										<input type="radio" class="b-settings-inner-list-gender__item">
										<span class="b-settings-inner-list-gender__name setting-name">Доступно</span>
									</div>
								</td>
								<td>
									<div class="b-settings-inner-list-gender">
										<select name="" id="" class="b-settings-inner-list-gender__item"></select>
									</div>
								</td>
							</tr>
						</table>
					</li>
					<li class="b-settings-inner-list__list">
						<div class="b-settings-inner-list-title">Дата рождения</div>
						<table>
							<tr>
								<td>
									<div class="b-settings-inner-list-live">
										<div class="b-settings-inner-list-live__name setting-name">Страна</div>
										<select name="" id="" class="b-settings-inner-list-live__item"></select>
									</div>
								</td>
								<td>
									<div class="b-settings-inner-list-live">
										<div class="b-settings-inner-list-live__name setting-name">Страна</div>
										<select name="" id="" class="b-settings-inner-list-live__item"></select>
									</div>
								</td>
								<td>
									<div class="b-settings-inner-list-live">
										<div class="b-settings-inner-list-live__name setting-name">Страна</div>
										<select name="" id="" class="b-settings-inner-list-live__item"></select>
									</div>
								</td>
							</tr>
						</table>
					</li>
					<li class="b-settings-inner-list__list">
						<div class="b-settings-inner-list-title">Ваша родина</div>
						<table>
							<tr>
								<td>
									<div class="b-settings-inner-list-home">
										<div class="b-settings-inner-list-home__name setting-name">Страна</div>
										<select name="" id="" class="b-settings-inner-list-home__item"></select>
									</div>
								</td>
								<td>
									<div class="b-settings-inner-list-home">
										<div class="b-settings-inner-list-home__name setting-name">Город</div>
										<select name="" id="" class="b-settings-inner-list-home__item"></select>
									</div>
								</td>
								<td>
									<div class="b-settings-inner-list-home">
										<div class="b-settings-inner-list-home__name setting-name">Доступно</div>
										<select name="" id="" class="b-settings-inner-list-home__item"></select>
									</div>
								</td>
							</tr>
						</table>
					</li>
				</ul>
			</div>
			<div class="b-settings-inner-button">
				<a href="#" class="b-settings-inner-button__cancel">Отмена</a>
				<a href="" class="b-settings-inner-button__submit">Сохранить</a>
			</div>
		</div>
		<div class="b-settings-inner tab-contents" id="tab-3">
			<span>adsad</span>
		</div>

	</div>
	<div class="clear"></div>
</div>

