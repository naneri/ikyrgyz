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
                                    <h2>Культура уйгуров</h2>
                                    <br/>
                                    Традиционные занятия уйгуров — торговля, земледелие, различные виды ремёсел, отгонное животноводство, у некоторых групп пастбищное животноводство (кумульцы, мачинцы и др.). Для лобнорских уйгуров, было характерно занятие рыболовством и охотой.
                                    <br/><br/>
                                    Уйгуры создали богатую и своеобразную культуру (монументальная культовая архитектура, музыкальные и литературные произведения, изобразительное искусство особенно в миниатюрной живописи), оказавшую влияние на культуру многих народов Востока.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/uyghur_culture_1.jpg') }}" style="width: 100%"/>
                                    <br/><br/>
                                    С древности у уйгуров существует богатая литература — фольклор, проза, поэзия, религиозная (переводы религиозных текстов буддизма и манихейства) литература. Значительную часть литературных памятников классической Уйгурской литературы представляет собой общее наследие ряда тюркоязычных народов Средней Азии и Восточного Туркестана. Таковы дидактическая поэма «Знание, дающее счастье» Юсуфа Баласагуни (11 в.)
                                    <br/><br/>
                                    Истоки самобытного искусства уйгуров уходят вглубь веков. Их древняя родина – Восточний Туркестан – регион, где проходил Великий шелковый путь, связывавший Восток и Запад и обеспечивавший взаимный обмен материальными и духовными ценностями. Эти контакты способствовали тому, что художественные традиции уйгуров обогащались достижениями среднеазиатских, восточноиранских, североиндийских культур.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/uyghur_culture_2.jpg') }}" style="width: 100%"/>
                                    <br/><br/>
                                    Уйгурское кулинарное искусство является своеобразным памятником материальной культуры народа. Оно синтезирует в себе взаимовлияния Запада и Востока, древность и современность, к тому же это великое мастерство, фантазия, красота и гармония вкуса.
                                    <br/><br/>
                                    <img src="{{ URL::to('img/custom/uyghur_culture_3.jpg') }}" style="width: 100%"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop