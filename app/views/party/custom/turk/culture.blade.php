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
                                    <h2>Турецкая культура</h2>
                                    <br/>
                                    Турецкая культура сочетает в себе разнообразные элементы. Турецкая нация впервые была «осовременена» с приходом правления Мустафы Кемаля Ататюрка в 1923 г. Он сумел превратить движимую религией бывшую Османскую империю в современное государство, что повлекло за собой увеличение методов художественного выражения страны.
                                    <br/><br/>
                                    До правления Ататюрка изобразительное искусство было слабо развита во многом благодаря строгим исламским правилам, запрещающим любые изображения, свидетельствующие о бессмертии души. С приходом к правлению первого президента появились первые картины и скульптуры. Это было и процессом модернизации, и способом воссоздания культурной самобытности. До наших времён отлично сохранилась богатая архитектура Османского периода в виде изысканных мечетей, соборов и медресе различных стилевых направлений, в которых прослеживаются и Средиземноморские традиции, и ближневосточный колорит.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/'.Config::get('app.nation_name').'/culture_1.jpg') }}"/>
                                    <br/><br/>
                                    Классика турецкой поэзии сформировалась приблизительно к 19 веку, когда заканчивалось правление османской Империи. Нельзя однозначно выделить уникальный стиль, поскольку литература того времени представляет собой некую оригинальную смесь арабского, персидского и тюркского направлений.
                                    <br/><br/>
                                    Турецкая музыка уходит корнями в Средневековье. Она познала существенные изменения на пути к современности, однако сохранила верность энергичному фольклорному стилю. На нынешнюю турецкую музыку в значительной степени повлияли западные жанры. Она переняла такие стилевые направления, как джаз, поп и рок.
                                    <br/><br/>
                                    Турецкие танцы согласно классификации разделяются на религиозные, танцы для собственного удовольствия (так же как и фольклорные) и постановочные танцы, как театрализированные представления. На турецкие танцы повлияло развитие традиций двух совершенно разных мест, культурных сред, изолированных друг от друга: Стамбул, столица бывшей Османской Империи, и многочисленные деревни.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/'.Config::get('app.nation_name').'/culture_2.jpg') }}"/>
                                    <br/><br/>
                                    Дата религиозных праздников постоянно смещается, так как турки регламентируют их согласно лунному календарю. Среди множества религиозных событий выделяют два главных праздника. Это «Рамадан», приходящийся на священный девятый месяц, обязывающий к ограничению себя в плотских утехах и абстрагированию от мирской жизни, и «Курбан-Байрам» – праздник жертвоприношения, когда тушку баранины делят на три равные части, первые две из которых раздают нуждающимся и используют в приготовлении обеда родным и близким. Самый последний кусок оставляют себе. Рамадан заканчивается трёхдневным праздником сладостей «Шекер-Байрам», после которого большинство государственных учреждений в течение недели остаются закрытыми.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop