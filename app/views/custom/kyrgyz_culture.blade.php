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
                                    <h2>Культура киргизов</h2>
                                    <br/>
                                    Основу фольклора составляет трилогия эпоса «Манас»: «Манас», «Семетей», «Сейтек». Эпос «Манас» вмещает в себя более миллиона строк, внесен в книгу рекордов Гиннеса, как самый крупный в мире эпос и охраняется ЮНЕСКО как достояние человечества.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/kyrgyz_culture_1.jpg') }}" style="width: 100%"/>
                                    <br/><br/>
                                    Кыргызский фольклор, помимо обрядовой поэзии и лирического жанра, богато представлен нравоучительной устной поэзией, пословицами и поговорками, загадками и сказками, мифами и легендами.
                                    <br/><br/>
                                    Кыргызский народ с давних времен славился своей музыкальностью. Наиболее популярным музыкальным инструментом является трехструнный щипковый комуз.
                                    <br/><br/>
                                    Большое место в киргизской культуре занимает национальный балет и опера. Известными на весь мир представителями балета являются Бюбюсара Бейшеналиева, Чолпонбек Базарбаев, Уран Сарбагышев, Рейна Чокоева, Айсулуу Токомбаева.
                                    <br/><br/>
                                    Среди киргизов очень популярны единоборства и конные игры. Национальными видами игр являются борьба «курёш» и «алыш». Любимым развлечением киргизов является охота с ловчими птицами и состязания на конях: скачки, поединок двух всадников на пиках, конская борьба, азартная игра, в которой соревновались юноши и девушка, "борьба" за тушу козлёнка.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/kyrgyz_culture_2.jpg') }}" style="width: 100%"/>
                                    <br/><br/>
                                    Кыргызские кочевники также известны своими изделиями из войлока, так как он у них имеется в избытке.
                                    <br/><br/>
                                    Кочевой образ жизни оказал свое влияние и на национальную кухню киргизов. Именно в пище оказались наиболее устойчивыми древние традиции народа. Самые почетные национальные блюда  -  "бешбармак" и куурдак.  А также чудный напиток кумыс, который готовится их кобыльего молока  и славится исключительными вкусовыми и целебными свойствами.
                                    <br/><br/>
                                    Одежда киргизов также была приспособлена для условий жизни, обусловленный видом деятельности. Это была ситцевая или бязевая рубаха, просторные штаны на завязке. Поверх рубахи надевался камзол, сшитый приталено, в холодную погоду поверх которого надевался халат на вате или домотканого сукна. Зимняя одежда киргизов - это овчинные тулупы и штаны из овечьей шерсти мехом во внутрь.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop