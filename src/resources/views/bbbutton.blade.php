@php
    $indentificator=uniqid();
        if($value){
            switch ($type){
                case 'layouts':
                $obj=Sahakavatar\Cms\Models\ContentLayouts\ContentLayouts::findByVariation($value);
                $variation=Sahakavatar\Cms\Models\ContentLayouts\ContentLayouts::findVariation($value);
                break;
                case 'unit':
                $obj=\Sahakavatar\Cms\Models\Templates\Units::findByVariation($value);
                $variation=\Sahakavatar\Cms\Models\Templates\Units::findVariation($value);
                break;
            }
        }

@endphp
<div class="col-md-12">
    <div class="col-md-4">{!! $text !!}</div>
    <div class="col-md-5">
        <input type="text"
               data-key="title"
               data-toggle="popover"
               readonly="readonly"
               data-id="{!! $indentificator !!}"
               class="page-layout-title form-control"
               title="info"
               @if(isset($obj) && isset($variation)&& is_object($obj) && is_object($variation))
               value="{!! $obj->title !!}"
               data-content="
                   Type:{!! $type !!}
                       Name:{!! $obj->title !!}
                       Author:{!! $obj->author !!}
                       Uploaded:{!! BBgetDateFormat($obj->created_at) !!}
                       Variation:{!! $variation->title !!}
               @if(isset($variation->updated_at))
                       Last Modification:{!!BBgetDateFormat($variation->updated_at) !!}"
               @endif
               @else
               value="Nothing Selected!!!"
                @endif
        >
    </div>
    <div class="col-md-3">
    <button type="button" data-action={!! $type !!}  data-key="{!! $indentificator !!}" {!! $atributes !!} >Cange
    </button>
    </div>
    <input
            class="bb-button-realted-hidden-input"
            type="hidden" {!! $array !!}
            value="{!! $value !!}"
            data-name="{!! $indentificator !!}"
            name="{!! $hiddenName !!}"
    >
</div>