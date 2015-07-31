@extends("{$template}misc.layout")

@section('content')
    <div class="b-wrapper">
        <div class="b-page">
            <div class="b-content">
                <div class="b-profile-about">
                    <div class="b-profile-about__inner">
                        <div class="b-profile-about__text">
                            <div class="b-profile-about-text">
                                <div class="b-profile-about-text__text">
                                    <h2>Культура казахов</h2>
                                    <br/>
                                    Главные культурные ценности казахов – уважение к старшим, миролюбие и терпимость, открытость к общению, гостеприимство и стремление жить в гармонии с окружающим миром.
                                    <br/><br/>
                                    Кииз уй - казахская юрта - один из самых совершенных видов переносного жилища. Это удобный и практичный дом, идеально приспособленный к условиям природы и образу жизни – одно из величайших изобретений Евразийских кочевников.
                                    <br/><br/>
                                    Национальная одежда казахов варьируется в зависимости от региона. Основная одежда – «шапан» (опоясанный халат). Его шьют из бархата. Традиционные головные уборы - высокие фетровые колпаки, мягкие тюбетейки и шапка из меха лисы – малакай.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/'.Config::get('app.nation_name').'/culture_1.jpg') }}"/>
                                    <br/><br/>
                                    У женщин национальная одежда состоит из хлопкового белого или разноцветного платья из шёлка, поверх которого одевается бархатный жилет или жакет, обильно украшенный вышивкой. На головах девушки носят шапочки, украшенные бусами и стразами, молодые женщины – шелковые платки, пожилые замужние женщины покрывают голову кимешеком - белой накидкой, сшитой по уникальной модели, оставляющей лицо открытым. Невесты одевают высокую, остроконечную, богато украшенную шапку "саукеле" с пучком перьев на макушке.
                                    <br/><br/>
                                    Национальные игры – непременный атрибут праздника. Это казакша курес (казахская борьба), байга (скачки на большие дистанции – 25, 50 или 100 км), кокпар (всадники пытаются схватить и вырвать друг у друга козлиную тушку), кыз-куу (догони девушку), и алты бакан (качели на шести столбах).
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/'.Config::get('app.nation_name').'/culture_2.jpg') }}"/>
                                    <br/><br/>
                                    Казахи высоко ценят искусство красноречия и почитают своих акынов – поэтов-импровизаторов, выступающих на публичных состязаниях (айтысах) под аккомпанемент национальных музыкальных инструментов: двухструнной домбры и смычкового инструмента кобыза. Несмотря на их внешнюю простоту, домбра и кобыз обладают неповторимым богатством звучания.
                                    <br/><br/>
                                    Национальная кухня казахов, как и любая азиатская кухня очень разнообразна и вкусна. Основные блюда являются мясными, Одно из популярных казахских блюд называется «Ет» (мясо), это блюдо часто называется и известно в русскоязычной литературе и прессе как бешбармак, из варёной свежей баранины с кусочками раскатанного варёного теста (камыр). Также популярны куырдак (жареные кусочки печени, почек, легких, сердца и т. п.), кеспе или салма (лапша), сорпа (мясной бульон), ак-сорпа (молочный суп с мясом, или просто мясной суп с куртом). К основным блюдам нередко относят также и разнообразные варёные колбасы — казы (колбаса из конины, делится по степени жирности), карта, шужык. Ранее к основным блюдам также относился когда-то популярный у пастухов фаршированный желудок, испекаемый в золе (аналог хаггиса), но сейчас он относится к экзотике даже у казахов.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/'.Config::get('app.nation_name').'/culture_3.jpg') }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop