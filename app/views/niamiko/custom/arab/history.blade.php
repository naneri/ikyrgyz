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
                                    <h2>История арабской цивилизации</h2>
                                    <br/>
                                    Предки арабов — племена Аравийского полуострова. История арабов тесно связана с историей семитоязычных народов вообще. Согласно месопотамским историческим свидетельствам арабы начали отделяться от других семитских народов не ранее I тыс. лет до н. э.
                                    <br/><br/>
                                    К V—VI вв. цивилизации северных и южных арабов пришли в упадок. В начале седьмого века мекканский торговец Мухаммед начал проповедовать новую религию (ислам) и создал свою общину. Созданное Мухаммедом государство (Халифат) начало быстро распространяться и через сто лет стало простираться от Испании через Северную Африку и юго-западную Азию до границ Индии.
                                    <br/><br/>
                                    В первые века своего существования Арабский халифат был политически объединён под властью халифов. К середине X века началась её фрагментация и падение под натиском крестоносцев, монголов и турок. В XVI в. османские турки завоевали весь арабский мир и разделили его на провинции (вилаеты).
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/'.Config::get('app.nation_name').'/history_1.jpg') }}"/>
                                    <br/><br/>
                                    В ходе Первой мировой войны англичане организовали антитурецкое восстание в Аравии. Надеясь получить независимость после войны, арабы помогали англичанам в завоевании Сирии и Палестины. В первой половине XX века стали появляться всё более настойчивые требования независимости и объединения со стороны арабов. Европейцы стимулировали модернизацию, но одновременно с этим они проводили расселение французов на лучших землях Алжира и европейских евреев в Палестине.
                                    <br/><br/>
                                    После Второй мировой войны все арабские народы за исключением палестинцев обрели в конечном счете полную независимость. Алжирцы сделали это лишь после восьми лет войны с Францией с 1954 по 1962.
                                    <br/><br/>
                                    Окончание второй мировой войны усилило национально-освободительное движение в арабском мире против западноевропейского колониализма и навязанных им режимов.
                                    Это привело к свержению полуфеодальных монархических проколониальных режимов в Египте, Ливии, Йемене, Ираке. Стали независимыми Алжир, Марокко, Тунис, Аден, Судан. Изменился государственный режим в Сирии.
                                    <br/><br/>
                                    После второй мировой войны Великобритания была вынуждена отказаться от мандата Лиги наций на управление Палестиной. Генеральная ассамблея ООН в ноябре 1947 году приняла решение о создании в ней двух государств в определенных границах — еврейского и арабского. Были недовольны определенными им территориями и евреи, и арабы. В итоге в 1948-1949 годах состоялась первая арабо-израильская война, в которой арабы потерпели поражение. Большинство палестинских арабов покинуло родину и разместилось в других арабских странах. Следующие неудачные для арабов арабо-израильские войны состоялись в 1956, 1967 и 1973 годах.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/'.Config::get('app.nation_name').'/history_2.jpg') }}"/>
                                    <br/><br/>
                                    И Сирия, и Египет принимали участие в арабо-израильских войнах, но без успеха. Поэтому их руководители на этой почве решили соединить свои усилия. В 1958 году было объявлено о создании Объединенной арабской республики из Египта и Сирии. Президентом ее стал Г.А. Насер.
                                    <br/><br/>
                                    В сентябре 1961 году Сирия вышла из состава Объединенной арабской республики. Одно время она состояла только из Египта, а с 1972 года стала называться Арабской республикой Египет.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop