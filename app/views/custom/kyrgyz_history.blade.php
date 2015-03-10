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
                                    <h2>История киргизов</h2>
                                    <br/>
                                    <img src="{{ URL::to('img/custom/kyrgyz_history_1.jpg') }}" style="width: 100%"/>
                                    <br/><br/>
                                    Предки киргизов были одним из кочевых скотоводческих тюркоязычных народов, издревле обитающих на территории Центральной Азии и Южной Сибири в верховьях Енисея. Первое упоминание этнонима «киргиз» встречается в летописи «Ши цзи», написанной китайским историографом Сыма Цянем.
                                    <br/><br/>
                                    В 840 году во время возвышения тюркоязычных племен енисейские кыргызы, осилив своих давних врагов уйгуров, создали новое мощное кыргызское государство, чья экспансия распространялась на территории Алтая, Прииртышья, Тувы и Восточных Саян.
                                    <br/><br/>
                                    Первые государственные образования на территории современной Киргизии возникли во втором веке до н. э., когда южные земледельческие районы страны вошли в состав государства Паркан. В IV—III вв. до нашей эры предки киргизов входили в мощные племенные союзы центральноазиатских кочевников, которые весьма серьёзно тревожили Китай. Именно тогда началось строительство Великой Китайской стены.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/kyrgyz_history_2.png') }}" style="width: 100%"/>
                                    <br/><br/>
                                    В II—I вв. до нашей эры часть кыргызских племен ушла из-под власти гуннов (Хунну) на Енисей. Именно здесь они образовали первое свое государство Кыргызский каганат.
                                    <br/><br/>
                                    В течение XIV -XV веков отдельные группы кыргызов переселились на территорию современного Кыргызстана. Однако основная часть народа оставалась проживать в Минусинской котловине. Значительная часть кыргызов осела среди алтайцев, телеутов и казахов. Остальные кыргызы формировали сегодняшний хакасский народ.
                                    <br/><br/>

                                    <h2>История киргизов во времена Российского правления и СССР</h2>
                                    <br/>
                                    Южная Киргизия (вместе с Ферганой и севером Таджикистана) после разгрома Кокандского ханства в 1876 году была включена в состав Российской империи как Семиреченская область (административный центр — город Верный).
                                    <br/><br/>
                                    В России с трудом различали казахов (киргиз-кайсаков) от собственно киргизов (кара-киргизов), многие племена которых продолжали заниматься кочевым скотоводством.
                                    <br/><br/>
                                    До поры до времени царское правительство не вмешивалось в жизнь киргизов, однако Первая мировая война привела к необходимости мобилизации населения на окопные работы. В результате 10 августа 1916 году вспыхнуло восстание, охватившее Российский Туркестан, в том числе и кочевья киргизов и казахов. Гнев восставших прежде всего обрушился на русских поселенцев, которых было убито до 2000 человек. Восстание было жестоко подавлено. Почти половина кыргызского населения Прииссыккулья было истреблено. Часть киргизов бежала в Китай, где впоследствии в приграничной провинции Синьцзян был даже образован Кызылсу-Киргизский автономный округ.
                                    <br/><br/>
                                    В 1936 Киргизия получила статус союзной республики (ССР), столицей которой стал город Фрунзе (бывший Пишпек). В 1939 году территория советской Киргизии была разделена на пять областей: Ошская, Иссык-Кульская, Тянь-Шаньская, Джалал-Абадская и Фрунзенская. В годы Перестройки по всем национальным окраинам СССР наблюдался рост национального возрождения с одной стороны и межнациональной напряжённости с другой.  Для урегулирования ситуации на пост первого президента республики был выдвинут академик Аскар Акаев.
                                    <br/><br/>

                                    <h2>Современная история киргизов</h2>
                                    <br/>
                                    <img src="{{ URL::to('img/custom/kyrgyz_history_3.jpg') }}" style="width: 100%"/>
                                    <br/><br/>
                                    На рубеже тысячелетий республика невольно была вовлечена в борьбу против терроризма, которая была предвосхищена геополитической нестабильностью у южных рубежей. В 1999 году Киргизию всколыхнули Баткенские события, когда боевики Исламского движения Узбекистана попытались прорваться из Таджикистана через территорию Киргизии в Узбекистан.
                                    <br/><br/>
                                    В 2001 году в Киргизии была размещена американская авиабаза Манас. Первым симптомом кризиса стали Аксыйские события 2002 года. Затем произошла Тюльпановая революция 24 марта 2005, завершившая 15-летнее правление Аскара Акаева (1990—2005). Новым президентом стал Курманбек Бакиев (2005—2010), которому не удалось стабилизировать положение в стране.
                                    <br/><br/>
                                    Бакиев был свергнут во время очередной революции 7 апреля 2010 года. Власть перешла временному правительству во главе с лидером революции Розой Отунбаевой. Столкновения между сторонниками новой и старой власти спровоцировали межэтнический конфликт между киргизами и узбеками на юге страны, в ходе которого погибло свыше 200 человек, а сотни тысяч узбеков покинули страну.
                                    <br/><br/>
                                    27 июня 2010 в Киргизии прошёл референдум, на котором были подтверждены полномочия Розы Отунбаевой в качестве главы государства на переходный период до 2011 года, а также была принята новая конституция, утверждающая в стране парламентскую форму правления.
                                    <br/><br/>
                                    30 октября 2011 года прошли выборы президента, из 16 кандидатов победу одержал А.Атамбаев с 63,24 % голосов.
                                    <br/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop