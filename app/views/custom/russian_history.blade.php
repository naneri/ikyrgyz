@extends('misc.layout')

@section('content')
    <style>
        h2{
            font-size: 30px;
            font-weight: bold;
        }
        h3{
            font-size: 20px;
            font-weight: bold;
        }
    </style>
    <div class="b-wrapper">
        <div class="b-page">
            <div class="b-content">
                <div class="b-profile-about">
                    <div class="b-profile-about__inner">
                        <div class="b-profile-about__text">
                            <div class="b-profile-about-text">
                                <div class="b-profile-about-text__text">
                                    <h2>История России</h2>
                                    <br/>
                                    Российская Федерация является исторической преемницей предшествующих форм непрерывной российской государственности с 862 года: Древнерусского государства (862—1240), Великого княжества Владимирского (1157—1389), Московского княжества (1263—1547), Русского царства (1547—1721), Российской империи (1721—1917), Российской республики (1917), Российской Советской Федеративной Социалистической Республики (1917—1922, с 1922 года республика в составе СССР) и Союза Советских Социалистических Республик (1922—1991).
                                    <br/><br/>
                                    <h3>Древнейшая история</h3>
                                    <br/>
                                    Богатейшие археологические культуры России указывают на древнюю историю освоения её земель первобытными людьми — не менее 1 млн, возможно 1,5 млн лет назад (Таманский полуостров). Самыми древними стоянками Homo sapiens (людей современного вида) на современной территории России считаются Костёнки, Зарайская стоянка (45-35 тыс. до н. э.) и Сунгирь (25 тыс. до н. э.).
                                    <br/><br/>
                                    Благодаря Геродоту в античности обширные территории Восточной Европы (в том числе Европейской России) были известны под именем Скифии. На западе России в верховьях Днепра обитали андрофаги, которых отождествляют с носителями днепро-двинской культуры. Представителей этой культуры отличал крайне примитивный быт, отсутствие погребений и каменные топоры. В V тыс. до н. э. в степях южной России на периферии Балканского неолита формируется Самарская культура, которую многие исследователи считают праиндоевропейской. Они занимались скотоводством, изготавливали ювелирные украшения и насыпали над своими мертвецами курганы.
                                    <br/><br/>
                                    В IV веке н. э. Великая Степь тюркизируется под влиянием гуннов. На смену Империи Гуннов (Гунналанд) приходят недолговечные объединения кочевников, которые используют Степь как плацдарм для нападения на земледельческие цивилизации: Тюркский каганат, Аварский каганат, Великая Болгария, Хазарский каганат.
                                    <br/><br/>
                                    Традиционно основание Древнерусского государства связывают с призванием князя Рюрика в 862 году на княжение восточнославянским племенным союзом словен.
                                    <br/><br/>
                                    <h3>Русское царство</h3>
                                    <br/>
                                    В 1547 году великий князь московский Иван IV Грозный венчается на царство и, таким образом, становится первым российским царём. В 1549 году созван первый сословно-представительный орган — Земский собор. Непопулярная политика неродовитого царя Бориса Годунова при сильных монархических настроениях в обществе спровоцировали Смуту. Возник слух, что «невинноубиенный» царевич Дмитрий (сын Ивана Грозного) чудесным образом спасся и желает взойти на престол. Для борьбы с последствиями Смуты был созван Земский собор 1613 года, на котором на царство был призван Михаил Романов — первый из династии Романовых.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/russian_history_1.jpg') }}" style="width: 100%"/>
                                    <br/><br/>
                                    В 1654 году казаки Богдана Хмельницкого, поднявшие восстание против Польши, присягнули на верность московскому царю Алексею. Этот акт привёл к русско-польской войне, в результате которой Киев, Смоленск и значительная часть Приднепровья попадает под власть Москвы.
                                    <br/><br/>
                                    Церковная реформа патриарха Никона провоцирует раскол. Ревнители старины уходят в оппозицию, а в России усиливается вестернизация: появляются «полки нового строя» (рейтары), в высших слоях общества усиливается интерес к западной культуре (театр, портретная живопись). Элементы раскола и Смуты проявляются в восстании Степана Разина (1670—1671).
                                    <br/><br/>
                                    <h3>Российская империя</h3>
                                    <br/>
                                    Стрелецкие бунты 1682 и 1696 годов, боярские распри, а также временные неудачи в войне со шведами (Битва при Нарве) приводят царя Петра к мысли о необходимости коренных реформ с целью форсированной модернизации страны. На новых землях закладывается Санкт-Петербург (1703), куда переносится столица государства. В 1721 году Россия объявляется империей.
                                    <br/><br/>
                                    После смерти Петра в России наступил нестабильный период «временщиков», который характеризуется дворцовыми переворотами и «засильем иностранцев». В 1762 году в результате очередного дворцового переворота к власти пришла немка Екатерина II. Под началом Екатерины действовали такие великие государственные деятели как Державин, Ломоносов, Суворов и Ушаков. Тем не менее, её правление сопровождалось Пугачёвским восстанием.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/russian_history_1.jpg') }}" style="width: 100%"/>
                                    <br/><br/>
                                    Внук Екатерины II Александр I стал последним императором, пришедшим к власти в результате дворцового переворота. На время его правления приходится Отечественная война 1812 года, в ходе которой французскому императору Наполеону после кровопролитной Бородинской битвы удалось захватить Москву.
                                    <br/><br/>
                                    Восшествие на престол Николая I (брата Александра I) омрачилось восстанием в декабре 1825 года, которое провозгласило идеалы «свободы, равенства и братства». Провал восстания (фактически военного мятежа) привёл Николая к более консервативным убеждениям. За восстанием декабристов последовало Польское восстание 1830 года, которое закрепило за Николаем репутацию «душителя свобод».
                                    <br/><br/>
                                    Сын Николая Александр II (Освободитель) вошёл в историю как умеренно-либеральный царь-реформатор. Прежде всего, он отменил крепостное право (1861), восстановил автономию университетов, расширил местное самоуправление — ввёл суды присяжных и земские собрания, а также реформировал армию на основе всеобщей воинской повинности (1874).
                                    <br/><br/>
                                    Воцарению Николая II сопутствовал трагический инцидент на Ходынском поле (1896), в результате которого погибло свыше 1 тыс. человек. Другим событием, негативно повлиявшим на репутацию царя, стала неудачная русско-японская война 1904—1905 годов, в ходе которой Россия утратила базу Порт-Артур и половину Сахалина.
                                    <br/><br/>
                                    <h3>Советский период</h3>
                                    <br/>
                                    После окончания Гражданской войны большевики вынуждены были отказаться от планов немедленного воплощения коммунистической утопии и объявить новую экономическую политику, то есть ввести рыночную экономику при однопартийной диктатуре. Эта политика совпала с образованием Союза Советских Социалистических Республик, в который первоначально вошли Россия, Украина, Белоруссия и Закавказье.
                                    <br/><br/>
                                    Накануне Великой Отечественной войны Советский Союз имел ряд приграничных конфликтов с Японией (Бои на Халхин-Голе) и Финляндией (Финская кампания), а также разделил Восточную Европу с Германией согласно пакту Риббентропа-Молотова (1939).
                                    <br/><br/>
                                    22 июня 1941 года войска Третьего Рейха без объявления войны вторглись на территорию СССР. Первые сражения начавшейся Великой Отечественной войны проходили к западу от административных границ РСФСР.  Война продолжалась вплоть до окончательной победы над Германией 9 мая 1945 года. Победа была одержана ценой огромных потерь.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/russian_history_3.jpg') }}" style="width: 100%"/>
                                    <br/><br/>
                                    После войны образовался советский блок, который включал в себя подконтрольные Москве государства Восточной Европы (Венгрия, Польша, Румыния, Болгария, Чехословакия, ГДР), а также некоторые азиатские и африканские страны. Однако экспансионистская политика СССР привела к конфликту со странами Запада, что выразилось в холодной войне. Началась гонка вооружений. Уже при Сталине в СССР была создана и испытана атомная бомба (1949). При Хрущёве был запущен первый искусственный спутник Земли (1957) и осуществлён первый полёт человека в космос (1961). При Брежневе советские учёные исследовали поверхность Луны при помощи аппарата Луноход-1 (1970). Военным следствием советской космической программы были межконтинентальные баллистические ракеты, способные доставить ядерный заряд в любую точку планеты. В 1985 году страну возглавил Михаил Горбачёв, который инициировал большие, глубокие, неоднозначные перемены во всех сферах жизни советского общества.
                                    <br/><br/>
                                    <h3>Российская Федерация</h3>
                                    <br/>
                                    25 декабря в 19 часов 38 минут над Кремлём произошла символическая смена флага СССР на российский триколор. В тот же день специальным законом РСФСР была переименована в Российскую Федерацию (Россию).
                                    <br/><br/>
                                    После распада СССР в декабре 1991 года Российская Федерация стала независимым государством в границах бывшей РСФСР. Президент Борис Ельцин и и. о. председателя правительства Егор Гайдар начали проводить в стране радикальные либеральные реформы («шоковая терапия»), направленные на становление рыночной экономики.
                                    <br/><br/>
                                    Ценой привлечения агрессивных политтехнологий команде Ельцина удалось сохранить власть на президентских выборах 1996 года. Однако в России назрел кризис, выразившийся в обесценивании национальной валюты (дефолт 1998 года).
                                    <br/><br/>
                                    На волне реваншистских настроений в России премьер-министром был назначен более молодой и энергичный подполковник КГБ в отставке Владимир Путин, которому Ельцин 31 декабря 1999 года передал всю полноту власти.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/russian_history_4.jpg') }}" style="width: 100%"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop