@php ($exp = explode('.', $attachment->hash))
@php ($ext = array_pop($exp))

{{ link_to_asset('uploads/attachments/' . $attachment->hash, 'Download attachment') }}
<br>
@if (in_array($ext, ['jpeg','jpg', 'png', 'gif']))
    {{ Html::image('uploads/attachments/' . $attachment->hash, 'Images de l\'article', ['class' => 'mini-thumbnails']) }}

@endif