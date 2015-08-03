@extends("{$template}misc.layout")

@section('content')
<div class="b-content">
    @foreach ($errors->all() as $error)
    <div class="b-message b-message-error">
        <a href="javascript: $('.b-message').remove()" class="b-message-close"></a>
        <div class="b-message-icon b-message-error-icon"></div>
        <p class="b-message-p">
            {{$error}}
        </p>
    </div>
    @endforeach
    <div class="b-blog-create-modal">
        <div class="b-blog-create-modal__inner">
            <div class="b-blog-create-modal__title">{{ trans('network.edit-blog') }}
                <button class="btn-close"></button>
            </div>
            <div class="b-blog-create-modal__content">
                <div class="b-blog-create-modal-content">
                    {{Form::open(array('url' => 'blog/edit/'.$blog->id, 'files' => true))}}
                    <div class="b-blog-create-modal-content__item">
                        <input name="title" type="text" value="{{$blog->title}}" class="input-default name-blog"/>
                    </div>
                    <div class="b-blog-create-modal-content__item">
                        {{ Form::select('type_id', $blogTypes, $blog->type_id, array('class' => 'input-default select-blog')) }}
                        <div class="b-blog-create-modal-content-skin">
                            <input type="file" name="avatar"  accept="image/x-png, image/gif, image/jpeg" class="topic-skin">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="b-blog-create-modal-content__item">
                        <textarea name="description" cols="30" rows="10" class="textarea-blog input-default">{{$blog->description}}</textarea>
                    </div>
                    <div class="b-blog-create-modal-content__item" style="height: 44px;">
                        <!--input name="tags" type="text" placeholder="{{ trans('network.tags') }}" class="input-tag input-default" /-->
                        <div class="button-group">
                            <input type="button" value="Отмена" class="btn-cancel input-default"/>
                            <input type="submit" name='okname' value="{{ trans('network.publish') }}" class="btn-submit input-default"/>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@stop