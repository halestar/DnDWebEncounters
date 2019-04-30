@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-lg-8">
            <form action="{{ route('monster_tokens.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        Add New Monster Token
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Token Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="token_type" id="token_type_number"
                                   value="NUMBER"
                                   checked onclick="determineInputs(jQuery(this).val())">
                            <label class="form-check-label" for="token_type_number">
                                Number Token
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="token_type" id="token_type_color"
                                   value="COLOR"
                                   onclick="determineInputs(jQuery(this).val())">
                            <label class="form-check-label" for="token_type_color">
                                Colored Token
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="token_type"
                                   id="token_type_colored_number"
                                   value="COLORED_NUMBER" onclick="determineInputs(jQuery(this).val())">
                            <label class="form-check-label" for="token_type_colored_number">
                                Colored Number Token
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="token_type" id="token_type_mini"
                                   value="MINI"
                                   onclick="determineInputs(jQuery(this).val())">
                            <label class="form-check-label" for="token_type_mini">
                                Picture of Mini
                            </label>
                        </div>

                        <div id="number_display" class="form-group">
                            <label for="name">Number</label>
                            <input type="text" class="form-control" id="token_number" name="token_number">
                        </div>

                        <div id="color_display" class="form-group mb-3" style="display: none;">
                            <label for="name">Color</label>
                            <input type="text" class="form-control" id="token_color" name="token_color"
                                   onchange="jQuery(this).css('backgroundColor', jQuery(this).val())">
                        </div>

                        <div class="custom-file" id="img_display" style="display: none;">
                            <input type="file" class="custom-file-input" id="portrait" name="portrait">
                            <label class="custom-file-label" for="portrait">Picture of Mini</label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary btn-block" value="Add New Token">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        function determineInputs(radioOption)
        {
            if(radioOption == "NUMBER")
            {
                jQuery('#number_display').show();
                jQuery('#color_display, #img_display').hide();
            }
            else if(radioOption == "COLOR")
            {
                jQuery('#color_display').show();
                jQuery('#number_display, #img_display').hide();
            }
            else if(radioOption == "COLORED_NUMBER")
            {
                jQuery('#color_display,#number_display').show();
                jQuery('#img_display').hide();
            }
            else if(radioOption == "MINI")
            {
                jQuery('#color_display,#number_display').hide();
                jQuery('#img_display').show();
            }
        }

        jQuery('#color_display').colorpicker(
            {
                format: "hex"
            }
        );
    </script>
@endpush
