@extends('misc.layout')

@section('content')
    <div class="b-wrapper">
        <div class="b-page">
            <div class="b-content">
                <div class="b-profile-about">
                    <div class="b-profile-about__inner">
                        <div class="b-profile-about__text">
                            <div class="b-profile-about-text">
                                <div class="b-profile-about-text__text">
                                    <h2>История Грузии</h2>
                                    <br/>
                                    История Грузии охватывает длительный период времени, начиная с памятников Аббевильской Культуры и кончая событиями современности. Наряду с регионами Кавказа, Грузия входит в число мест обнаружения древнейших памятников человеческой цивилизации и считается местом зарождения металлургии.
                                    <br/><br/>
                                    «Золотой век» Грузии пришёлся на период между началом XI и началом XIII веков. Пиком расцвета стало время правления царицы Тамары, прозванной Великой (1184—1210).
                                    <br/><br/>
                                    Историки полагают, что первое государство, упоминаемое на территории Грузии — Колхидское царство, располагавшееся на восточном побережье Чёрного моря.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/'.Config::get('app.nation_name').'/history_1.jpg') }}"/>
                                    <br/><br/>
                                    В восточной части современной Грузии в IV веке до н. э. междоусобные войны закончились образованием государства, которое в грузинской историографии называется Картлийское царство, а в античной — Кавказская Иберия.
                                    <br/><br/>
                                    В 65 году до н. э. римские войска под командованием Помпея, который в это время вёл войну с Понтом и Арменией, вторглись в Иверию, но затем ушли из неё. В 36 году до н. э. Рим заставил Фарнаваза II присоединиться к военной кампании против Кавказской Албании. К 65 году до н. э. в результате войны с Римом и Парфией Армения потеряла существенную часть своей территории, а Понтийское царство перестало существовать и было включено в состав Римской империи.
                                    <br/><br/>
                                    В первой трети VII в. на Аравийском полуострове образовалось государство арабов, во главе которого стоял Мухаммед, с чьим именем связано распространение среди арабов новой веры. В 640 году арабы вторглись в Армению и взяли её столицу Двин. В 657—659 годах ненадолго арабы захватывают и Картли, и Эгриси.
                                    <br/><br/>
                                    Вскоре, в халифате началась междоусобная война, которая тянулась до тех пор, пока единственным властелином не стал первый халиф Омеядов Муавия I (661—680). После ослабления халифата в IX веке в юго-западной Грузии возникло новое государство во главе с Ашотом I Куропалатом из династии Багратидов, изгнавшим из этих областей арабов. В IX — начале X века арабы были окончательно изгнаны из Закавказья, а позже оттуда была вынуждена уйти и Византия.
                                    <br/><br/>
                                    Царица Тамар была первой женщиной, занявшей престол единого грузинского государства, тем самым впервые была нарушена многовековая традиция возведения на трон царей Грузии. Самое грандиозное сражение, вошедшее в историю как Басианская битва, закончилось блестящей победой грузинских войск над многочисленными войсками коалиции турок-сельджуков…
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/'.Config::get('app.nation_name').'/history_2.jpg') }}"/>
                                    <br/><br/>
                                    В XV веке Грузинское царство превратилось в изолированную христианскую страну, со всех сторон окружённую мусульманским миром. В следующие несколько веков Грузия входила в сферу влияния своих более сильных соседей, Османской империи и сефевидского Ирана.
                                    <br/><br/>
                                    Связи Грузии с Россией, прерванные в период монголо-татарского ига, возобновляются и принимают регулярный характер. Грузинские правители обращаются к России с просьбами о военной помощи, предлагают совместные действия против Турции и Ирана. В конце XVII века в Москве создаётся Грузинская колония, сыгравшая значительную роль в русско-грузинском сближении.
                                    <br/><br/>
                                    После Октябрьской революции 1917 года в Тбилиси создаётся коалиционное правительство Закавказья (Азербайджана, Армении, Грузии). В апрелье 1918  Закавказье объявлено «независимой федеративной демократической республикой», но она быстро распалась, и уже 26 мая 1918 меньшевики объявили Грузию «независимой республикой».
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop