<!-- Modal for Edit Post-->
<div id="editModal" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-pencil fa-fw fa-1x font-icon-body"></i> Edit caption
            </div>
            <div class="modal-body">
                <div class="media">
                    <div class="media-left">
                        @if(!$authAvatars->isEmpty())
                            @foreach($authAvatars as $authAvatar)
                                @if($loop -> last)
                                    @if($authAvatar -> deleted_at == null)
                                        <img class="media-object avatar-content-img avatar-img-style avatar-photo-{{$authAvatar->post_id}}" src="{{route('shared.avatar.crop', ['user_id' => Auth::user()->id, 'filename' => $authAvatar -> avatar_crop])}}" onError="this.onerror=null;this.src='{{auth()->user()->avatar}}';" />
                                    @else
                                        <img class="media-object avatar-content-img avatar-img-style" src="{{auth()->user()->avatar}}"/>
                                    @endif
                                @endif
                            @endforeach
                        @else
                            <img src="{{auth()->user()->avatar}}" class="media-object avatar-content-img avatar-img-style"/>
                        @endif
                    </div>
                    <div class="media-body write-post-holder">
                        <form>
                            <div class="form-group {{ $errors->has('caption') ? ' has-error' : '' }}">
                                {!! Form::textarea('caption', null, ['class'=>'form-control hidden', 'id' => 'caption', 'rows' => '5']) !!}
                                @if ($errors->has('caption'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('caption') }}</strong>
                                    </span>
                                @endif
                                <div class="caption caption-write-post-here" id="post-caption" contenteditable="true" placeholder="Pin your taughts."></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::button('<i class="fa fa-times fa-1x font-icon-body" aria-hidden="true"></i> <span> Close</span>', ['data-dismiss' => 'modal', 'class'=>'btn btn-custom-header pull-left', 'data-dismiss'=>'modal']) !!}
                {!! Form::button('<i class="fa fa-thumb-tack fa-1x font-icon-header" aria-hidden="true"></i> <span> Pin changes</span>', ['type'=>'submit', 'class'=>'btn btn-custom-body pull-right btn-pin-post btn-pin-write-post', 'data-dismiss'=>'modal']) !!}
            </div>
        </div>
    </div>
</div>
<!-- End Modal for Edit Post -->

<!-- Modal for Like Counts-->
<div id="likeCountModal" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Peope who likes this share!</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="img-avatar pull-left">
                            <!-- <img src="/images/avatar_default.svg"> -->
                        </div>
                        <div class="info">
                            <span>&nbsp;

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal for Like Counts -->

@if( Request::route()->getName() == 'profile' )
    @if (!Auth::guest() )
        <!-- Modal for Upload Avatar-->
        <div id="uploadAvatarModal" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <i class="fa fa-camera fa-fw fa-1x font-icon-body"></i> Change profile picture
                    </div>
                    {!! Form::open(['method'=>'POST', 'action'=>'ProfileController@uploadAvatar', 'files'=>true, 'id'=>'UploadAvatarWithCrop']) !!}
                    <div class="modal-body">
                        <div class="media">
                            <div class="media-left">
                                @if(!$authAvatars->isEmpty())
                                    @foreach($authAvatars as $authAvatar)
                                        @if($loop -> last)
                                            @if($authAvatar -> deleted_at == null)
                                                <img class="media-object avatar-content-img avatar-img-style avatar-photo-{{$authAvatar->post_id}}" src="{{route('shared.avatar.crop', ['user_id' => Auth::user()->id, 'filename' => $authAvatar -> avatar_crop])}}" onError="this.onerror=null;this.src='{{auth()->user()->avatar}}';" />
                                            @else
                                                <img class="media-object avatar-content-img avatar-img-style" src="{{auth()->user()->avatar}}"/>
                                            @endif
                                        @endif
                                    @endforeach
                                @else
                                    <img src="{{auth()->user()->avatar}}" class="media-object avatar-content-img avatar-img-style"/>
                                @endif
                            </div>
                            <div class="media-body upload-avatar-holder">
                                <div class="upload-file-holder row">
                                    <div class="col-md-7 col">
                                        <div class="form-group {{ $errors->has('avatar') ? ' has-error' : '' }}" style="display: none;">
                                            {!! Form::file('avatar[]', ['class'=>'form-control upload-file-input', 'id'=>'postAvatar', 'style'=>'display:none', 'accept'=>'image/*']) !!}
                                            <input type="hidden" id="avatarbase64" name="avatarCrop">
                                        </div>
                                        <div class="form-group file-upload" id="avatarPreview">
                                            <ul class="list-inline text-center">

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col">
                                        <div class="form-group upload-file-caption upload-file-avatar-caption {{ $errors->has('caption') ? ' has-error' : '' }}">
                                            {!! Form::textarea('caption', null, ['class'=>'form-control hidden', 'id' => 'caption', 'rows' => '3', 'placeholder' => 'Pin your moments.' , '']) !!}
                                            @if ($errors->has('caption'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('caption') }}</strong>
                                                </span>
                                            @endif
                                            <div class="caption caption-write-post-here" contenteditable="true" placeholder="Pin your moments."></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <div class="modal-footer">
                        {!! Form::button('<i class="fa fa-times fa-1x font-icon-body" aria-hidden="true"></i> <span> Close</span>', ['data-dismiss' => 'modal', 'class'=>'btn btn-custom-header btn-pin-post-close pull-left']) !!}
                        {!! Form::button('<i class="fa fa-thumb-tack fa-1x font-icon-header" aria-hidden="true"></i><span> Pin</span>', ['type'=>'submit', 'class'=>'btn btn-custom-body pull-right btn-pin-post', 'id'=>'uploadAvatarSave']) !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal for Upload Avatar -->
    @endif
@endif

<!-- Form for hide commnet -->
<form style="display: none;">
    {!! Form::text('comment_hide_value', null, ['class'=>'form-control', 'id' => 'comment-hide']) !!}
</form>
<!-- End Form for hide commnet -->