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
                                    <h2>Русские обычаи</h2>
                                    <br/>
                                    Россия – поистине уникальная страна, которая наряду с высокоразвитой современной культурой бережно хранит традиции своей нации, глубоко уходящие корнями не только в православие, но даже в язычество. Россияне продолжают отмечать языческие праздники, верят в многочисленные народные приметы и предания.
                                    <br/><br/>
                                    Христианство подарило русским такие замечательные праздники, как Пасха, Рождество и обряд Крещения, а язычество – Масленицу и Ивана Купалу.
                                    <br/><br/>
                                    Пасха – это светлый праздник воскресения Христа. После Великого Поста на стол в этот день выставляются самые разные и вкусные блюда. И среди них первое место занимают ритуальные кушанья. И, прежде всего, это пасхи, куличи и крашеные яйца.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/russian_customs_1.jpg') }}" style="width: 100%"/>
                                    <br/><br/>
                                    Рождество. Православная церковь отмечает Рождество Христово по юлианскому календарю 7 января в отличие от западных церквей, празднующих его 25 декабря по григорианскому календарю.
                                    <br/><br/>
                                    Пожалуй, самым веселым праздником на Руси можно назвать Масленицу. Масленицу празднуют всю неделю, причем каждый день Масленичной недели был посвящен особым ритуалам. Прощание с Масленицей завершалось в первый день Великого поста — Чистый понедельник, который считали днем очищения от греха и скоромной пищи.
                                    <br/><br/>
                                    Крещение у православных обычно совершается в младенческом возрасте. Младенца трижды окунают в воду, в католической же просто обливают водой.
                                    <br/><br/>
                                    Иван Купала. В это день люди опоясывались перевязями из цветов, на голову надевали венки из трав. Водили хороводы, пели песни, разводили костры, в середину которых ставили шест с укрепленным на нем горящим колесом — символом солнца.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/russian_customs_2.jpg') }}" style="width: 100%"/>
                                    <br/><br/>
                                    С введением христианства браки стали оформляться через обряд церковного венчания.
                                    <br/><br/>
                                    На Руси, как в других странах, было принято засылать сватов в дом невесты. В назначенный день сваха или родные жениха приходили в дом девушки. Разговор заводился издалека, в иносказательной форме, и родители невесты обычно с ответом не спешили. Окончательный ответ давался после второго или третьего захода сватов.
                                    <br/><br/>
                                    Помолвка - это провозглашение взаимного согласия влюблённых на вступление в брак. После нее они имели право называться: женихом и невестой.
                                    <br/><br/>
                                    Одним из популярнейших до свадебных обрядов является девичник. По традиции накануне свадьбы невеста собирает своих подруг, чтобы провести с ними последний вечер своей свободной незамужней жизни.
                                    <br/><br/>
                                    Отправление свадебного поезда (ныне кортежа) сопровождалось обрядами, имеющими магическую цель - предохраниться от нечистой силы и обеспечить в новой семье рождение детей.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/russian_customs_3.jpg') }}" style="width: 100%"/>
                                    <br/><br/>
                                    Перед отправлением к венцу обычно происходил обряд сводов. Своды - символическое соединение жениха и невесты, совершавшееся под специальные песни посреди избы или во дворе. Венчание - очень красивый и таинственный обряд, происходящий в церкви. Стоя под венцом, молодые перед лицом Бога, дают клятвы быть верными в горе и радости.
                                    <br/><br/>
                                    После венчания новобрачные отправлялись в дом жениха, чтобы получить благословение его родителей.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop