<div class="b-publication-sort" style="margin-bottom: 20px;">
    <ul id="filters">
        <li class="b-publication-sort__list">Сортировать:</li>
        <li class="b-publication-sort__list"><a href="#" data-filter=".topic">Топики</a></li>
        <li class="b-publication-sort__list"><a href="#" data-filter=".blog">Блоги</a></li>
        <li class="b-publication-sort__list"><a href="#" data-filter=".group">Группы</a></li>
        <li class="b-publication-sort__list"><a href="#" data-filter="*">Все</a></li>
        <div class="clear"></div>
    </ul>
</div>
<div id="masonry">
@foreach($items as $item)
    <?php $target = $item->target; ?>
    @if(is_a($target, 'Topic'))
        @include("{$template}topic.build", array('topics' => array($target)))
    @elseif(is_a($target, 'Blog'))
        @include("{$template}blog.build", array('blogs' => array($target)))
    @endif
@endforeach
</div>
{{HTML::script('js/isotope.min.js')}}
@include('scripts.convert-times')
<script>
    function timesConvert(){
        times.init('.b-user-wall-header__date');
        times.eachConvert('.b-user-wall, .b-user-blog');
    }
    
    $(document).ready(function(){
        
        timesConvert();
        var $container = $('#masonry');
        var columnWidth = 500;
        $container.find('.b-user-wall, .b-user-blog').addClass('b-user-wall-495');
        $container.imagesLoaded(function(){
            $container.isotope({
                itemSelector : '.masonry',
                masonry: {
                  columnWidth: columnWidth,
                  gutterWidth: 10
                }
            });	
        });
        $('.masonry').css('display', 'block');
        $('#filters a').click(function(){
            var selector = $(this).attr('data-filter');
            $container.isotope({ filter: selector });
            return false;
          });
    })
</script>
<style>
    .isotope-item {
        z-index: 2;
    }

    .isotope-hidden.isotope-item {
        pointer-events: none;
        z-index: 1;
    }
    .b-user-blog.b-user-wall-495{
        width: 495px;
    }
    #filters{
        height: 40px;
    }
</style>