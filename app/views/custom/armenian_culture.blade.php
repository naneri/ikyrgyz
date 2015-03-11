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
                                    <h2>Культура Армян</h2>
                                    <br/>
                                    Национальная культура - это главное богатство Армении, которое она сумела выстоять за всю свою драматическую историю.
                                    <br/><br/>
                                    Важной вехой в развитии культуры народа стало создание в 405 году Месропом Маштоцем армянского алфавита и национальной письменности. В XIX в. литература Армении развивалась под влиянием русской и западноевропейской культуры. В 1920—1930-гг. жил крупнейший поэт армянской литературы эпохи Егише Чаренц, творческий путь которого начался еще в 1910-х. Его лушие поэмы («Неистовые толпы», 1919 и т.д.) и сборники («Книга пути» 1933, и т. д.) создали традиции, которые нашли свое продолжение в произведениях последующих поколений армянских поэтов.
                                    <br/><br/>
                                    В каждой культуре есть некий самобытный элемент, который, не присутствуя больше нигде, невольно становится символом всей национальной культуры. В Армении таким символом являются «хачкары» - так называемые крест-камни – памятники Армении не встречаемые больше ни в одной стране мира. Хачкары представляют особый вид искусства – декоративно-архитектурные скульптуры, основанные на древних национальных традициях и отличающееся разнообразием и богатством форм.
                                    <br/><br/>
                                    Традиционными бытовыми занятиями армян были и есть ткачество и ковроткачество, гончарство, кружевоплетение, ювелирная техника, создания и украшения домашней утвари. Развиваясь, эти народные промыслы переросли в национальное декоративно-прикладное искусство, наиболее распространённое и доступное широкой публике.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/armenian_culture_1.jpg') }}" style="width: 100%"/>
                                    <br/><br/>
                                    Армянскую музыку никогда не спутаешь ни с какой другой. У нее особая мелодика и богатое звучание. В целом, эта самобытность достигается за счет звучания оригинальных армянских инструментов, сохранившихся еще со времен раннего Средневековья - прототипы скрипки – пандир и бамбир; струнные - тавих, кнар; духовые – свирель, зурн, авагпог; ударные - барабан.
                                    <br/><br/>
                                    Армянские танцы – несомненно одно из лучших и наиболее демонстративных показателей, показывающих красоту и разнообразие культуры Армении, являющиеся воплощением армянского духа. Кочари – один из основных армянский танцев, который так любят танцевать жители Армении. Берд («крепость»): во время исполнения этого интересного армянского танца, строится живая крепость из участников танца, залезающих друг другу на плечи.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/armenian_culture_2.jpg') }}" style="width: 100%"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop